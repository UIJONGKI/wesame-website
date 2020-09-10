@extends('layouts.app')

@section('content')

	<div id="sub-personal-info">
            <div class="sub-personal-info-contents">
                <div class="sub-personal-info-contents-title">
                    <h3>
                        PERSONAL INFORMATION
                    </h3>
                </div>
                <div class="sub-personal-info-contents-form">
                    <form enctype="multipart/form-data" action="{{ route('accounts.update') }}" method="post">
                    	{!! csrf_field() !!}
                        <fieldset>
                            <div class="sub-personal-info-contents-form-profileimg"> 
                                @if($currentUser->avatar=='default.jpg')
                                <p class="sub-personal-info-contents-form-profileimg-default">
                                </p>
                                @else
                                <p class="sub-personal-info-contents-form-profileimg-img">
                                    <img src="{{'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/avatars/'.$currentUser->avatar }}">
                                </p>
                                @endif
                                <p class="sub-personal-info-contents-form-profileimg-title">
                                    Profile Image
                                </p>
                                <div class="sub-personal-info-contents-form-profileimg-btn">
                                    <input type="file" name="avatar"> 
                                    <p class="sub-personal-info-contents-form-profileimg-btn-red">
                                        (400 * 400 px 이상)
                                    </p>
                                </div>
                                {!! $errors->first('avatar', '<span class="form-error">:message</span>') !!}
                            </div>
                            <p>
                                <label for="personal-email">
                                    E-mail
                                </label>
                                {{$currentUser->email}}
                                <input type="hidden" name="email" value="{{$currentUser->email}}">
                            </p>
                            <p>
                                <label for="personal-Name">
                                    Name
                                </label>
                                <input type="text" id="personal-name" name="name" value="{{$currentUser->name}}" required>
                                {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
                            </p>
                            
                            <p>
                                <label for="personal-pass">
                                    New Password <span class="personal-pass-red">(If needed)</span>
                                </label>
                                <input type="password" id="personal-pass" name="newPassword" placeholder="New Password">
                                {!! $errors->first('newPassword', '<span class="form-error">:message</span>') !!}
                            </p>
                            <p>
                                <label for="personal-pass">
                                    Password
                                </label>
                                <input type="password" id="personal-pass" name="password" placeholder="Password" required>
                                {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
                            </p>
                            <p>
                                <label for="personal-pass-confirm">
                                    Confirm Password
                                </label>
                                <input type="password" id="personal-pass-confirm" name="password_confirmation" placeholder="Re-Password" required>
                                {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
                            </p>
                            
                            <p class="personal-button">
                               <button class="personal-button-submit">SUBMIT</button> 
                               <button class="personal-button-cancel">CANCEL</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="sub-personal-info-contents-gallery">
                <div class="sub-personal-info-contents-gallery-title">
                    <h3>
                        ADDITIONAL INFORMATION
                    </h3>
                </div>
                    <ol class="sub-personal-info-contents-gallery-nav">
                        <li>
                            Item Id
                        </li>
                        <li>
                            Item Title
                        </li>
                        <li>
                            Created at
                        </li>
                        <li>
                            view count
                        </li>
                    </ol>
                    <div class="sub-personal-info-contents-gallery-goods">
                        @forelse($currentUser->galleries()->paginate(5) as $item)
                        <a href="{{route('galleries.show', $item->id)}}">
                            <ul>
                                <li>
                                    {{$item->id}}
                                </li>
                                <li>
                                    {{$item->title}}
                                </li>
                                <li>
                                    {{$item->created_at->format('d M Y')}}
                                </li>
                                <li>
                                    {{$item->view_count}}
                                </li>
                            </ul>
                        </a>
                        @empty
                        <ul>
                            <li>올리신 갤러리 물품이 없습니다.</li>
                        </ul>
                        @endforelse
                    </div>    
                    @if($currentUser->galleries()->count())
                        <div class="text-center">
                            {!! $currentUser->galleries()->paginate(5)->appends(Request::except('page'))->render() !!}
                        </div>
                    @endif
            </div>   
        </div>
@stop

