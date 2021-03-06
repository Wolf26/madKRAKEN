<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateNewsFormRequest;
use App\Posts;
use Auth;

class CreateNewsController extends Controller
{

     /**
      * Create a news.
      *
      * @param  array  $data
      * @return News
      */
      static function slug($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);
    $str = strtolower($str);
    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('# #', '-', $str);
    return $str;
}
static function resumeText($str, $charset='utf-8')
{
    $resume = strip_tags($str);
    $resume = html_entity_decode($resume);
    $resume = urldecode($resume);
    $resume = preg_replace('/ +/', ' ', $resume);
    $resume = trim($resume);
    return $resume;
}
    public function create()
    {
        if(Auth::user()->admin == 1){
            return view('admin/create_news');
        }else{
            return view('admin/permission');
        }

    }

    public function store(CreateNewsFormRequest $request){
        $title = $request->title;
        $content = $request->content;
        $file = $request->file('images');
        $user = $request->user()->name;
        $slug = $this->slug($title);
        $resume = $this->resumeText($content);
        $destinationPath = 'uploads/news/';
        $file->move($destinationPath,$file->getClientOriginalName());
        $images = '/'.$destinationPath.''.$file->getClientOriginalName();

             \DB::insert('insert into posts (author, images, content, resume, slug, title) values(?,?,?,?,?,?)',
              [$user, $images, $content, $resume, $slug, $title]);

              \DB::insert('insert into hot_news (author, images, content, slug, title) values(?,?,?,?,?)',
               [$user, $images, $resume, $slug, $title]);
         return Redirect('admin/news')->with('message', 'Post published');
    }
}
