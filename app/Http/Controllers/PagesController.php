<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Gist;
use GistMed\Blog;

class PagesController extends Controller
{
   
    public function index(){
        $title = 'Welcome to GistMed!...We are under contruction to serve soon.';
        //Get posts from database from the recent and paginate by 10's
        $gists = Gist::orderBy('id','desc')->with(['user','answers'])->paginate(10);
        $blogs = Blog::orderBy('id','desc')->paginate(10);
        return view('pages/index')->with(['title'=>$title, 'gists'=>$gists, 'blogs'=>$blogs]);

        return view('pages/index');
    }

    public function about(){
        return view('pages/about');
    }

}
