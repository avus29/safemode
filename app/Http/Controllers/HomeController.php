<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\User;
use GistMed\Gist;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Fetch the ID of the logged in user
        $author_id = auth()->user()->id;
        //find the user in the database
        $user = User::find($author_id);
        //fetch the gist belonging to the user from the database
        $gists = $user->gists()->get();
        return view('home')->with('gists', $gists);
    }
  
}
