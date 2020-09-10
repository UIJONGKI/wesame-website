<div class="artist-board-profile">
	@include('users.partial.boardProfile', ['user' => $artist])
	<div class="artist-board-profile-text">
        <h3 class="artist-board-profile-text-name">
            {{$artist->name}}
        </h3>
        <span class="artist-board-profile-text-advisors">
            ARTIST
        </span>
        @if ($artist->description == null)
        <p class="artist-board-profile-text-info">
            소개글이 작성되지 않았습니다.
        </p>
        @else
        <p class="artist-board-profile-text-info">
            {!! markdown($artist->description) !!}
        </p>
        @endif
    </div>
</div>