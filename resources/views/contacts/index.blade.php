@extends('layouts.app')

@section('content')
<div id="sub-contacts-container">
            <div class="sub-contacts-container-visual">
                <img src="{{URL::asset('img/contacts-bg.png')}}" alt="contacts-bg">
            </div>
            <div class="sub-contacts-container-contents">
                <div class="sub-contacts-container-contents-title">
                    <h3>
                        CONTACT US
                    </h3>
                    <p>
                        If you have any inquiries, such as sales of works, exhibition planning,<br/>
                        I will answer you sincerely.
                    </p>
                </div>
                <div class="sub-contacts-container-contents-form">
                    <form action="{{ url('contactUs') }}" method="post" enctype="multipart/form-data">
                    	{!! csrf_field() !!}
                    	@include('contacts.partial.form')
						<p class="contacts-button">
						   <button type="submit">SUBMIT</button> 
						</p>
                            
                           
                    </form>
                </div>
            </div>
        </div>
@stop
