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
                            <h4>Your Profile</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr class="bg-success text-white">
                                    <th>Biodata</th>
                                    <th></th>
                                </tr>
                                @isset($expert)
                                <tr>
                                <td>First Name:</td>
                                <td><b>{{$expert->first_name}}</b></td>
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td><b>{{$expert->last_name}}</b></td>
                                </tr>
                                <tr>
                                    <td>Gender: </td>
                                    <td><b>{{$expert->gender}}</b></td>
                                </tr>
                                <tr>
                                    <td>DOB: </td>
                                    <td><b>{{$expert->birthday}}</b></td>
                                </tr>
                                <tr>
                                    <td>Profession:</td>
                                    <td><b>{{$expert->profession}}</b></td>
                                </tr>
                                <tr>
                                    <td>Employer:</td>
                                    <td><b>{{$expert->employer}}</b></td>
                                </tr>
                                <tr>
                                    <td>Designation:</td>
                                    <td><b>{{$expert->designation}}</b></td>
                                </tr>
                                <tr>
                                    <td>Registered Since:</td>
                                    <td><b>{{$expert->created_at}}</b> ({{$expert->created_at->diffForHumans()}})</td>
                                </tr>
                                @endisset                               
                            </table> 
                            <table class="table table-striped">
                                <tr class="bg-success text-white">
                                    <th >Your Stats</th>
                                    <th></th>
                                </tr>
                                @isset($a_count)
                                <tr>
                                    <td>No of answers provided by you:</td>
                                    <td><b>{{$a_count}}</b></td>
                                </tr>  
                                @endisset
                                @isset($b_count)
                                <tr>
                                    <td>No of articles written by you:</td>
                                    <td><b>{{$b_count}}</b></td>
                                </tr>  
                                @endisset                               
                            </table>                        
                         </div>
                        <div class="card-footer text-muted"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
