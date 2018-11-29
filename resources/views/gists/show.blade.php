@extends('layouts.app')

@section('content')
<p></p>
<a href="/gists" class="btn btn-success">Go Back</a>
<p></p>
    <h3 class="text-primary">{{$gist->title}}</h3>  
    <br/>
<div>{!!$gist->gist!!}</div>
<hr/>
<hr/>
@if(!Auth::guest('web'))
    @if(Auth::user('web')->id ==$gist->author_id)
        <a href="/gists/{{$gist->id}}/edit" class="btn btn-info">Edit Question</a>
        {!!Form::open(['action'=>['GistsController@destroy',$gist->id],'method'=>'POST', 'class'=>'float-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endif
<hr/>
<hr/>
<div class="card">
    <div class="card-header"><h4 class="text-primary">Answers</h4></div>
    <div class="card-body">
        {{-- Display Comments Here If Any --}}
        @if(count($answers)>0)
           @foreach ($answers as $answer)
                <div class="card"> 
                    <div class="card-body bg-light">                  
                        <p class="card-text">{!!$answer->answer!!}</p>
                        <hr/>
                        <div class="row">
                            <div class="col-7"></div>
                            <div class="col-5">Answered <em class="text-danger">{{$answer->created_at->diffForHumans()}}</em>   by <b>{{$answer->expert->first_name}} {{$answer->expert->last_name}}</b>
                                <p class="text-primary">{{$answer->expert->designation}} at {{$answer->expert->employer}}</p>
                            </div>                                
                        </div>                    
                    </div>
                </div>
           @endforeach         
        @else
            <div class="text-danger">No answers yet...</div>
        @endif
      
    </div>
      {{-- Form to submit an answer to a question --}}
    @auth('expert')
        <div class="card-footer text-muted">      
            {!!Form::open(['route'=>['answers.store', $gist->id],'method'=>'POST'])!!}

                <div class="form-group">
                    {{Form::label('answer','Answer')}}
                    {{Form::textarea('answer','',['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Your Answer'])}}
                </div>

                {{Form::submit('Submit Answer',['class'=>'btn btn-succcess'])}}

            {!!Form::close()!!}
     </div>
    @endauth
    
</div>

@endsection