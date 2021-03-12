<?php function draw_about() { ?>

    <div class="container-fluid bg-light p-5">
    <div class="display-2 ">About Us</div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5 ps-2 pt-1">
            <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
        </nav>
        <div class="d-flex justify-content-center">
            <img class="logo img-fluid" src="../logo.svg" width="400" height="400">
        </div>
        
        <div class="fw-light fs-1 pt-3 pb-2 text-center"><i><b>The future is now...</b></i></div>
        <div class="fw-light fs-2 pt-3 pb-3 text-center"><i>Fill your garage with the cars from your dreams, any place, any time</i></div>


        <div class="row mt-5 mb-5">
            <div class="col-lg-6 col-md-12 pt-5">
                <div class="fw-light fs-2 p-3 text-end"><b>Come visit us! :))</b></div>
                <div class="fw-light fs-3 pt-3 pe-3 text-end"><i>Dead End St. Nº420 Apt.69</i></div>
                <div class="fw-light fs-3 pe-3 text-end"><b>255 889 232</b></div>
            </div>
            <div class="col-lg-6 col-md-12 ">
                <img class="img-fluid rounded" src="../assets/mock_map.png">
            </div>
        </div>
    </div>


<?php } ?>