<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('css/img/talk.ico') }}">
    <title>{{ config('app.name') }}</title>
    {{-- <title>História em Quadrinhos</title> --}}

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Style -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" />

</head>
<body class="color-background">
    <div class="thetop"></div>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark cor-azul-escuro shadow-sm">
            <div class="container p-2">

                {{-- se logado, link é diferente de não logado --}}
                <a class="navbar-brand" href="@guest {{ url('/') }} @else {{ route('software.index') }} @endguest">
                    {{ config('app.name') }}
                </a>

                @if (Auth::check())
                    <a class="btn btn-outline-light ml-1" href="{{ route('software.create') }}" target="_parent">
                        <i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Software
                    </a>
                    <a class="btn btn-outline-light ml-1" href="{{ route('cliente.index') }}" target="_parent">
                        <i class="fas fa-address-book"></i> Clientes
                    </a>

                    @if (Auth::user()->privilegio > 0)
                        <a class="btn btn-outline-light ml-1" href="{{ route('gerencia.index') }}" target="_parent">
                            <i class="fas fa-cog"></i> Gerenciar
                        </a>
                    @endif
                @endif

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ nomeUsuario(Auth::user()->name) }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-info" href="{{ route('info.index', ['userId'=> Auth::user()->id]) }}">
                                        <i class="fas fa-info-circle"></i> Info
                                    </a>
                                    <a class="dropdown-item text-black-50" href="{{ route('usuario.index') }}">
                                        <i class="fas fa-user"></i> Perfil
                                    </a>

                                    <hr class="m-0">

                                    {{-- Logout --}}
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container py-4">
            <div class="row">
                <div class="col-12">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>

    {{-- <a href="#" class="scrollToTop">Scroll To Top</a> --}}

    <div class="scrolltop">
        <div class="scroll shadow-lg">
            <i class="fas fa-angle-up h4 m-0"></i>
        </div>
    </div>

    {{-- Scripts --}}
    {{-- <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script> --}}

    <script src="{{ asset('js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/hq/baixarHq.js') }}"></script>

    <script>
        $(document).ready(function() {
            $("body").tooltip({ selector: '[data-toggle=tooltip]' });
        });


        $(document).ready(function(){
            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('.scrolltop:hidden').stop(true, true).fadeIn();
                    // $('.scrolltop').animate({left:'-80px'},"500");
                    // return false
                } else {
                    $('.scrolltop').stop(true, true).fadeOut();
                    // return false
                }
            });
            $(function(){$(".scroll").click(function(){
                $("html,body").animate({scrollTop:$(".thetop").offset().top},"1000");
                return false
            })})
        });
    </script>

</body>
</html>
