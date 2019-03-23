<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">  <!-- CSRF Token -->
	<meta http-equiv="X-UA-Compatiable" content="ie=edge">
	<title>Laravel 5.8 A simple CRUD Example</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
</head>
<body>
	<!-- Navbar start -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="{{ route('products.index') }}">A Laravel CRUD Sample</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        @isAdmin
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('products.create') }}">Add A Product<span class="sr-only">(current)</span></a> 
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('users.index') }}">Users Admin<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('orders.index') }}">Orders Admin<span class="sr-only">(current)</span></a>
        </li>
        @endisAdmin
      </ul>
      <form method="post" action="{{ route('products.search') }}" class="form-inline my-2 my-lg-0">
      	@csrf
        <input class="form-control mr-sm-2" type="text" placeholder="Search" 
          aria-label="Search" name="keyword">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav text-right">
        <!--  -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.show_cart') }}"><i class="fa fa-shopping-cart"></i>Cart( 
            @if(session('cart'))
              {{ count(session('cart')) }}
            @else
              0 
            @endif
          )</a>
        </li>
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
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <!-- Logout -->
              <a class="dropdown-item" href="{{ route('logout') }}" 
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              
              <!-- Change Password -->
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              <a class="dropdown-item" href="{{ route('password.showChangeForm') }}">
                  {{ __('Change Password') }}
              </a>

              <!-- My Orders -->
              <a class="dropdown-item" href="{{ route('logout') }}" 
                onclick="event.preventDefault();document.getElementById('orders-form').submit();">
                  {{ __('My Orders') }}
              </a>
              <form id="orders-form" action="{{ route('orders.index') }}" method="GET" style="display: none;">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              </form>

              <!-- My Account -->
              <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">
                  {{ __('My Account') }}
              </a>
            </div>
          </li>
        @endguest
      </ul>  
    </div>
  </nav> 
  <!-- Navbar end -->
  <div class="container">
    <!-- Message Box start -->
    @include('layouts.message')
    <!-- Message Box end -->
		@yield('content')
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>