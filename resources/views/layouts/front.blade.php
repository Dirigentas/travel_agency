@inject('cart', 'App\Services\CartService')

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class='logo rounded' src='{{asset('logo.jpg')}}' alt='logo'>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('index') }}">Pagrindinis</a>
                        </li>

                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Prisijungti') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registruotis') }}</a>
                        </li>
                        @endif

                        @else

                        @if(Auth::user()->role == 'administrator')
                        <li class="nav-item mt-2">
                            <a class="nav-link text-danger border border-danger" href="{{ route('countries-index') }}">Back-office</a>
                        </li>
                        @endif

                        <li class="nav-item mt-2">
                            <a class="nav-link" href="{{ route('index') }}">Pagrindinis</a>
                        </li>

                        <li class="nav-item mt-2">
                            <a class="nav-link" href="{{ route('orders-index') }}">Įsigyjimai</a>
                        </li>

                        <li class="nav-item dropdown mt-2">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Atsijungti
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="cartDropdown" class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="cart-svg">
                                    <svg>
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                    <span class="count">{{$cart->count}}</span>
                                    <span>{{$cart->total}} eur </span>
                                </div>
                            </a>
                            <a href="{{route('cart')}}" class="dropdown-menu dropdown-menu-end" aria-labelledby="cartDropdown">
                                @forelse($cart->list as $hotel)
                                <div class="dropdown-item">
                                    {{$hotel->name}}
                                    <b>X</b> {{$hotel->count}} vnt.
                                    {{$hotel->sum}} eur
                                </div>
                                @empty
                                <span class="dropdown-item">Empty</span>
                                @endforelse
                            </a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('layouts.messages')
            @yield('content')
        </main>
    </div>
    @include('layouts.svg')
    @livewireScripts
</body>
</html>
