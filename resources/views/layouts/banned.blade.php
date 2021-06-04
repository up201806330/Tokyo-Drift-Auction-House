@extends('layouts.generic')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tpl_banned_page.css') }}">
    
    @section('title', 'Banned')
@endsection

@section('body')
<body class="d-flex justify-content-center align-items-center">
    <main id="error" class="text-white">
      <header class="border-bottom border-white border-2 text-center">
          <img class="main-icon mx-auto" src="{{asset('assets/padlock-locked.svg')}}">
          @yield('banned_title')
      </header>
      @yield('banned_reason')
      <input type="submit" class="mx-auto nav-link btn text-white navbar-content-bold rounded-pill" id="home" value="Home" onclick="window.location='{{ route('homepage') }}'">
    </main>
  </body>
@endsection