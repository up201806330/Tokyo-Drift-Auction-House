<?php
function draw_mod(){
?>
    <div class="container bg-light">
        <main class="mod col-md-8 mx-auto">
            <h1>Manage user profiles</h1>
            <h1>Manage auctions</h1>
            <div class="row row-cols-3 justify-content-start cars-gallery overflow-auto pt-2">
<?php
draw_auction_card_1();
draw_auction_card_2();
draw_auction_card_2();
draw_auction_card_3();
draw_auction_card_1();
draw_auction_card_3();
?>
            </div>
        </main>
    </div>
<?php
}
