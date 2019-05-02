<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AjaxCRUD') }}</title>

    <!-- Scripts -->
   {{--  <script src="{{ asset('js/app.js') }}" defer></script> --}}
        <script src="{{ asset('js/jquery-min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/datatables.min.js') }}"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
{{--     <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/datatables.min.css"> 
    </head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/')}}">{{ config('app.name', 'AjaxCRUD') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
            </form>
         @endguest
        </div>
      </li>
   
    </ul>
 
  </div>
</nav>

        
            @yield('content')
        
    </div>
</body>
</html>
