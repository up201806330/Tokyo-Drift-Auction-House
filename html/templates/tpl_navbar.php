<?php function draw_navbar() {
    /**
     * Draws navbar
     */
    ?>
<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-navbar">
  <div class="container-fluid">
    <!-- <a href="main.php"></a> -->
    <a class="navbar-brand text-white navbar-content-bold nav-link" href="#">
      <img class="logo filter-logo" src="./logo.svg" width="80" height="80">
      Tokyo Drift Auction House
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" aria-current="page" href="#">Explore Auctions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" href="#">Create new auction</a>
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" href="#" tabindex="-1" aria-disabled="true">About / Contacts</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li>
            <button type="button" class="nav-link btn text-white navbar-content-bold rounded-pill" data-bs-toggle="modal" data-bs-target="#exampleModal">Log in</button>
          </li>
          <span class="left-vert-bar"></span>
          <li>
            <button class="nav-link btn text-white navbar-content-bold rounded-pill" href="#" data-toggle="modal" data-target="#signupPage">Sign up</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<?php } ?>