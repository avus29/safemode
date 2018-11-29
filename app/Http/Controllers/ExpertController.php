<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Gist;
use GistMed\Expert;

class ExpertController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:expert');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get posts from database from the recent and paginate by 10's
        $gists = Gist::orderBy('id','desc')->with(['user','answers'])->paginate(10);
        return view('expert.dashboard')->with('gists', $gists);

    }

    /**
     * 
     *  Show the articles/blogs belonging to the logged in expert
     * 
    */
    public function articles(){
        //Fetch the ID of the logged in expert
        $author_id = auth('expert')->user()->id;
        //Find the expert from database
        $expert = Expert::find($author_id);
        //Fetch articles/blogs belonging to the expert that are visible (cos deleted blogs have been set to inisible)
        $blogs = $expert->blogs()->where('visible','=',1)->get();
        return view('expert.articles')->with('blogs', $blogs);
    }

    /**
     * 
     * show the profile of the expert
     * 
    */
    public function profile(){
        //fetch expert ID
        $expert_id = auth('expert')->user()->id;
        //Find the expert
        $expert = Expert::find($expert_id);
        //Find the number of answers expert has provided
        $answers_count = $expert->answers()->count();
        //Find the number of blogs expert has written
        $blogs_count = $expert->blogs()->count();

        return view('expert.profile')->with(['expert'=>$expert,'a_count'=>$answers_count,'b_count'=>$blogs_count]);

    }
}
