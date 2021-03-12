<?php
include_once('../templates/tpl_auction_card.php');
include_once('../templates/tpl_profile_card.php');

function draw_mod(){
?>
    <div class="container bg-dark">
        <main class="mod col-md-8 mx-auto bg-light">
            <div class="display-3 ps-4 pb-4 pt-5">
                Manage user profiles
            </div>
            <div class="display-5 fs-3 pb-4 ps-3">
                <i>You can manage these users' permissions. <a href="../pages/tos.php#admins">What's this?</a></i>
            </div>
            <?php draw_user_gallery(); ?>

            <div class="display-3 ps-4 pb-3 pt-5">
                Manage auctions
            </div>
            <div class="display-5 fs-3 pb-4 ps-3">
                <i>You have moderator privileges over these auctions. <a href="../pages/tos.php#mods">What's this?</a></i>
            </div>
            <?php draw_auction_gallery(); ?>
            <div class="row p-4"></div>
        </main>
    </div>
<?php } ?>

<?php
function draw_user_gallery(){ ?>


<div class="row row-cols-3 justify-content-start mod-gallery mx-5 overflow-auto p-4 mb-5 rounded-3 border border-5 border-secondary">
<?php draw_profile_card_1(); ?>
<?php draw_profile_card_2(); ?>
<?php draw_profile_card_1(); ?>
<?php draw_profile_card_2(); ?>
<?php draw_profile_card_1(); ?>
<?php draw_profile_card_2(); ?>
</div>

<?php } ?>

<?php function draw_auction_gallery() { ?>

<div class="row row-cols-3 justify-content-start mod-gallery mx-5 overflow-auto p-4 rounded-3 border border-5 border-secondary">
<?php
draw_auction_card_1();
draw_auction_card_2();
draw_auction_card_2();
draw_auction_card_3();
draw_auction_card_1();
draw_auction_card_3();
?>
</div>

<?php } ?>