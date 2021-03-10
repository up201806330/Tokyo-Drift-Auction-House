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
    // include_once("./pages/profile.php");
    
    draw_navbar();
    draw_homepage();
    draw_footer();
  ?>

    <!-- <button id="btnShow" type="button" class="btn btn-primary">Modal</button> -->
    <div class="modal fade" tabindex="-1" id="testModal">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Log In</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnSave">Save</button>
          </div>
        </div>
      </div>
    </div>
    <script>
      const container = document.getElementById("testModal");
      const modal = new bootstrap.Modal(container);

      document.getElementById("btnShow").addEventListener("click", function () {
        modal.show();
      });
      document.getElementById("btnSave").addEventListener("click", function () {
        modal.hide();
      });
    </script>

  </body>
</html>
