<?php function draw_navbar() {
    /**
     * Draws navbar
     */
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tokyo Drift Auction House</title>
  
  <!-- Bootstrap responsiveness in mobile -->
  <!-- https://getbootstrap.com/docs/3.4/css/ -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <script src="../js/tpl_search.js"></script>

  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/homepage.css">
  <link rel="stylesheet" href="../css/tpl_navbar.css">
  <link rel="stylesheet" href="../css/tpl_footer.css">
  <link rel="stylesheet" href="../css/auction.css">
  <link rel="stylesheet" href="../css/tpl_mod.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-navbar">
  <div class="container-fluid">
    <!-- <a href="main.php"></a> -->
    <a class="navbar-brand text-white navbar-content-bold nav-link" href="../pages/homepage.php">
      <img class="logo filter-logo" src="../logo.svg" width="80" height="80">
      Tokyo Drift Auction House
    </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" aria-current="page" href="../pages/search.php">Explore Auctions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" href="#">Create new auction</a>
          <li class="nav-item">
            <a class="nav-link text-white navbar-content-bold rounded-pill" href="#" tabindex="-1" aria-disabled="true">About / Contacts</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li>
            <button class="nav-link btn text-white navbar-content-bold rounded-pill" href="#" id="btnShow">Log in</button>
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