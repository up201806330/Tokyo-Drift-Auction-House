<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/homepage.css">
    <link rel="stylesheet" href="./css/tpl_navbar.css">
    <link rel="stylesheet" href="./css/tpl_footer.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Homepage</title>
  </head>
  <body>
  <?php
    include_once("./templates/tpl_navbar.php");
    include_once("./pages/homepage.php");
    include_once("./templates/tpl_footer.php");
    
    draw_navbar();
    draw_homepage();
    draw_footer();
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <!-- <script type="text/javascript">
    function setBgToDark() {
      document.getElementById("overlay").style.opacity = "0.4";
    }

    function resetBg() {
      document.getElementById("overlay").style.opacity = "0.0";
    }
  </script> -->

  </body>
</html>