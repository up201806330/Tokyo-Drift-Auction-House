<?php
function error_page(int $error_code, string $message) : void {
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/tpl_error_page.css">
</head>

<body class="d-flex justify-content-center align-items-center">
  <main id="error" class="text-white">
    <header class="border-bottom border-white border-2">
      <h1><?=$error_code?></h1>
      <h2><?=$message?></h2>
      <img class="main-icon" src="../assets/broken-car.svg">
    </header>
    <input type="submit" class="mx-auto nav-link btn text-white navbar-content-bold rounded-pill" id="home" value="Home" onclick="window.location='.';">
  </main>
</body>

</html>
<?php
}
?>
