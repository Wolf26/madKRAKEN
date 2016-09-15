<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateNewsFormRequest;
use App\Posts;

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
    public function create()
    {
return view('admin/create_news');
    }

    public function store(CreateNewsFormRequest $request){
        $title = $request->get('title');
        $content = $request->get('content');
        $images = $request->get('images');
        $date = time();
        $user = 'test';
        $slug = $this->slug($title);
             \DB::insert('insert into posts (author, images, content, slug, title) values(?,?,?,?,?)',
              [$user, $images, $content, $slug, $title]);
                return \Redirect::route('admin/create-news')->with('message', 'Thanks for posting!');
    }
}