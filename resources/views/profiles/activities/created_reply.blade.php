@component('profiles.activities.activity')
    @slot('heading')
        {{$expertProfile->first_name}} replied to thread <a href="/threads/{{$activity->subject->thread->channel->slug}}/{{$activity->subject->thread->id}}">{{$activity->subject->thread->title}}</a> <strong class="text-danger">{{$activity->created_at->diffForHumans()}}</strong>
    @endslot

    @slot('body')
        {!!$activity->subject->reply!!}
    @endslot

@endcomponent
