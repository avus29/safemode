@extends('layouts.app')

@section('content')
    <h1>Blogs</h1>   
    @if(count($blogs)>0) 
        @foreach ($blogs as $blog)
        <div class="card card-body bg-light">          
            <h4><a href="blogs/{{$blog->id}}">{{$blog->title}}</a></h4>
            <div class="row">
                <div class="col-md-4"><em class="text-danger">Written by</em> <b>{{$blog->expert['first_name']}} {{$blog->expert['last_name']}}</b> 
                    <p>{{$blog->expert['designation']}} at {{$blog->expert['employer']}}</p>
                </div>
                <div class="col-md-4"> {{$blog->created_at->diffForHumans()}} </div>                    
                <div class="col-md-4 text-success">{{$blog->comments->count()}} comment(s).</div>                      
            </div>                                     
        </div>            
        @endforeach
        {{$blogs->links()}}                
    @else 
        <p>No posts found.</P>
    @endif
@endsection