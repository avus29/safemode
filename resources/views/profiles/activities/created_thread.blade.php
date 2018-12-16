@component('profiles.activities.activity')
    @slot('heading')
        {{$expertProfile->first_name}} published a thread <a href="/threads/{{$activity->subject->channel->slug}}/{{$activity->subject->id}}">{!!$activity->subject->title!!} </a><strong class="text-danger">{{$activity->created_at->diffForHumans()}}</strong>
    @endslot

    @slot('body')
        {!!$activity->subject->thread!!}   
    @endslot

@endcomponent
