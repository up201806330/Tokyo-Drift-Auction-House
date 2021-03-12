<!DOCTYPE html>
<html>

<head>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/tpl_banned_page.css">
</head>

<body class="d-flex justify-content-center align-items-center">
  <main id="error" class="text-white">
    <header class="border-bottom border-white border-2 text-center">
        <img class="main-icon mx-auto" src="../assets/padlock-locked.svg">
      <h1 class="mt-2 mb-3 font-weight-bold">You have been banned</h1>
    </header>
    <p> A past action of yours was interpreted as an infringement to the Terms and Conditions of this website, resulting in a ban from one of our Moderators.</p>
    <p> As a result, you will have most of your permissions restrained. You will not be able to participate or create in any auction neither interact with others users.</p>
    <p> By clicking the button, you'll be taken to the home page.</p>
    <input type="submit" class="mx-auto nav-link btn text-white navbar-content-bold rounded-pill" id="home" value="Home" onclick="window.location='homepage.php';">
  </main>
</body>

</html>
