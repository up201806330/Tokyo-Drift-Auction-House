<header>
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
          <li class="nav-item dropdown">
            <a class="nav-link text-white navbar-content-bold rounded-pill dropdown-toggle" aria-current="page" href="#" data-bs-toggle="dropdown">Explore By Category</a>
            <ul class="dropdown-menu dropdown-menu-dark ps-3 pb-4 pe-3 pt-2" data-hover="dropdown">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <li><span class="dropdown-header fs-3 ps-3">Trending Categories</span></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item fs-3 text-decoration-underline" href="../pages/search.php"><b>Sports</b></a></li>
                  <li><a class="dropdown-item fs-3 text-decoration-underline" href="../pages/search.php"><b>Family</b></a></li>
                  <li><a class="dropdown-item fs-3 text-decoration-underline" href="../pages/search.php"><b>Budget</b></a></li>
                </div>
                <div class="col-12 col-sm-8">
                  <li><span class="dropdown-header fs-3 ps-3">Most Sold Brands</span></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item fs-5" href="../pages/search.php"><b><i>Ferrari</i></b></a></li>
                  <li><a class="dropdown-item fs-5" href="../pages/search.php"><b><i>Lada</i></b></a></li>
                  <li><a class="dropdown-item fs-5" href="../pages/search.php"><b><i>Mercedes</i></b></a></li>
                  <li><a class="dropdown-item fs-5" href="../pages/search.php"><b><i>Volkswagen</i></b></a></li>
                </div>
              </div>
            </ul>
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
                {{App\Models\User::find(Auth::id())->username}}
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