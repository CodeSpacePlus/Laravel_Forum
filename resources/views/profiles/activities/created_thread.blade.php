@component('profiles.activities.activity')
    @slot('heading')
        <i class="fas fa-chalkboard"></i>
        {{ $profileUser->name }} published
        <a href="{{ $activity->subject->path() }}">
            "{{ $activity->subject->title }}"
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->body }}
    @endslot
@endcomponent