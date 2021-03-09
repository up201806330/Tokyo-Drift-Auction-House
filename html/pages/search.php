<?php
    include_once('templates/tpl_search.php');
    include_once('templates/tpl_auction_card.php');

    draw_topbar();
    open_main();
    draw_sidebar();
    draw_auction_card();
    close_main();
    
?>