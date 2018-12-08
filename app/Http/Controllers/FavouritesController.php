<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Reply;
use GistMed\Favourite;
use GistMed\Expert;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:expert');
    }

    public function store(Reply $reply)
    {
        // dd($reply);
        
        $reply->favourite();
        return back();
    }
}
