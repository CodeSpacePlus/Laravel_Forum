@component('profiles.activities.activity')
    @slot('heading')
        <i class="far fa-heart" style="color:red;"></i>
       <a href="{{ $activity->subject->favorited->path() }}">
            {{ $profileUser->name }} favorited a reply
       </a>
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent
