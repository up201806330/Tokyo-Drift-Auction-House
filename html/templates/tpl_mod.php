<?php
include_once('../templates/tpl_auction_card.php');
include_once('../templates/tpl_user_row.php');

function draw_mod(){
?>
    <div class="container" id="modContainer" style="background-color: rgb(223, 223, 223);">
        <main class="mod col-12 col-md-10 mx-auto bg-light rounded">
            <div class="marginsMod">
                <div class="display-1 text-start pt-5 ps-2">
                    Moderator page
                </div>
                <nav aria-label="breadcrumb">
                <ol class="breadcrumb fs-5 ps-4 pt-1 pb-5">
                    <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="../pages/profile.php">Profile</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Moderator page</li>
                </ol>
                </nav>
                <div class="display-4 ps-4 pb-1 pt-0 pt-md-5">
                    Manage user profiles
                </div>
                <div class="display-5 fs-3 pb-4 ps-4">
                    <i>You can manage these users' permissions. <a href="../pages/tos.php#admins">What's this?</a></i>
                </div>
                <?php draw_user_gallery(); ?>

                <div class="display-4 ps-4 pb-1 pt-0 pt-md-5">
                    Manage auctions
                </div>
                <div class="display-5 fs-3 pb-4 ps-4">
                    <i>You have moderator privileges over these auctions. <a href="../pages/tos.php#mods">What's this?</a></i>
                </div>
                <?php draw_auction_gallery(); ?>
                <div class="row p-4"></div>
            </div>
        </main>
    </div>
<?php } ?>

<?php
function draw_user_gallery(){ ?>


<div class="row row-cols-1 mx-auto justify-content-start mod-gallery  overflow-auto p-sm-4 p-0 mb-5 mx-0 mx-md-5 rounded-3 border border-5 border-secondary">
    <div class="input-group form-container pb-2">
        <input type="text" name="search" class="form-control search-input" placeholder="Search for a user" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">
        <span class="input-group-btn">
            <a href="../pages/search.php">
                <button class="btn btn-search">
                    <i class="fa fa-search"></i>
                </button>
            </a>
        </span>
    </div>
    <div class="accordion" id="userAccordion">
        <?php draw_user_row_mod(1) ?>
        <?php draw_user_row_mod_alt(2) ?>
        <?php draw_user_row_mod(3) ?>
        <?php draw_user_row_mod(4) ?>
        <?php draw_user_row_mod_alt(5) ?>
        <?php draw_user_row_mod_alt(6) ?>
        <?php draw_user_row_mod_alt(7) ?>
        <?php draw_user_row_mod(8) ?>
        <?php draw_user_row_mod(9) ?>
        <?php draw_user_row_mod(10) ?>
    </div>
</div>

<?php } ?>

<?php function draw_auction_gallery() { ?>

<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-start mod-gallery overflow-auto p-sm-4 p-0  mx-0 mx-md-5 rounded-3 border border-5 border-secondary">
<div class="input-group form-container pb-4">
        <input type="text" name="search" class="form-control search-input" placeholder="Search for an auction" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">
        <span class="input-group-btn">
            <a href="../pages/search.php">
                <button class="btn btn-search">
                    <i class="fa fa-search"></i>
                </button>
            </a>
        </span>
    </div>
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