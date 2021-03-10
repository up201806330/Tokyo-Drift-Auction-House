<?php
    include_once("../templates/tpl_navbar.php");
    include_once("../templates/tpl_footer.php");
    include_once('../templates/tpl_search.php');
    include_once('../templates/tpl_auction_card.php');

    draw_navbar();

    draw_topbar();
    open_main();
    draw_sidebar();

    open_card_holder();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    draw_auction_card();
    close_card_holder();
    
    
    close_main();
    
    draw_footer();
?>