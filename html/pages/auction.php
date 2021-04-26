<?php
    include_once("../templates/tpl_navbar.php");
    include_once("../templates/tpl_auction.php");
    include_once("../templates/tpl_footer.php");

    draw_navbar_logged_in();
    draw_auction();
    draw_footer();
?>