<?php

namespace App\Http\Controllers;

use App\Teams;
use App\User;
use App\Posts;
use App\Sponsors;
use App\HotNews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        $news = Posts::orderBy('created_at', 'desc')->take(6)->get();
        $sponsors = Sponsors::take(4)->get();
        $hotnews = HotNews::all();
        return view('index', ['news' => $news, 'sponsors' => $sponsors, 'hotnews' => $hotnews]);
    }

    public function news($slug) {
        $id = substr($slug, 0, strstr($slug, "-") + 1);

        $post = Posts::where('id', $id)->first();

        if(count($post) == 0)
            return "Error";

        return view('news', ['post' => $post]);
    }

    public function sponsors() {
        $sponsors = Sponsors::all();

        return view('sponsors', ['sponsors'=> $sponsors]);
    }
}
