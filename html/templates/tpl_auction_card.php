<?php function draw_auction_card() {
    /**
     * Draws an auction card
     */
    ?>

    <!--
        To see "in action" checkout the homepage branch.
        It has a copy of this code there
    -->

            <link rel="stylesheet" href="../css/tpl_auction_card.css" type="text/css">
            
                <!-- Card -->
                <div class="col-12 col-md-6 col-lg-3 mx-auto mb-3 card-container">
                    <div class="card">
                        
                        <img src="../assets/supercar-homepage-bg.jpg" alt="..." class="card-img-to rounded car-img-thumbnail">

                        <!-- Card Body -->
                        <div class="card-body pt-1">
                            <h4 class="card-title text-center">Brand 1</h4>
                            <p class="card-text time-remaining-text"> <i class="fa fa-clock-o clock"></i> <span class="hour ml-1">3 hours remaining</span> </p>
                            <p class="card-text current-value">Currently at 21.000€</p>
                            <a href="#" class="stretched-link"></a> <!-- Card as a link -->
                        </div>
                        <!-- End of Card Body -->
                    </div>
                </div>
                <!-- End of Card -->

<?php } ?>