<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS importing -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        
        <!-- Fontawesome Icons importing -->
        <script defer src="../node_modules/@fortawesome/fontawesome-free/js/regular.js"></script>
        <script defer src="../node_modules/@fortawesome/fontawesome-free/js/solid.js"></script>
        <script defer src="../node_modules/@fortawesome/fontawesome-free/js/fontawesome.js"></script>

        <!-- CSS importing -->
        <link rel="stylesheet" type="text/css" href="/html/auction.css">
    </head>

    <body>
        <!-- Navbar -->

        <!-- Top Bar with car details -->
        <div class="container-fluid car-details">
            <div class="row align-items-center">
                <!-- Pictures Carrousel -->
                <div class="col-4 m-5 heart_button">
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
                    <button type="button" class="btn heart">
                        <i class="far fa-heart heart_icon"></i>
                    </button>
                </div>
                <!-- Car Info -->
                <div class="col-7">
                    <h1> 2020' BMW i8</h1>
                    <div class="row align-items-center">
                        <div class="col">
                            <h2>BMW</h2>
                            <h4>2020</h4>
                        </div>
                        <div class="col">
                            <h2>i8 Coupé</h2>
                            <h4>374 hp</h4>
                        </div>
                        <div class="col">
                            <i class="fas fa-fire condition"></i>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
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


        <!-- Current Bid info -->
        <div class="container w-50 pt-5">
            <div class="row align-items-center text-center">
                <div class="col">
                    <h2>Owner</h2>
                </div>
                <div class="col">
                    <h2>Current Bid</h2>
                </div>
                <div class="col">
                    <h2>Bidder</h2>
                </div>
            </div>
            <div class="row align-items-center text-center">
                <div class="col">
                    <a href="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="profile_text">
                        <img src="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="rounded-circle profile_picture mt-3" alt="Hanna Green"> 
                        <h4 class="profile_name">Hanna Green</h4>
                    </a>
                </div>
                <div class="col">
                    <h1 class="current_bid">200 000€</h1>
                </div>
                <div class="col">
                    <a href="https://organicthemes.com/demo/profile/files/2018/05/profile-pic.jpg" class="profile_text">
                        <img src="https://sunrift.com/wp-content/uploads/2014/12/Blake-profile-photo-square.jpg" class="rounded-circle profile_picture mt-3" alt="Hank Geller"> 
                        <h4 class="profile_name">Hank Geller</h4>
                    </a>
                </div>
            </div>
        </div>

        <!-- Place Bid -->
        <div class="container w-25 pt-5">
            <form>
                <div class="row align-items-center text-center">
                    <div class="col">
                        <div class="input-group">
                            <!--<span class="input-group-addon">€</span>-->
                            <input type="number" min="0.00" step="1" value="205000" class="form-control bid_input" id="bid" placeholder="Your Bid">
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn bid_button"><h2 class="m-0">BID</h2></button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Countdown -->

        <!-- Comment Section -->

        <!-- Footer -->


        <!-- Bootstrap JS importing -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    </body>

</html>