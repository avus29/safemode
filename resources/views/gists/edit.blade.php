@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1> 
    
    {!! Form::open(['action' => ['GistsController@update', $gist->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$gist->title,['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        {{-- <img src="/storage/cover_images/{{$post->cover_image}}" style="width:50%">  --}}
        <br/><br/>
        <div class="form-group">
            {{Form::label('gist','Body')}}
            {{Form::textarea('gist',$gist->gist,['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        <div>
                {{Form::file('cover_image')}}
            </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-success'])}}
    {!! Form::close() !!}      
    
@endsection