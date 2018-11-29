@extends('layouts.app')

@section('content')
<p></p>
<a href="/blogs" class="btn btn-success">Go Back</a>
<p></p>
    <h3 class="text-primary">{{$blog->title}}</h3>  
    <br/>
<div>{!!$blog->blog!!}</div>
<div class="card-header bg-success text-black">    
    <div><em>Written by</em> <b>{{$blog->expert['first_name']}} {{$blog->expert['last_name']}}</b>, {{$blog->expert['designation']}} at {{$blog->expert['employer']}}. ({{$blog->created_at->diffForHumans()}})                    
    <p>This post has {{$blog->comments->count()}} comment(s).</p></div>                     
</div>  
<hr/>
<hr/>
<div class="card">
    <div class="card-header">Comments</div>
    <div class="card-body">
        {{-- Display Comments Here If Any --}}
        @if(count($comments)>0)
           @foreach ($comments as $comment)
                <div class="card">
                    <div class="card-body bg-light">                  
                        <p class="card-text">{!!$comment->comment!!}</p>
                        <hr/>
                        <div class="row">
                            <div class="col-9"></div>
                            <div class="col-3">By <b>{{$comment->user->alias}}</b> <em class="text-danger">{{$comment->created_at->diffForHumans()}}</em>
                            </div>                                
                        </div>  
                    </div>                  
                </div>
           @endforeach         
        @else
            <div class="text-danger">No comments yet...</div>
        @endif
      
    </div>
    @auth('web')
        <div class="card-footer text-muted">
            {{-- Form to submit an answer to a question --}}

            {!!Form::open(['route'=>['comments.store', $blog->id],'method'=>'POST'])!!}

                <div class="form-group">
                    {{Form::label('answer','Answer')}}
                    {{Form::textarea('comment','',['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Your Answer'])}}
                </div>

                {{Form::submit('Submit comment',['class'=>'btn btn-succcess'])}}

            {!!Form::close()!!}
        
        </div>
    @endauth
</div>

@endsection