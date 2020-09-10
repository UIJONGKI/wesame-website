<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="naver-site-verification" content="7c8b67297db46a25405cc9c8c5200fcf57f43769"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
    <title>{{ config('app.name', 'Laravel') }}-위세임</title>
    <meta name="description" content="WESAME(위세임)-크라우드&협업 방식의 콘텐츠 제작 기획사">
    <meta name="keywords" content="키덜트, 캐릭터, 콘텐츠, 예술, 엔터테인먼트, 크라우드펀딩, 디자인, 브랜딩">
    <meta property="og:type" content="website">
    <meta property="og:title" content="WESAME(위세임)-크라우드&협업 방식의 콘텐츠 제작 기획사">
    <meta property="og:description" content="WESAME(위세임)-크라우드&협업 방식의 콘텐츠 제작 기획사">
    <meta property="og:url" content="http://www.wesame.co.kr">

     <link rel="shortcut icon" href="{{{ asset('img/wesame_new_favicon.png') }}}">
    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    {{--<link rel="stylesheet" href="{{ elixir('css/app.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset("css/style.css")}}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <!--// ...-->    

    @yield('style')
    
    <script>
        window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
          'currentUrl' => $currentUrl,
          'currentUser' => $currentUser,
         ]); ?>
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90551535-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-90551535-2');
    </script>
</head>
<body>
    
        @php
            $viewName = ""
        @endphp
        
    
        
    <div id="wrap">
        
        @if($viewName === 'users.create')

        @else

            @include('layouts.partial.navigation')
        @endif
            
        
        @if (session('alert'))
            <div class="alert alert-success">
                <p style="display: inline-block; background-color: white; border-radius: 5px; padding: 10px;">
                {{ session('alert') }}
                </p>
            </div>
        @endif
        @yield('content')
        

        @include('layouts.partial.footer')
  
    </div>
    
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    {{--<script src="{{ elixir('js/app.js') }}"></script>--}}
    <script src="{{ mix('/js/app.js') }}"></script>
    
    @yield('script')
</body>
</html>
