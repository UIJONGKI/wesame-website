@extends('layouts.app')
@section('script')
    <script type="text/javascript" src="{{URL::asset("js/main.js")}}"></script>
@stop

@section('content')

    <div id="main-container">
        <h2>Container-Area</h2>
            <div class="main-visual">
                <h2>Main-Visual-Area</h2>
                <ul class="main-film">
                    <li class="main-scene main-scene0">
                        <a href="#none" title="main0">
                            <p class="main-img-area">
                                    <img src="{{URL::asset('img/main_beta.jpg')}}" alt="main0"/>
                            </p>
                            <div class="main-text-area main-text-area0">
                                <div class="main-text-wrap main-text-wrap0">
                                    <a href="" title="main-img">
                                        <h3>
                                                <span></span>
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="main-scene main-scene1">
                        <a href="#none" title="main1">
                            <p class="main-img-area">
                                    <img src="{{URL::asset('img/main4.jpg')}}" alt="main1"/>
                            </p>
                            <div class="main-text-area main-text-area1">
                                <div class="main-text-wrap main-text-wrap1">
                                    <a href="" title="main-img">
                                        <h3>
                                                <span></span>
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="main-scene main-scene2">
                        <a href="#none" title="main2">
                            <p class="main-img-area">
                                    <img src="{{URL::asset('img/main5.jpg')}}" alt="main2"/>
                            </p>
                            <div class="main-text-area main-text-area2">
                                <div class="main-text-wrap main-text-wrap2">
                                    <a href="" title="main-img">
                                        <h3>
                                                <span></span>
                                        </h3>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="main-visual-btn-area">
                    <p class="main-visual-btn main-visual-btn-prev"><span></span></p>
                    <p class="main-visual-btn main-visual-btn-next"><span></span></p>
                </div>
            </div>
            <div class="artist-gallery-wrap">
                <div class="artist-gallery">
                    <h2>artist-gallery-Areas</h2>
                    <h3 class="artist-gallery-title">
                        artist gallery
                        <span>
                            Fashion changes, style remains.
                        </span>
                    </h3>
                    @include('layouts.partial.gallerylist')
                    <div class="artist-gallery-contents">
                        <ul>
                        @forelse($items as $item)
                            <li>
                                <a href="{{route('galleries.show', $item->id)}}" title="">
                                    <p class="artist-gallery-contents-img">
                                        @if(count($item->attachments)==0)
                                        <img alt="work" src="{{ URL::asset('img/artist1.jpg') }}"/>
                                        
                                        @else
                                        <img src="{{'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/'.$item->attachments[0]->filename}}" alt="contents"/>
                                        @endif
                                    </p>
                                    <div class="artist-gallery-contents-info">
                                        <h4 class="artist-gallery-contents-title">
                                            {{$item->title}}
                                        </h4>
                                        <span class="artist-gallery-contents-name">
                                            {{$item->user->name}}
                                        </span>
                                    </div>
                                </a>
                                
                            </li>
                        @empty
                            <p class="text-center text-danger">글이 없습니다.</p>
                        @endforelse
                        </ul>
                    </div>
                    <p class="artist-gallery-more">
                        <a href="{{ route('galleries.index')}}" title="artist-gallery-view-more">
                            view more   
                        </a>
                    </p>
                </div>
            </div>
            <div class="gallery-upload-wrap">
                <h2>gallery-upload-Area</h2>
                <div class="gallery-upload-left"></div>
                <div class="gallery-upload-right"></div>
                <div class="gallery-upload-area">
                    <div class="gallery-upload">
                        <div class="gallery-upload-title">
                            <span class="gallery-upload-title-text1 gallery-upload-title-text">
                                The loss of one's dignified bearing is often sudden.
                            </span>
                            <h4 class="gallery-upload-title-text2 gallery-upload-title-text">
                                You are a new artist.<br>
                                Come into the new sea.
                            </h4>
                            <span class="gallery-upload-title-text3 gallery-upload-title-text">
                                Energy and persistence conquer all things.
                            </span>
                        </div>
                        <div class="gallery-upload-btn-area">
                            <div class="gallery-upload-btn">
                                @if($currentUser ==null)
                                <a href="{{route('sessions.create')}}" onclick="alert('로그인이 필요합니다.(Login Needed)')" title="">
                                    <p>
                                        Upload
                                    </p>
                                    <p class="upload-btn-try">
                                        <span></span>
                                    </p> 
                                </a>
                                @else
                                <a href="{{ route('galleries.create') }}" title="">
                                    <p>
                                        Upload
                                    </p>
                                    <p class="apply-btn-try">
                                        <span></span>
                                    </p> 
                                </a>
                                @endif                       
                            </div>
                        </div>
                    </div> 
                </div>
            </div> 
            
            <div class="artist-wrap">
                <h2>Artist-Area</h2>
                <div class="artist-area">
                    <h3 class="artist-area-title">
                        the artist
                        <span>
                            Repetition is the death of art.
                        </span>
                    </h3>
                    <ul>
                        @if($randoms != null)
                        @forelse($randoms as $random)
                            @include('partials.randomArtists', ['artist' => $random])
                        @empty
                            <li><p>목록이 없습니다.</p></li>
                        @endforelse
                        @else
                            <li><p>목록이 없습니다.</p></li>
                        @endif
                    </ul>
                    <div class="artist-view-more-area">
                        <div class="artist-view-more-get">
                            <h4>
                                get your<br/> artist
                            </h4>
                            <span>art is anything you can get away with</span>
                        </div>
                        
                        <div class="artist-view-more-btn">
                            <a href="{{route('artists.index')}}" title="view more artist">
                                <p>
                                    view more artist
                                </p>
                                <p class="btn-try">
                                    <span></span>
                                </p>  
                            </a>
                        </div>
                    </div> 
                </div>
            </div>    
            <div class="artist-apply-wrap">
                <h2>Artist-Apply-Area</h2>
                <div class="artist-apply-left"></div>
                <div class="artist-apply-right"></div>
                <div class="artist-apply-area">
                    <div class="artist-apply">
                        <div class="artist-apply-title">
                            <span class="artist-apply-title-text1 artist-apply-title-text">
                                The loss of one's dignified bearing is often sudden.
                            </span>
                            <h4 class="artist-apply-title-text2 artist-apply-title-text">
                                You are a new artist.<br/>
                                Come into the new sea.
                            </h4>
                            <span class="artist-apply-title-text3 artist-apply-title-text">
                                Energy and persistence conquer all things.
                            </span>
                        </div>
                        <div class="artist-apply-btn-area">
                            <div class="artist-apply-btn">
                                @if($currentUser ==null)
                                <a href="{{route('sessions.create')}}" onclick="alert('로그인이 필요합니다.(Login Needed)')" title="">
                                    <p>
                                        Apply to artist
                                    </p>
                                    <p class="apply-btn-try">
                                        <span></span>
                                    </p> 
                                </a>
                                @else
                                <a href="{{url('apply')}}" title="">
                                    <p>
                                        Apply to artist
                                    </p>
                                    <p class="apply-btn-try">
                                        <span></span>
                                    </p> 
                                </a>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
            </div>        
            <div class="wesame-news-wrap">
                <h2>Wesame-News-Area</h2>
                <h3 class="wesame-news-title">
                    news
                    <span>
                        Fashion changes, style remains.
                    </span>
                </h3>
                <div class="wesame-news-video">
                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/DO4yqAc8jLo" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="wesame-news-area">
                    <ul class="wesame-news-list">
                        
                    
                    @forelse($news as $new)
                        <li>
                          <a href="{{route('articles.show', $new->id)}}" title="news">
                              <p class="btn-new-area">
                                  <span class="btn-new">NEW !</span>
                                  <span class="btn-more">more +</span>
                              </p>
                              <p class="wesame-news-text">
                                  {{$new->title}}
                              </p>
                          </a>
                       </li> 
                    @empty
                        <li><p>목록이 없습니다.</p></li>
                    @endforelse
                    </ul>
                    
                </div>
            </div>
            <div class="wesame-partnership-wrap">
                <p class="wesame-partnership-line"></p>
                <div class="wesame-partnership-area">
                    <div class="wesame-partnership-logo">
                        <img src="{{URL::asset("img/wesame_logo_sp.png")}}">
                    </div>
                    
                    <h3>
                        PARTNERSHIP
                    </h3>
                    <div class="wesame-partnership-list">
                        <ol class="wesame-partnership-list-gold">
                           <li>
                                <a href="http://www.kised.or.kr/" target="_blank">
                                    <img src="{{URL::asset("img/sp3.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                            <li>
                                <a href="http://www.kocca.kr/" target="_blank">
                                    <img src="{{URL::asset("img/sp4.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                        </ol>
                        <ol class="wesame-partnership-list-silver">
                            <li>
                                <a href="http://www.ani.seoul.kr/" target="_blank">
                                    <img src="{{URL::asset("img/sp2.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                            <li>
                                <a href="http://www.sfac.or.kr/html/main/index.asp" target="_blank">
                                    <img src="{{URL::asset("img/sp1.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                        </ol>
                        <ol class="wesame-partnership-list-bronze">
                            <li>
                                <a href="https://www.facebook.com/griplay" target="_blank">
                                    <img src="{{URL::asset("img/part1.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                            <li>
                                <a href="http://www.bricknart.com/" target="_blank">
                                    <img src="{{URL::asset("img/part2.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                            <li>
                                <a href="http://www.makepopstory.co.kr/" target="_blank">
                                    <img src="{{URL::asset("img/part3.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                            <li>
                                <a href="http://studioviper.com/" target="_blank">
                                    <img src="{{URL::asset("img/part4.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                            <li style="max-width:50px;">
                                <a href="http://www.jintoy.com/" target="_blank">
                                    <img src="{{URL::asset("img/part5.png")}}" alt="wesmae-partnership">
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>    
            </div>
    </div>
@endsection
