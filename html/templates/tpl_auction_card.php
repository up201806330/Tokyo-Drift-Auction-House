<?php function draw_auction_card() {
    /**
     * Draws an auction card
     */
    ?>
            <link rel="stylesheet" href="../css/tpl_auction_card.css" type="text/css">
            
                <!-- Card -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-4  mb-3 card-container">
                    <div class="card">
                        
                        <img src="../assets/supercar-homepage-bg.jpg" alt="..." class="cover car-img-thumbnail">

                        <!-- Card Body -->
                        <div class="card-body">
                            <h4 class="card-title text-center">Brand 1</h4>
                                <div class="card-body-info">
                                    <p class="card-text time-remaining-text">
                                        <i class="fa fa-clock-o clock"></i>
                                        <span class="hour">3 hours remaining</span>
                                    </p>
                                    <p class="card-text current-value">
                                    <i class="fa fa-money money"></i>
                                        <span class="card-price">Currently at 21.000€</span>
                                    </p>
                                    <a href="#" class="stretched-link"></a> <!-- Card as a link -->
                            </div>
                        </div>
                        <!-- End of Card Body -->
                    </div>
                </div>
                <!-- End of Card -->

<?php } ?>