@extends('layouts.app')

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-3">
               <article >
                    {{$expertProfile->last_name}} {{$expertProfile->first_name}}
                    <p>Member since {{$expertProfile->created_at->diffForHumans()}} </p>
               </article>

           </div>

           <div class="col-md-9">
               <h3 class="text-warning">Threads by {{$expertProfile->last_name}} {{$expertProfile->first_name}}</h3>
                <div class="card-body">
                        @forelse ($activities as $date => $records)
                            <h3 class="page-header">{{$date}}</h3>
                            @foreach($records as $activity)
                                @if(view()->exists("profiles.activities.{$activity->type}"))
                                     @include("profiles.activities.{$activity->type}") 
                                @endif
                            @endforeach   
                        @empty($activities)
                            <p>There is no activity for this user yet.</p>
                        @endempty                        
                        @endforelse
                </div>
                {{-- {{$threads->links()}} --}}
           </div>
       </div>

    </div> 
@endsection