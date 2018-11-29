@extends('layouts.app')

@section('content')
    <h1>Write an Article</h1> 
    
    {!! Form::open(['action' => 'BlogsController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('blog','Body')}}
            {{Form::textarea('blog','',['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Your Question'])}}
        </div>
        <div>
            {{-- {{Form::file('cover_image')}} --}}
        </div>
        {{Form::submit('Submit Article',['class'=>'btn btn-succcess'])}}
    {!! Form::close() !!}      
@endsection