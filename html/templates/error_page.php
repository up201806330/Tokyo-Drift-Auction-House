<?php
function error_page(int $error_code, string $message) : void {
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/button.css">
  <link rel="stylesheet" href="css/error.css">
</head>

<body>
  <main id="error">
    <header>
      <h1><?=$error_code?></h1>
      <h2><?=$message?></h2>
      <img class="main-icon" src="res/img/broken-car.svg">
    </header>
    <input type="submit" class="main-button" id="home" value="Home" onclick="window.location='.';">
  </main>
</body>

</html>
<?php
}
?>
