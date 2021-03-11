<?php
function draw_mod(){
?>
    <div class="container bg-light">
        <main class="mod col-md-8 mx-auto">
            <div class="display-3 pb-4 pt-5">
                Manage user profiles
            </div>
            <div class="display-3 pb-4">
                Manage auctions
            </div>
            <div class="row row-cols-3 justify-content-start cars-gallery overflow-auto p-4 rounded-3">
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
