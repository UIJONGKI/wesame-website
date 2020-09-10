@extends('layouts.app')

@section('content')
<div class="findpass-containter">
	<form action="{{ route('remind.store') }}" method="POST" role="form" class="form__auth">
		{!! csrf_field() !!}
		<div class="page-header">
			<h4>Find Password</h4>
		</div>

		<div class="form-group">
			<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" autofocus>
			{!! $errors->first('email', '<span class="form-error">:message</span>') !!}
		</div>
		<p class="findpass-btn">
			<button class="btn btn-primary btn-lg btn-block" type="submit">
		      Request
		    </button>
		</p>
	</form>
</div>
@stop