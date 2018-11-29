@extends('layouts.app')

@section('content')
    <h1>Ask a Question</h1> 
    
    {!! Form::open(['action' => 'GistsController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control', 'placeholder'=>'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('gist','Body')}}
            {{Form::textarea('gist','',['id'=>'article-ckeditor','class'=>'form-control', 'placeholder'=>'Your Question'])}}
        </div>
        <div>
            {{-- {{Form::file('cover_image')}} --}}
        </div>
        {{Form::submit('Ask Question',['class'=>'btn btn-succcess'])}}
    {!! Form::close() !!}      
@endsection