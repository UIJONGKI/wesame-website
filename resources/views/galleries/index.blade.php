@extends('layouts.app')

@section('content')
	@php $viewName = 'galleries.index'; @endphp
	<div id="sub-gallery-container">
		<h2>Sub-Gallery-Area</h2>
        <div class="sub-gallery-month">
            <ul>
                <li>
                    <a href="" title="">
                        
                    </a>
                </li>
            </ul>
            <img src="{{URL::asset("img/sample-bg.png")}}">
        </div>
		<div class="sub-gallery-title">
            <h3>
                KIDULT GALLERY
            </h3>
        </div>
        <div class="sub-gallery-area">
            
            <div class="sub-gallery-nav">
            	
            	@include('gtags.partial.index')
            </div>
            <div class="sub-gallery-works-area">
	            <ul class="sub-gallery-works">
	            	@forelse($galleries as $gallery)
						@include('galleries.partial.gallery', compact('gallery', 'viewName'))
					@empty
						<p class="text-center text-danger">글이 없습니다.</p>
					@endforelse
				</ul>
            </div>
            <div class="sub-gallery-works-uploadbtn">
                @if ($currentUser == null)
                <a href="{{route('sessions.create')}}" onclick="alert('로그인이 필요합니다.')" class="">
                    <i class=""></i>UPLOAD
                </a>
                
                @else
                <a href="{{ route('galleries.create') }}" class="">
                    <i class=""></i>UPLOAD
                </a>
                @endif
                
            </div>
            
            @if($galleries->count())
				<div class="text-center">
					{!! $galleries->appends(Request::except('page'))->render() !!}
				</div>
			@endif
        </div>
		
	</div>

@stop	