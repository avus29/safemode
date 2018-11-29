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
                        Welcome {{Auth::user()->first_name}}, below are questions awaiting answers
                        </div>
                        <div class="card-body">                            
                            @include('components.gists')                            
                    </div>
                        <div class="card-footer text-muted"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
