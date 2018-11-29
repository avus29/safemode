@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1> 
    
    {!! Form::open(['action' => ['BlogsController@update', $blog->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$blog->title,['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        {{-- <img src="/storage/cover_images/{{$post->cover_image}}" style="width:50%">  --}}
        <br/><br/>
        <div class="form-group">
            {{Form::label('blog','Body')}}
            {{Form::textarea('blog',$blog->blog,['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        <div>
                {{Form::file('cover_image')}}
            </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-success'])}}
    {!! Form::close() !!}      
    
@endsection