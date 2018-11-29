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

                <div>
                    <h2 class="text-primary">This is the <em>Admin</em> page boy!</h2>
                </div>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
