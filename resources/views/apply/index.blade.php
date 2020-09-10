@extends('layouts.app')
@section('content')

	<div id="sub-apply-container">
		<div class="sub-apply-container-visual">
                <img src="{{URL::asset('img/apply-bg.jpg')}}" alt="apply-bg">
            </div>
	</div>
	<div class="sub-apply-container-contents">
		<div class="sub-apply-container-contents-title">
			<h3>
                Artist-Apply
            </h3>
            <div class="service-text">
               
               <h4>
                   WESAME runs an artist agency system for artists.<br/>
                   Through this system, you can build your career in a better environment.
               </h4>
               <ol class="service-text-content">
                   <li>
                       <p>
                           <img src="img/service-icon1.png" alt="service-icon">
                       </p>
                       <h4>
                           Exhibiting and planning opportunities
                       </h4>
                   </li>
                   <li>
                       <p>
                           <img src="img/service-icon2.png" alt="service-icon">
                       </p>
                       <h4>
                           Artist publicity
                       </h4>
                   </li>
                   <li>
                       <p>
                           <img src="img/service-icon3.png" alt="service-icon">
                       </p>
                       <h4>
                           On/ Offline store launching
                       </h4>
                   </li>
                   <li>
                       <p>
                           <img src="img/service-icon4.png" alt="service-icon">
                       </p>
                       <h4>
                           Offering WESAME artists' collaboration
                       </h4>
                   </li>
               </ol>
           </div>
		</div>
		<div class="sub-apply-container-contents-form">
			<form action="{{ url('apply') }}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				@include('apply.partial.form')
				<button class="apply-button-submit" type="submit" >SUBMIT</button> 
                <button type="button" class="apply-button-cancel" onclick="window.location'{{ URL::previous() }}'">CANCEL</button>
			</form>
		</div>
	</div>
@stop
