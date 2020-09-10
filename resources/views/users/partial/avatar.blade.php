@if($user->avatar === "default.jpg")
	<p class="sub-gallery-work-profile-img">
		<img src="{{ URL::asset('img/basic_profile.png') }}" >
	</p>
@else
	<p class="sub-gallery-work-profile-img">
		<img src="{{'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/avatars/'.$user->avatar }}" >
	</p>
@endif