<?php function draw_homepage() {
    /**
     * Draws homepage
     */
    ?>

<div>
    <!-- Search Top Part of Homepage -->
    <!-- <div class="overlay" id="overlay" onclick="resetBg()"></div> -->
    <div class="homepage-bg-top">
        <div class="col-md-5 col-lg-5 col-xl-4 col-6 mx-auto my-auto search-box">
            <div class="input-group form-container">
                <input type="text" name="search" class="form-control search-input" placeholder="Tesla Model S" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">
                <span class="input-group-btn">
                    <button class="btn btn-search">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>

    <!-- Fire Deals Part of Homepage -->
    <div class="homepage-bg-bottom">
        <h4 class="fire-deals-text text-md-start pt-5">Fire Deals</h4>
        
        <!-- Container For All Displayed Auctions -->
        <div class="container">
            <div class="row px-5 mx-auto">
                <?php
                    include_once("./templates/tpl_auction_card.php");

                    draw_auction_card();
                    draw_auction_card();
                    draw_auction_card();
                    draw_auction_card();
                ?>

                <!-- Another Card (different from the template to test different original image resolutions) -->
                <div class="col-md-6 col-lg-6 col-md-6 mx-auto mb-3 card-container">
                    <div class="card">
                        
                        <img src="../assets/supercar-2.jpg" alt="..." class="card-img-to rounded car-img-thumbnail">

                        <!-- Card Body -->
                        <div class="card-body pt-1">
                            <h4 class="card-title text-center">Brand 4</h4>
                            <p class="card-text time-remaining-text"> <i class="fa fa-clock-o clock"></i> <span class="hour ml-1">3 hours remaining</span> </p>
                            <p class="card-text current-value">Currently at 21.000€</p>
                            <a href="#" class="stretched-link"></a> <!-- Card as a link -->
                        </div>
                        <!-- End of Card Body -->
                    </div>
                </div>
                <!-- End of Card -->

            </div>
        </div>
        <!-- End of Container For All Displayed Auctions -->
    </div>
</div>


<?php } ?>