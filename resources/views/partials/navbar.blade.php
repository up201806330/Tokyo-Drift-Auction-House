<header>
  @if(session()->has('message'))
  <script type="text/javascript">
    alert("{{ session()->get('message') }}");
  </script>
  @endif
  @include('auth.login')
  <nav class="navbar navbar-expand-xxl navbar-dark bg-navbar">
  <div class="container-fluid">
    <!-- <a href="main.php"></a> -->
    <a class="navbar-brand text-white navbar-content-bold nav-link" href="{{ url('/') }} ">
      <img class="logo filter-logo" src="{{ asset('/assets/logo.svg') }}" width="80" height="80">
      <div class="d-none d-sm-inline"> Tokyo Drift Auction House</div>
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-sm-0">
          
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" href="{{ route('search') }}">Advanced Search</a>
          </li>

          <li class="nav-item">
            @if (Auth::guest())
              <a type="button" class="nav-link text-white navbar-content-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">Create new auction</a>
            @else
              <a class="nav-link text-white navbar-content-bold rounded-pill" href="{{ url('/auctions/new') }}">Create new auction</a>
            @endif
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">

          @if (Auth::guest())
            <li>
              <a type="button" class="nav-link btn text-white navbar-content-bold rounded-pill text-start" data-bs-toggle="modal" data-bs-target="#exampleModal">Log in</a>
            </li>
            <span class="left-vert-bar"></span>
            <li>
              <a class="nav-link text-white navbar-content-bold rounded-pill" href="{{ route('register') }}">Sign up</a>
            </li>
          @else
            <li>
              <a class="nav-link text-white navbar-content-bold rounded-pill" href="{{ url('/users/' . Auth::id()) }}"><i class="fas fa-user-alt me-3"></i>
                {{App\Models\User::findOrFail(Auth::id())->username}}
              </a>
            </li>
            <span class="left-vert-bar"></span>
            <li>
              <a class="nav-link text-white navbar-content-bold rounded-pill" href="/logout">Log out</a>
            </li>
          @endif

        </ul>
      </div>
    </div>
  </nav>
</header>