@component('profiles.activities.activity')
    @slot('heading')
{{$expertProfile->first_name}} favourited a <a href="/threads/{{$activity->subject->favourited->thread->channel->channel}}/{{$activity->subject->favourited->thread->id}}/#reply-{{$activity->subject->favourited->id}}">reply</a> by  {{$activity->subject->favourited->author->first_name}} {{$activity->subject->favourited->author->last_name}} <strong class="text-danger">{{$activity->created_at->diffForHumans()}}</strong>
    @endslot

    @slot('body')
        {!!$activity->subject->favourited->reply!!}
    @endslot

@endcomponent

