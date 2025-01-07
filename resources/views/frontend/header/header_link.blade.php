<!DOCTYPE html>
<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>{{ $meta['title'] }}</title>
	
	<meta property="og:title" content="{{ $meta['title'] }}" />
    <meta property="og:description" content="{{ $meta['description'] }}" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <meta property="og:image" content="{{ asset('Frontend/images/Favicon-32.ico') }}" />
    <meta property="og:type" content="website" />

	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="W2x2FAge0Yz7bJ-bl9Kgen7mLZ6gfHJkIFZCNBG-pzY" />
	<meta name="google-adsense-account" content="ca-pub-2769611338825788">
	<link rel="shortcut icon" href="Frontend/images/Favicon-32.ico" type="image/x-icon">
	<link rel="icon" href="{{ asset('Frontend/images/Favicon-32.ico') }}" type="image/x-icon">
  
  <!-- theme meta -->
  <meta name="theme-name" content="LoanHai" />

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	{{-- <link rel="stylesheet" href="{{ asset('Frontend/assets/plugins/slick/slick.css') }}"> --}}

	<link rel="stylesheet" href="{{ asset('Frontend/plugins/font-awesome/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('Frontend/plugins/font-awesome/brands.css') }}">
	<link rel="stylesheet" href="{{ asset('Frontend/plugins/font-awesome/solid.css') }}">

	<!-- # Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('Frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

</head>

<body>
