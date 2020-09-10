@extends('layouts.app')
@section('style')
	<style>
		.img-thumbnail {width:48px;}
	</style>
@stop
@section('content')

<div id="artist-container">
	<div class="artist-main-visual">
        <img src="">
    </div>
    <div class="sub-artist-area">
        <div class="sub-artist-advisors">
            <div class="sub-artist-advisors-visual">
                <img src="{{URL::asset('img/sub-advisors-bg2.png')}}" alt="sub-artist-bg">
                <h3>
                    ADVISORS
                </h3>
            </div>
             <ol class="sub-artist-advisors-members">
                @forelse($advisors as $advisor)
				<li>
					<a href="{{route("artists.show", $advisor->id)}}" title="advisor">
						@include('users.partial.advisor', ['user' => $advisor])
						<h4 class="sub-artist-cate-advisors">
		                	ADVISOR
		                </h4>
		                <p>
		                    {{$advisor->name}} 자문위원
		                </p>
					</a>
				</li>
				@empty
					<p>목록이 없습니다.</p>
				@endforelse
            </ol>

        </div>
        <div class="sub-artist-artists">
            <div class="sub-artist-artists-visual">
                <img src="{{URL::asset('img/sub-artist-bg.png')}}" alt="sub-artist-bg">
                <h3>
                    ARTISTS
                </h3>
            </div>
            <ol class="sub-artist-artists-members">
				@forelse($artists as $artist)
				<li>
					<a href="{{route("artists.show", $artist->id)}}" title="artists">
						@include('users.partial.artist', ['user' => $artist])
						<h4 class="sub-artist-cate-advisors">
		                	ARTIST
		                </h4>
		                <p>
		                    {{$artist->name}}작가
		                </p>
					</a>
				</li>
				@empty
					<p>목록이 없습니다.</p>
				@endforelse
			</ol>
    	</div>
	
	</div>
</div>



@stop