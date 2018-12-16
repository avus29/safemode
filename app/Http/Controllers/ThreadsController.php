<?php

namespace GistMed\Http\Controllers;

use GistMed\Thread;
use GistMed\Channel;
use GistMed\Reply;
use Illuminate\Http\Request;
use GistMed\ThreadFilters;

class ThreadsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:expert')->except(['index','show']);
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel,$filters);

        if(request()->wantsJson()){
            return $threads;
        }

        return view('threads.index',compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate incoming request
       $request->validate([
           'title' => 'required',
           'thread' => 'required',
           'channel_id' => 'required|exists:channels,id',
       ]);

       //Create a new thread object from the validated request
        $thread = Thread::create([
           'expert_id' => auth('expert')->user()->id,
           'channel_id' => $request['channel_id'],
           'title' => $request['title'],
           'thread' => $request['thread'],
       ]);

       return redirect('/threads/'.$thread->channel->slug.'/'.$thread->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \GistMed\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel, Thread $thread)
    {
        //Find replies associated with thread
        $replies = $thread->replies()->paginate(20);
        // return $replies;
                
        return view('threads.show',compact('thread','replies'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \GistMed\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \GistMed\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \GistMed\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel, Thread $thread)
    {
        //Deny access if logged in user is not the creator of the thread
        $this->authorize('update',$thread);
        // if($thread->expert_id != auth('expert')->userid()){
        //     abort(403, 'You do not have permission to delete this file');
        // }

        $thread->delete();
        return redirect('/threads')->with('success','Thread deleted');
    }

    public function getThreads($channel,$filters)
    {
        $threads = Thread::latest()->filter($filters);

        if($channel->exists){
            $threads->where('channel_id',$channel->id);
        }

        return $threads->get();
    }
}
