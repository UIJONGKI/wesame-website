<li class="wesame-artist">
    <a href="{{route('artists.show', $artist->id)}}" alt="">
        @include('users.partial.mainpage', ['user' => $artist])
        <h4 class="artist-name">
            {{$artist->name}} 작가
        </h4>
        <span class="artist-introduce">
            Creativity is allowing yourself to make mistakes. Art is knowing which ones to keep
        </span>
    </a>
</li>