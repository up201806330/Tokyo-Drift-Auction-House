<?php
    include_once("../templates/tpl_navbar.php");
    include_once('../templates/tpl_mod.php');
    include_once("../templates/tpl_footer.php");
    include_once('../templates/tpl_search.php');
    
    draw_navbar_logged_in();
    draw_mod();
    draw_footer();

?>
