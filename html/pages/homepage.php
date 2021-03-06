<?php function draw_homepage() {
    /**
     * Draws homepage
     */
    ?>

<div class="container">
    <!-- Search Top Part of Homepage -->
    <div class="overlay" id="overlay" onclick="resetBg()"></div>
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
        <h4 class="text-white">Fire Deals</h4>
        
        <!-- Container For All Displayed Auctions -->
        <div class="container mb-5 mt-5">
            <div class="row">

                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card mt-3">
                        <div class="product-1 align-items-center p-2 text-center">
                            <img src="../assets/supercar-homepage-bg.jpg" alt="" class="rounded" width="160">
                            <h5>Car Pog</h5>

                            <!-- Card info -->
                            <div class="mt-3 info">
                                <span class="text1 d-block">Lorem ipsum dolor sit amet.</span>
                                <span class="text1 d-block">Lorem, ipsum dolor.</span>
                            </div>
                            <div class="cost mt-3 text-dark">
                                <span>21.000€</span>
                            </div>
                        </div>

                        <div class="p-3 shoe text-center text-white mt-3 cursor">
                            <span class="text-uppercase">Add to Cart</span>
                        </div>
                    </div>
                </div>
                <!-- End of Card 1 -->

            </div>
        </div>
        <!-- End of Container For All Displayed Auctions -->
    </div>
</div>


<?php } ?>