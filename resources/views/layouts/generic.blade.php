<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ config("app.url") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2fb51e88be.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    {{-- <link href="{{ asset('css/milligram.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <script src="{{ asset('js/Utils.js')}}"></script>
    {{-- <script src="../js/tpl_search.js"></script> --}}
    <script src="{{ asset('js/sign-in.js')}}"></script>
    {{-- <script src="../js/login.js"></script> --}}
    {{-- <script src="../js/create_auction.js"></script> --}}
  
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tpl_navbar.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tpl_footer.css')}}">
    {{-- <link rel="stylesheet" href="../css/tpl_search.css')}}"> --}}
    <link rel="stylesheet" href="../css/tpl_auction_card.css">
    <link rel="stylesheet" href="{{ asset('css/auction.css')}}">
    {{-- <link rel="stylesheet" href="../css/tpl_mod.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/login-overlay.css')}}">
    <link rel="stylesheet" href="{{ asset('css/sign-up.css')}}">
    <link rel="stylesheet" href="{{ asset('css/profile.css')}}">
    <link rel="stylesheet" href="{{ asset('css/create_auction.css')}}">
    <link rel="stylesheet" href="{{ asset('css/tpl_tos.css')}}">

    {{-- REST API --}}
    <script src="{{ asset('js/RestApi.js')}}"></script>
    <script>
      const apiUrl = '{{ config("app.url") }}';
      var api = new RestApi(apiUrl);
    </script>

    <script type="text/javascript">
      const userId = <?= (Auth::guest() ? "null" : '"'.Auth::id().'"') ?>;
    </script>

    @yield('head')
  </head>

  @yield('body')
  
</html>
