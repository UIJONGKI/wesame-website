@extends('layouts.app')
@section('style')
  <style>
    .login-or {
      position: relative;
      margin-top: 20px;
      margin-bottom: 20px;
      padding-top: 15px;
      padding-bottom: 15px;
    }

    .span-or {
      display: block;
      position: absolute;
      left: 50%;
      top: 5px;
      background-color: #fff;
      margin-left: -25px;
      width: 50px;
      text-align: center;
    }

    .hr-or {
      margin-top: 0px !important;
      margin-bottom: 0px !important;
    }

    .fa-facebook {
      margin-right: 10px;
    }
  </style>
@endsection
@section('content')
	<div class="wesame-login-container">
    	<div class="wesame-login-box">
			<form action="{{ route('sessions.store') }}" method="POST" class="form__auth">
				{!! csrf_field() !!}	    
			    <h3>LOGIN</h3>
			    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} wesame-login-email">
			     	<input type="email" name="email" class="form-control" placeholder="Enter Your E-mail" value="{{ old('email') }}" autofocus/>
			      	{!! $errors->first('email', '<span class="form-error">:message</span>') !!}
			    </div>
			    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} wesame-login-pass">
			      	<input type="password" name="password" class="form-control" placeholder="Enter Your Password">
			      	{!! $errors->first('password', '<span class="form-error">:message</span>')!!}
			    </div>
			    <div class="form-group wesame-login-btn">
					<button class="btn btn-primary btn-lg btn-block" type="submit">
						Login
					</button>
				</div>
				<div class="form-group wesame-login-facebook-btn">
					<a class="btn btn-default btn-lg btn-block" href="{{ route('social.login', ['facebook']) }}">
						<i class="fa fa-facebook"></i>
						<p>
							Facebook
						</p>
					</a>
				</div>
				<div class="form-group wesame-login-googleplus-btn">
					<a class="btn btn-default btn-lg btn-block" href="{{ route('social.login', ['google']) }}">
						<i class="fa fa-google-plus"></i>
						<p>
							Google+
						</p>
					</a>
				</div>
			    <div class="form-group wesame-login-checkbox">
	    			<input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked>
	    			<label>Stay signed in</label>
					<a href="{{ route('remind.create') }}" class="wesame-login-findpass">
						Find password
					</a>
			    </div>
			</form>
			<div class="wesame-login-signup">
				<a href="{{ route('users.create') }}">
					Not yet a member? <span>Sign Up</span>
				</a>
			</div>
		</div>
    </div>
	
@stop