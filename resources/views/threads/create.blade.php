@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <p></p>
                <div class="card-header text-primary">
                    <h4>Create a New Thread</h4> 
                </div>
                <div class="card-body">
                    {!! Form::open(['action' => 'ThreadsController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                        <div class="form-group">
                          <label for="channel_id">Category</label>
                          <select class="form-control" name="channel_id" id="channel_id" required autofocus>
                            <option value="">Choose one...</option>
                            @foreach ($channels as $channel)
                                <option value="{{$channel->id}}" {{old('channel_id') == $channel->id?'selected':''}}>{{$channel->channel}}</option>
                            @endforeach                           
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Title goes here..." value="{{old('title')}}" required autofocus>
                        </div>

                        <div class="form-group">
                                <div class="form-group">
                                  <label for="thread">Thread:</label>
                                  <textarea class="form-control" name="thread" id="article-ckeditor" rows="8" placeholder="Got something to say?" value="{{old('thread')}}" required autofocus></textarea>
                                </div>
                       
                        <div>
                            {{-- {{Form::file('cover_image')}} --}}
                        </div>
                        <button type="submit" class="btn btn-success">Publish Thread</button>
                       
                    {!! Form::close() !!}  
                </div>
            </div>
           

           
        </div>
    </div>
</div>
@endsection
