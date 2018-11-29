@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-body">
                   
                        <h3>Your Questions</h3>
                        @if(count($gists)>0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($gists as $gist)
                                    <tr>
                                        <td>{{$gist->title}}</td>
                                       
                                        <td><a href="/gists/{{$gist->id}}/edit" class="btn btn-primary"> Edit</a></td>
                                        <td>{!!Form::open(['action'=>['GistsController@destroy',$gist->id],'method'=>'POST', 'class'=>'pull-right'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                                        {!!Form::close()!!}</td>
                                        
                                    </tr>
                                   
                                @endforeach
                            </table>
                        @else
                            <h4>You have no questions.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
