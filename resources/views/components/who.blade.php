@if(Auth::guard('web')->check())
    <p class="text-success">You are logged in as a <strong>USER</strong></p>
@else
    <p class='text-danger'>You are logged out as a <strong>USER</strong></p>
@endif

@if(Auth::guard('expert')->check())
    <p class="text-success">You are logged in as an <strong>EXPERT</strong></p>
@else
    <p class='text-danger'>You are logged out as an <strong>EXPERT</strong></p>
@endif