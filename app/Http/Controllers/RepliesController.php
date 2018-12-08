<?php

namespace GistMed\Http\Controllers;

use GistMed\Reply;
use GistMed\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($channelID, Request $request, Thread $thread)
    {
        //Validate incoming request
        $request->validate([
            'reply' => 'required',
        ]);

        //Make a reply object and associate with the thread
        $thread->addReply([
            'reply'=> request('reply'),
            'expert_id' => auth('expert')->user()->id,
        ]);

        return back();
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GistMed\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GistMed\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GistMed\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
