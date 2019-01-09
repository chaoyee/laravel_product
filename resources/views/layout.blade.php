<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatiable" content="ie=edge">
	<title>Laravel 5.7 A simple CRUD Example</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
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
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('products.create') }}">Add A Product <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <form method="post" action="{{ route('products.search') }}" class="form-inline my-2 my-lg-0">
      	@csrf
        <input class="form-control mr-sm-2" type="text" placeholder="Search" 
          aria-label="Search" name="keyword">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav> 
  <!-- Navbar end -->
	<div class="container">
		@yield('content')
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>