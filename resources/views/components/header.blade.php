<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="me-1" src="{{ asset('img/logo.png') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item pt-0 pb-2" href="{{ route('mypage',Auth::id()) }}"> 
                                    マイページ
                                    </a>

                                    <hr class="m-0">

                                    <a class="dropdown-item pt-2 pb-2" href="{{ route('mypage.show_ikitai') }}"> 
                                    行きたい投稿一覧
                                    </a>

                                    <hr class="m-0">

                                    <a class="dropdown-item pt-2 pb-2" href="{{ route('mypage.show_empathy') }}"> 
                                    共感した投稿一覧
                                    </a>

                                    <hr class="m-0">

                                    <a class="dropdown-item pt-2 pb-2" href="{{ route('mypage.edit') }}"> 
                                    会員情報の編集/削除
                                    </a>

                                    <hr class="m-0">

                                    <a class="dropdown-item pt-2 pb-2" href="{{ route('mypage.edit_password') }}"> 
                                    パスワードの変更
                                    </a>

                                    <hr class="m-0">

                                    <a class="dropdown-item pb-0 pt-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>