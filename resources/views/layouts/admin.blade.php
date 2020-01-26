<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        {{-- 後の章で説明します -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
        {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/modal.js') }}" defer></script>
        <script src="{{ asset('js/jquery.rateit.min.js') }}" defer></script>
        <script src="{{ asset('js/rateit.event.js') }}" defer></script>
        <script src="{{ asset('js/report.js') }}" defer></script>
        <script src="{{ asset('js/review.update.js') }}" defer></script>
        <script src="{{ asset('js/game.update.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます --}}
        <link href="{{ asset('css/front.css') }}" rel="stylesheet">
        <link href="{{ asset('css/rateit.css') }}" rel="stylesheet">
        <link href="{{ asset('font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            {{-- 画面上部に表示するナビゲーションバーです。 --}}
            <nav class="navbar navbar-expand-md">
                <a class="nav-title" href="{{ action('Admin\ReviewController@index') }}">ゲームレビュー投稿（仮）<br>管理者ページ</a></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="ナビゲーションの切替">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-column" id="navbar">
                    <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                    @guest
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a></li>
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                    {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                    @else
                        <span class="py-0 mr-md-2 my-md-auto">
                            ようこそ {{ App\Profile::find(Auth::id())->user_name }} さん
                        </span>
                        <li class="nav-item active py-0 my-md-auto">
                          <a class="nav-link" href="{{ action('ReviewController@index') }}">一般ページ<span class="sr-only">(現位置)</span></a>
                        </li>
                        <a class="nav-link active pt-0 py-md-0 my-md-auto" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('messages.Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                    </ul>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}

            @if (count($errors) > 0)
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>
