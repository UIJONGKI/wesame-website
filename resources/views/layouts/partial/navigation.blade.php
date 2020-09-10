<header id="header">
    <h2>Header-Area</h2>
    <div class="header-area">
        <h1>
        <a href="{{ url('/') }}" title="wesame-logo">
            <img src="{{URL::asset('img/wesame_logo_beta2.png')}}" alt="wesame-logo">
        </a>
        </h1>
        <div class="gnb-top-area">
            <h2>Gnb-Top-Wrap-Area</h2>
            <ol class="gnb-top">
                @if (Auth::guest())
                    <li class="gnb-top-register">
                        <a href="{{ route('users.create') }}" title="Register">
                            Sign In 
                            <span class="var"></span>
                        </a>
                    </li>
                    <li class="gnb-top-login">
                        <a href="{{ route('sessions.create') }}" title="Login">
                            Login
                            <span></span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{route('accounts.index')}}">
                              {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sessions.destroy') }}">
                            Logout
                        </a>
                    </li>
                @endif
                <li class="gnb-top-language">
                            <a href="#none" title="language">
                                <span class="language-img"><img src="{{URL::asset("img/flag_usa.png")}}" alt="flag_usa"></span>
                                <span class="language-title">Eng</span>
                            </a>
                        </li>
            </ol>
        </div>
        <div class="gnb-area">
            <h2>Gnb-Wrap-Area</h2>
            <ul class="gnb">
                <li>
                    <a href="/about">About</a>
                </li>
                <li>
                    <span class="gnb-slash"></span>
                </li>
                <li>
                    <a href="{{ route('artists.index') }}">Artists</a>
                </li>
                <li>
                    <span class="gnb-slash"></span>
                </li>
                <li>
                    <a href="{{ route('galleries.index') }}">Gallery</a>
                </li>
                <li>
                    <span class="gnb-slash"></span>
                </li>
                <li>
                    <a href="{{ route('articles.index') }}">News</a>
                </li>
                <li>
                    <span class="gnb-slash"></span>
                </li>
                <li>
                    <a href="/contactUs">Contacts Us</a>
                </li>
                
            </ul>
        </div>
    </div>
</header>
