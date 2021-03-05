<?php function draw_homepage() {
    /**
     * Draws homepage
     */
    ?>

<div class="container">
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
</div>


<?php } ?>