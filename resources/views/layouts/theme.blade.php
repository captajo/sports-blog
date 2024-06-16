<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Goole Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto:400,500" rel="stylesheet"> 

    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	
    <!-- Owl carousel -->
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
	 <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <!-- Off Canvas Menu -->
    <link href="{{ asset('assets/css/offcanvas.min.css') }}" rel="stylesheet">

    <!--Theme CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
  </head>
<body>
<div id="main-wrapper">
    @include('components.header')

    <main id="app">
        @yield('content')
    </main>

    @include('components.footer')


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Owl carousel -->
    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Theme Script File-->
    <script src="{{ asset('assets/js/script.js') }}"></script> 

    <!-- Off Canvas Menu -->
    <script src="{{ asset('assets/js/offcanvas.min.js') }}"></script> 
</div>