<?php

namespace GistMed\Http\Controllers;

use Illuminate\Http\Request;
use GistMed\Blog;
use GistMed\Comment;

class CommentsController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
       //Validate Inputs   
      $this->validate($request,[
        'comment'=>'required'
        ]);

        $blog = Blog::find($id);
        //Create Gist
        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->user_id = auth('web')->user()->id;
        $comment->blog()->associate($blog);
        $comment->save();

        return redirect('/blogs/'.$id)->with('success','Comment Submitted.'); 
    }

}
