@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="content" class="container">
            <div class="row">
                <!--Sidebar goes here-->
                @component('components.sidebar')                
                @endcomponent
                <!--Main content goes here-->
                <div class="col-md-9">
                    <h3> </h3>
                    <div class="card">
                        <div class="card-header">
                        Welcome {{Auth::user()->first_name}}, below are your articles
                        </div>
                        <div class="card-body">                            
                                <h3>Your Articles</h3>
                                @if(count($blogs)>0)
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Title</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        @foreach ($blogs as $blog)
                                            <tr>
                                                <td>{{$blog->title}}</td>
                                               
                                                <td><a href="/blogs/{{$blog->id}}/edit" class="btn btn-primary"> Edit</a></td>
                                                <td>{!!Form::open(['action'=>['BlogsController@destroy',$blog->id],'method'=>'POST', 'class'=>'pull-right'])!!}
                                                    {{Form::hidden('_method','DELETE')}}
                                                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                                {!!Form::close()!!}</td>
                                                
                                            </tr>
                                           
                                        @endforeach
                                    </table>
                                @else
                                    <h4>You have no articles.</h4>
                                @endif                          
                    </div>
                        <div class="card-footer text-muted"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
