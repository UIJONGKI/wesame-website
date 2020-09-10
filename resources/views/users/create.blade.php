@extends('layouts.sign')
@php
	$viewName='users.create'
@endphp
@section('style')
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/register.css')}}">
@stop
@section('content')
	<div id="sub-register-container">
		<div id="registerTitleArea">
			<div id="registerTitle">
                <a href="/" title="로고"><img src="{{URL::asset("img/wesame_signlogo_beta.png")}}" alt="logo"/></a>
				<h3>REGISTER FOR FREE</h3>
				<span></span>
			</div>
		</div>
		<div id="registerContentArea">
			<div id="registerContent">
				<h4 class="registerContentTitle">Be the first for exclusive content and competitions</h4>
				<p class="registerContentTitle2">FIND OUT MORE<span></span></p>
			</div>
			<div id="screen">
				<ul id="film">
					<li class="scene">
						<h4>Exhibiting and planning opportunities</h4>
						<p>WESAME leads the trend of kidult culture with the mind of a pioneer.</p>
						<span><img src="{{URL::asset("img/service-icon1-w.png")}}" alt="registerimg"/></span>
					</li>
					<li class="scene">
						<h4>Artist publicity</h4>
						<p>Receive match build-up, post-match summaries, and official news and videos - straight to your inbox.</p>
						<span><img src="{{URL::asset("img/service-icon2-w.png")}}" alt="registerimg"/></span>
					</li>
					<li class="scene">
						<h4>On/ Offline store launching</h4>
						<p>Watch match highlights, live friendlies and more.</p>
						<span><img src="{{URL::asset("img/service-icon3-w.png")}}" alt="registerimg"/></span>
					</li>
					<li class="scene">
						<h4>Offering WESAME artists' collaboration</h4>
						<p>Enable personalised content and express checkout.</p>
						<span><img src="{{URL::asset("img/service-icon4-w.png")}}" alt="registerimg"/></span>
					</li>
				</ul>
				<div id="resgisterBtn">
					<p class="resgisterNextBtn"></p>
					<p class="resgisterPrevBtn"></p>
				</div>
			</div>

		</div>
		<div id="registerSnsArea">
			<div id="registerSns">
				<p>Already have an account?</p><a href="{{ route('sessions.create') }}" title="login">Come On! Login</a>
				<h4>Register with your preferred social channel</h4>
				<ul>
					<li>
						<a title="facebook" href="{{ route('social.login', ['facebook']) }}">
							<img src="{{URL::asset("img/regi_facebook.png")}}" alt="facebook"/><img src="{{URL::asset("img/regiW_facebook.png")}}" alt="facebook" class="snsIconW"/>FACEBOOK
						</a>
					</li>
					<li>
                        <a href="{{ route('social.login', ['google']) }}" title="google">
                            <img src="{{URL::asset("img/regi_google.png")}}" alt="google"/><img src="{{URL::asset("img/regiW_google.png")}}" alt="facebook" class="snsIconW"/>Google</a>
                    </li>
				</ul>
			</div>
		</div>
		<div id="registerFormArea">
				<div id="registerForm">
					<h3>CREAT ACCOUNT</h3>
					<div class="registerForm-form">
						<form action="{{ route('users.store') }}" method="POST" class="form__auth ">
							{!! csrf_field() !!}
							
							<div class="formArea {{ $errors->has('name') ? 'has-error' : '' }}">
								<input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" autofocus />
								{!! $errors->first('name', '<span class="form-error">:message</span>') !!}
							</div>

							<div class="formArea {{ $errors->has('email') ? 'has-error' : '' }}">
						      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}"/>
						      {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
						    </div>

						    <div class="formArea {{ $errors->has('password') ? 'has-error' : '' }}">
						      <input type="password" name="password" class="form-control" placeholder="Password"/>
						      {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
						    </div>

						    <div class="formArea {{ $errors->has('password') ? 'has-error' : '' }}">
						      <input type="password" name="password_confirmation" class="form-control" placeholder="Re-Password" />
						      {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
						    </div>

							<div class="registerBtnArea">
								<button id="registerBtn" value="Register" type="submit">
									Register
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
@stop

@section('script')
	<script type="text/javascript" src="{{URL::asset("js/register.js")}}"></script>
@stop