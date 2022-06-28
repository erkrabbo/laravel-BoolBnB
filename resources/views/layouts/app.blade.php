<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Boolbnb') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Braintree --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.33.2/js/dropin.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-absolute">
        <div class="container">
            @include('partials.login-form')
            @include('partials.register-form')
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="/images/boolbnb.webp" alt="Boolbnb" class="img_Boolbnb">
                <span class="red">{{ config('app.name', 'Boolbnb') }}</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#loginModal">Accedi</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#loginModals">Registrati</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-end" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('houses.create') }}">
                                    <span class="mx-2"><i class="fa-solid fa-plus"></i></span>
                                    Crea una nuova casa
                                </a>

                                <a class="dropdown-item" href="{{ route('houses.indexUser') }}">
                                    <span class="mx-2"><i class="fa-solid fa-house"></i></span>
                                    Vai alle mie case
                                </a>

                                <a class="mod_btn text-white btn_logout mt-1" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    {{-- <i class="fa-solid fa-circle-xmark red_text"></i>  --}}
                                                    Esci
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

    @yield('content')
</body>
</html>
