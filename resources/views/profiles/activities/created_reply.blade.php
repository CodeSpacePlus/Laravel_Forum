@component('profiles.activities.activity')
    @slot('heading')
        <i class="far fa-comment-dots"></i>
        {{ $profileUser->name }} replied to
        <a href="{{ $activity->subject->thread->path() }}">
            "{{ $activity->subject->thread->title }}"
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent
