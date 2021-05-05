<?php 
    include_once("../templates/tpl_comment.php");

    function draw_auction() {
    /**
     * Draws auction page
     */
?>

<div class="auction_background">
    <!-- Top Bar with car details -->
    <div class="container-fluid car-details">
        
    <div class="display-3 text-white text-start ps-1">
        Auction
      </div>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb fs-5 ps-2 pt-1 pb-2">
        <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
        <li class="breadcrumb-item"><a href="../pages/search.php">Search</a></li>
        <li class="breadcrumb-item active" aria-current="page">Auction</li>
    </ol>
    </nav>

        <div class="row align-items-center text-center">

            <!-- Pictures Carrousel -->
            <div class="col-12 col-lg-6 mb-5 ms-1 ms-md-4 d-flex justify-content-center justify-content-lg-start" id="under_heart">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://www.automaistv.com.br/wp-content/uploads/2019/04/bmw_i8_roadster_34-990x660.jpg" class="d-block w-100" alt="bmw i8">
                        </div>
                        <div class="carousel-item">
                            <img src="https://s3.observador.pt/wp-content/uploads/2020/03/11202440/bmw_i8_roadster_619.jpg" class="d-block w-100" alt="bmw i8">
                        </div>
                        <div class="carousel-item center-cropped">
                            <img src="https://www.wattson.pt/wp-content/uploads/2019/02/P90301923_highRes_bmw-i8-roadster-04-2.jpg" class="d-block w-100" alt="bmw i8">
                        </div>
                        <div class="carousel-item center-cropped">
                            <img src="https://garagem360.com.br/wp-content/uploads/2019/04/P90285395_highRes_the-new-bmw-i8-roads-1.jpg" class="d-block w-100" alt="bmw i8">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <a href=# class="heart">
                    <i class="fa fa-heart"></i>
                </a>
            </div>

            <!-- Car Info -->
            <div class="col-lg text-nowrap">
                <h1>2020' BMW i8</h1>
                <div class="row align-items-center m-3">
                    <div class="col">
                        <h2>BMW</h2>
                        <h4>2020</h4>
                    </div>
                    <div class="col">
                        <h2>i8 Coupé</h2>
                        <h4>374 hp</h4>
                    </div>
                    <div class="col fire-text d-flex align-items-center justify-content-center" style="font-size: 4rem;">
                        <i class="fa fa-fire m-3"></i>
                        <h4 class="mb-0">MINT</h4>
                    </div>
                </div>
                <div class="row align-items-center m-3 text-center">
                    <div class="col">
                        <p>Started at:</p>
                        <h6>16h00</h6>
                        <h6>02.03.2021</h6>
                    </div>
                    <div class="col">
                        <p>Ends at:</p>
                        <h6>16h00</h6>
                        <h6>07.03.2021</h6>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
        <div class="auction_content rounded-3 border border-2 border-dark bg-white">
        <!-- Current Bid info -->
        <div class="container" id="auction_content_area">
            <div class="row mx-auto align-items-center justify-content-around">
                <div class="col-12 col-md-4 mt-3 mb-3">
                    <h2>Owner</h2>
                    <a href="../pages/profile.php" class="profile_text">
                        <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture mt-3" alt="Hanna Green"> 
                        <h4 class="m-0" style="color: rgb(204, 174, 2)">Hanna Green</h4>
                    </a>
                </div>
                <div class="col-12 col-md-4 mt-3 mb-1">
                    <h2>Current Bid</h2>
                    <h1 class="current_bid">200000€</h1>
                </div>
                <div class="col-12 col-md-4 mt-3 mb-3">
                    <h2 class="text-nowrap">Top Bidder</h2>
                    <a href="../pages/profile.php" class="profile_text">
                        <img src="https://sunrift.com/wp-content/uploads/2014/12/Blake-profile-photo-square.jpg" class="rounded-circle profile_picture mt-3" alt="Hank Geller"> 
                        <h4 class="m-0">Hank Geller</h4>
                    </a>
                </div>
            </div>
        </div>

        <!-- Place Bid -->
        <div class="container mt-5" id="auction_content_area">
            <form>
                <div class="row align-items-center">
                    <div class="col-sm">
                        <div class="input-group">
                            <input type="number" min="0.00" step="1" value="205000" class="form-control" id="bid_input" placeholder="Your Bid">
                                <div class="input-group-append">
                                    <span class="input-group-text append_box" id="bid_input_box">€</span>
                                </div>
                        </div>

                    </div>
                    <div class="col-sm p-0 mt-3 mb-3">
                        <button type="submit" class="btn rounded-pill" id="bid_button"><h2 class="m-0 p-2">PLACE BID</h2></button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Countdown -->
        <div class="container mt-5" id="auction_content_area">
            <div class="row d-flex flex-row justify-content-around align-items-center">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-6 countdown_box">
                            <h1 class="display-1 m-0">4</h1>
                            <h4>Days</h4>
                        </div>
                        <div class="col-6 countdown_box">
                            <h1  class="display-1 m-0">14</h1>
                            <h4>Hours</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-6 countdown_box">
                            <h1  class="display-1 m-0">35</h1>
                            <h4>Minutes</h4>
                        </div>
                        <div class="col-6 countdown_box">
                            <h1  class="display-1 m-0">23</h1>
                            <h4>Seconds</h4>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="d-flex justify-content-between mt-3 pb-5">
                <span> </span>
                <span>T</span>
                <span>I</span>
                <span>L</span>
                <span>L</span>
                <span> </span>
                <span> </span>
                <span>A</span>
                <span>U</span>
                <span>C</span>
                <span>T</span>
                <span>I</span>
                <span>O</span>
                <span>N</span>
                <span> </span>
                <span> </span>
                <span>B</span>
                <span>E</span>
                <span>G</span>
                <span>I</span>
                <span>N</span>
                <span>S</span>
                <span> </span>
            </h4>
        </div>

    </div>

    <!-- Comment Section -->
    <div class="display-1" style="margin-left: 15%;">Comment Section</div>
    <div class="container-fluid p-0 rounded-3 border border-2 border-dark bg-light" id="comment_section">
        
        <!-- Place Comment -->
        <div class="comment pb-2 clearfix rounded-3 border border-2">
            <form>
                <!-- User and date -->
                <a href="../pages/profile.php" class="profile_text">
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture_comment m-3" alt="Hanna Green"> 
                        <div>
                            <h6 class="m-0">Hanna Green</h6>
                        </div>
                    </div>
                </a>
                <div class="m-3 mt-0">
                    <textarea class="form-control text-justify" id="comment_input" rows="3" placeholder="Insert your comment here."></textarea>
                </div>
                <button type="submit" class="btn m-3 mt-0 float-end rounded-pill" id="comment_button">COMMENT</button>
            </form>
        </div>

        <?php
            draw_comment();
        ?>

        <div class="not_moderator">
            <?php
                draw_comment();
            ?>
        </div>

    <!-- Chat Button -->
    <a href="#" class="chat_button">
        <i class="fa fa-comments chat_icon"></i>
    </a>
</div>

<?php } ?>