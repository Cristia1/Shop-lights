<!doctype html>


<head>
    {{-- --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Adauga aici codul jQuery personalizat -->

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <a href="{{ url('/') }}" class="navbar-brand">
{{--            <img src="{{ asset('images/logo.png') }}" alt="Logo">--}}
        </a>
        <div class="container">
            <a class="navbar-brand" href="{{ url('/home') }}">
                {{ config('app.name', 'Home') }}
            </a>
            @auth
                <a href="/products" class="btn btn-second">Products</a>
                <a href="/shop" class="btn btn-second">Shop</a>
                <form class="d-flex" action="/search">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search"
                           aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#" id="add-to-cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge bg-danger cart-count" id="index-card-items">0</span>
                        </a>
                    </li>
                </ul>
            @endauth
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>
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
                            <li class="nav-item">
                                <a class="nav-link" href="/about">{{ __('About Us') }}</a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</div>
<main class="py-4">
    @yield('content')
</main>
</body>

