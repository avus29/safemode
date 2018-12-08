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
                            <div class="level">
                                
                                    <h4 class="flex"><a href="/threads/{{$thread->channel->channel}}/{{$thread->id}}">{{$thread->title}}</a></h4>
                                
                                 <strong><a href="/threads/{{$thread->channel->channel}}/{{$thread->id}}">{{$thread->replies_count}} {{str_plural('reply',$thread->replies_count)}}</a></strong>
                            </div>
                            <div class="body">{!!$thread->thread!!}</div>
                            <hr>
                        </article>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
