<?php function draw_homepage() {
    /**
     * Draws homepage
     */

    include_once("../templates/tpl_auction_card.php");
    ?>
    
<div>
    <!-- Search Top Part of Homepage -->
    <!-- <div class="overlay" id="overlay" onclick="resetBg()"></div> -->
    <div class="homepage-bg-top">
        <div class="col-md-5 col-lg-5 col-xl-4 col-6 mx-auto my-auto search-box">
            <div class="input-group form-container">
                <input type="text" name="search" class="form-control search-input" placeholder="Tesla Model S" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">
                <span class="input-group-btn">
                    <a href="../pages/search.php">
                        <button class="btn btn-search">
                            <i class="fa fa-search"></i>
                        </button>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <!-- Fire Deals Part of Homepage -->
    <div class="homepage-bg-bottom">
        <h4 class="fire-deals-text text-md-start pt-5">Fire Deals</h4>
        
        <div class="container-fluid" id="search-background" style="flex: auto">
<div class="row h-100">
        <!-- Container For All Displayed Auctions -->
        <main class="col ms-sm-auto pt-4 px-md-4">
            <div class="row row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 d-flex justify-content-center">

               <?php
                    draw_auction_card_1();
                    draw_auction_card_2();
                    draw_auction_card_3();
                    draw_auction_card_1();
                ?>
            </div>
        </main>

</div></div>
        <!-- End of Container For All Displayed Auctions -->
    </div>
</div>


<?php } ?>