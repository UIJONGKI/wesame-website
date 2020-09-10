<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Hind');
    </style>
    <title>{{ config('app.name', 'Laravel') }}</title>

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

</head>
<body>
        @php
            $viewName = ""
        @endphp

    <div id="wrap">
        
        

        
        @yield('content')
        
    </div>
    
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    {{--<script src="{{ elixir('js/app.js') }}"></script>--}}
    <script src="{{ mix('/js/app.js') }}"></script>
    @yield('script')
</body>
</html>
