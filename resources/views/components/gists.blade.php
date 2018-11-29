<h1>Recent Questions</h1>   
@if(count($gists)>0) 
    @foreach ($gists as $gist)
        <div class="card card-body bg-light">
            <div class="row">
                <div class="col-md-2">
                    <img src="avatar/funky_capsule.png" style="height:50px;">
                </div>
                <div class="col-md-8">
                <h4><a href="gists/{{$gist->id}}">{{$gist->title}}</a></h4>
                    <div class="row">
                        <div class="col-md-4"><em class="text-danger">Asked by</em> <b>{{$gist->user['alias']}}</b> </div>
                        <div class="col-md-4"> {{$gist->created_at->diffForHumans()}} </div>                    
                        <div class="col-md-4 text-success">{{$gist->answers->count()}} answer(s).</div>                    
                    </div>   
                </div>
                <div class="col-md-2">
                    <img src="avatar/mortar.png"/>
                </div>     
            </div>                       
        </div>            
    @endforeach
    {{$gists->links()}}                
@else 
    <p>No posts found.</P>
@endif