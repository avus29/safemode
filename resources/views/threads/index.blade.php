@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @foreach ($threads as $thread)
                        <article>
                            <div>
                                <h4 class="flex"><a href="/threads/{{$thread->channel->channel}}/{{$thread->id}}">{{$thread->title}}</a></h4>
                            <strong class="text-danger">{{$thread->created_at->diffForHumans()}}</strong> with <strong><a href="/threads/{{$thread->channel->channel}}/{{$thread->id}}">{{$thread->replies_count}} {{str_plural('reply',$thread->replies_count)}}</a></strong> by <strong><a href="/profile/{{$thread->creator->id}}">{{$thread->creator->first_name}} {{$thread->creator->last_name}}</a></strong>
                            </div>
                            <div class="body">{!!$thread->thread!!}</div>
                            <hr>
                        </article>
                    
                        
                    @endforeach
                    @empty($threads)
                        <p>There are no relevant threads for now.</p>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
