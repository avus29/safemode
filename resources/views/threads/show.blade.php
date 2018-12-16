@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div class="row">
        {{-- This is the main panel page --}}
        <div class="col-md-8">
            {{-- The thread goes here with it's particulars --}}
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header bg-white text-primary">
                            <h4><b>{{$thread->title}}</b>
                            </h4>
                            @if(Auth::guard('expert')->id() == $thread->expert_id)
                            {{-- @can('update',$thread) --}}
                                 <form action="/threads/{{$thread->channel->channel}}/{{$thread->id}}" method="POST">
                                   {{ csrf_field() }}
                                   {{method_field('DELETE')}}

                                   <button type="submit" class="btn btn-danger float-right">Delete Thread</button>
                                </form>
                            {{-- @endcan --}}
                               
                            @endif
                            
                            {{-- {!!Form::open(['action'=>['ThreadsController@destroy',$thread->channel->channel,$thread->id],'method'=>'POST', 'class'=>'float-right'])!!}
                                {{Form::hidden('_method','DELETE')}}
                                {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                            {!!Form::close()!!} --}}

                        <p class="text-secondary">By <b>{{$thread->creator->last_name}}</b> on <b>{{$thread->created_at->diffForHumans()}}</b></p>
                        </div>

                        <div class="card-body">                   
                            <h4 class="body">{!!$thread->thread!!}</h4>                       
                        </div>
                    </div>
                </div>
            </div>        
            {{-- Replies goes in here --}}
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        <div class="card-header"><b>Replies</b></div>
                        <div class="card-body">                        
                            @foreach ($replies as $reply)
                                <div id="reply-{{$reply->id}}" class="card">   
                                    <div class="card-header">
                                        <a href="#">{{$reply->author->last_name}}</a> said <em>{{$reply->created_at->diffForHumans()}}</em>
                                        <form action="/replies/{{$reply->id}}/favourites" method="POST">
                                            {{ csrf_field() }}
                                        <button type="submit" class="btn btn-success float-right" {{$reply->isFavourited()?'disabled':''}}>{{$reply->favourites_count}} {{str_plural('Favourite',$reply->favourites_count)}}</button>
                                        </form>
                                       
                                    </div>
                                    <div class="card-body">                            
                                        <p class="card-text">  {{$reply->reply}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary float-right">Edit</button>

                                         @if(Auth::guard('expert')->id() == $reply->expert_id)
                                            <form action="/replies/{{$reply->id}}" method="post">
                                                {{csrf_field()}}
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                    
                                        {{$replies->links()}}
                                    
                                </div>                                         
                            @endforeach 
                            
                            @empty($reply)
                                <h5 class="text-danger">No replies yet</h5>
                            @endempty                            
                        </div>
                        <div class="card-footer">
                            {{-- If authenticated, Display form for replies --}}
                            @if(auth('expert')->check())
                                <div class="row">
                                    <div class="col-md-8">
                                        <form  class="form" method="POST" action="/threads/{{$thread->channel->channel}}/{{$thread->id}}/replies">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <p></p>
                                            <textarea class="form-control" name="reply" id="reply" rows="3" placeholder="Have something to say?"></textarea>
                                            <p></p>
                                            <button type="submit" class="btn btn-success">Reply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <p></p>
                                <p class="text-center">Please <a href="{{ route('expert.login') }}">sign in</a> to participate in this discussion.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>             

        {{-- This is the right (secondary) panel of the page --}}
        <div class="col-md-4">
            <div class="row">
                <div class="col-md">
                    <div class="card">
                        
                        <div class="card-body">
                        <p> This thread was created {{$thread->created_at->diffForHumans()}} by <a href="#">{{$thread->creator->last_name}}</a> and currently has {{$thread->replies_count}} {{str_plural('comment',$thread->replies_count)}}.
                        </p>
                        </div>
                           
                    </div>
                </div>
            </div>  
            
        </div> 
    </div>   
</div>
@endsection
