<div class="sub-artist-board-side-nav-area">
    <div class="sub-artist-board-side-nav">
       <h3>

        @if($artist->advisors === 1)
            ADVISORS
        @else
            ARTISTS
        @endif

        </h3>
        <ul class="sub-artist-board-side-nav-menu">
            <li>
                <a href="{{route('artists.show', $artist->id)}}">
                    GALLERY
                </a>
            </li><br/>
            <li>
                <a href="{{route('artists.board', $artist->id)}}">
                    BOARD
                </a>
            </li><br/>
        </ul>
    </div>
</div>