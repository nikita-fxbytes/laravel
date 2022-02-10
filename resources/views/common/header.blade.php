<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="{!! csrf_token() !!}" />
  <title>Laravel Project - @yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{env('APP_URL')}}assets/img/favicon.png" rel="icon">
  <link href="{{env('APP_URL')}}assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{env('APP_URL')}}assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}assets/css/style.css" rel="stylesheet">
  <link href="{{env('APP_URL')}}assets/css/parsley.css" rel="stylesheet">
  @yield('header')
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container">
            <div class="header-container d-flex align-items-center justify-content-between">
                <div class="logo">
                    <h1 class="text-light">
                        <a href="{{url('/')}}">
                            <span>My Project</span>
                        </a>
                    </h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html"><img src="{{env('APP_URl')}}assets/img/logo.png" alt="" class="img-fluid"></a>-->
                </div>
                <nav id="navbar" class="navbar">
                    @include('common.mainmenu')
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->
            </div><!-- End Header Container -->
        </div>
    </header><!-- End Header -->