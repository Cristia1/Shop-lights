<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <style>
        .cart-button {
            position: relative;
            display: inline-block;
            width: 30px;
            height: 30px;
            margin-left: 10px;
            margin-top: 10px;
            cursor: pointer;
        }

        .cart-items {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: red;
            color: white;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            font-size: 10px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-brand img {
            height: 30px;
            /* Schimbați valoarea la dimensiunea dorită */
            margin-right: -120px;
            /* Poziționare imagine la dreapta */
            margin-left: 90px;
            /* Poziționare imagine la stânga */
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>


            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth
                    <a href="/lights" class="btn btn-second">Lights</a>
                    <a href="/shop" class="btn btn-second">Shop</a>
                    <form class="d-flex" action="/search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @endauth
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    {{-- <a href="/cos-cumparaturi" class="cart-button">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-items">0</span>
                    </a> --}}

                    <a class="nav-link" href="{{ route('Card.index') }}">
                        <i class="fa fa-shopping-cart"></i> Coșul meu
                        @if(Cart::count() > 0)
                            <span class="badge badge-pill badge-warning">{{ Cart::count() }}</span>
                        @endif
                    </a>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
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
    </div>
    <main class="py-4">
        @yield('content')
    </main>
    </div>
</body>

</html>
