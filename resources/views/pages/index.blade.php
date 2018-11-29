@extends('layouts.app')

@section('content')
<br/>
<div class="jumbotron">
    <h1 class="display-3">{{config('app.name','GistMed')}}</h1>
    <p class="lead">Here to answer your questions and give you second opinion about your health issues.</p>
    <hr class="my-2">
    <p></p>
    <p class="lead">
        <a class="btn btn-success btn-lg" href="/gists/create" role="button">Ask a Question now!</a>
    </p>
</div>
<h1>{{$title}}</h1>
<p>Proudly Nigeria...</p>
<hr/><hr/>
<div class="row">
    <div class="col-md-4">
        {{-- 1st Column goes here... -- --}}
        <div class="card">
            <div class="card-header  bg-success text-white"><b>Recent Questions</b></div>
            <div class="card-body">
                {{-- Populate with recent questions --}}
                @if(count($gists)>0) 
                    @foreach ($gists as $gist)
                    <div class="card card-body bg-light">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                            <h4><a href="gists/{{$gist->id}}">{{$gist->title}}</a></h4>             
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><em class="text-danger">Asked by</em> <b>{{$gist->user['alias']}}</b> </div>
                            <div class="col-md-4"> {{$gist->created_at->diffForHumans()}} </div>                    
                            <div class="col-md-4 text-success">{{$gist->answers->count()}} answer(s).</div> 
                        </div>  
                                            
                    </div>            
                    @endforeach              
                @else 
                    <p>No posts found.</P>
                @endif
            </div>
            <div class="card-footer text-muted">
                <a href="/gists">More Questions</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
         {{-- 2nd Column goes here... -- --}}
        <div class="card">
            <div class="card-header bg-success text-white"><b>Forum</b></div>
            <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, alias illum? Accusamus nemo neque eveniet tenetur deserunt consequatur delectus, molestiae reprehenderit, placeat dolor sed ratione nobis explicabo natus soluta ullam.</p>
            </div>
            <div class="card-footer text-muted">
                More...
            </div>
        </div>
    </div>
    <div class="col-md-4">
         {{-- 3rd Column goes here... -- --}}
        <div class="card">
            <div class="card-header  bg-success text-white"><b>Articles & News</b></div>
            <div class="card-body">
                {{-- Populate with Blogs --}}
                @if(count($blogs)>0) 
                    @foreach ($blogs as $blog)
                    <div class="card card-body bg-light">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <h5><a href="blogs/{{$blog->id}}">{{$blog->title}}</a></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1"><em class="text-danger">Written by</em> <b>{{$blog->expert['first_name']}} {{$blog->expert['last_name']}} </b>
                                <p><em class="text-info">{{$blog->expert['designation']}} at {{$blog->expert['employer']}}</em></p>
                            </div>
                        </div>                       
                    </div>            
                    @endforeach               
                @else 
                    <p>No articles found.
                @endif   
            </div>
            <div class="card-footer text-muted">
                    <a href="/blogs">More Articles</a>
            </div>
            
        </div>
    </div>
</div>
@endsection