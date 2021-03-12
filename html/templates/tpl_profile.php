<?php function draw_profile() {
    /**
     * Draws profile
     */
    ?>

<section class="bg-light">

    <div class="container">

        <!-- Section: Images -->
        <section class="mb-3">
        
            <!-- Background image -->
            <div
                class="p-5 text-center bg-image shadow-1-strong rounded-bottom d-flex justify-content-center"
                style="
                background-image: url('https://mdbootstrap.com/img/new/slides/041.jpg');
                height: 400px;
                "
            >

                <div class="d-flex justify-content-center circular--portrait" style="margin-top: 10rem; border-style: solid; border-color: #233233;">
                    <img src="../assets/thisisfine_.jpg" alt="" class="position-absolute">
                </div>
                <a href="#" style="color: #223223;" id="edit-profile-pic-a"><i class="fa fa-edit button"></i></a>
            </div>
            <!-- Background image -->

        </section>
        <!-- Section: Images -->

        <div class="row">
            <div class="col text-center pt-3">
                <a class="permission-icon" href="#" data-mdb-toggle="tooltip" title="Moderator">
                    <i class="fas fa-user-cog fa-3x pe-3"></i> 
                </a>
                <a class="permission-icon" href="#" data-mdb-toggle="tooltip" title="Buyer">
                    <i class="fas fa-wallet fa-3x"></i>
                </a>
                <a class="permission-icon" href="#" data-mdb-toggle="tooltip" title="Seller">
                    <i class="fas fa-store fa-3x ps-3"></i>
                </a>
            </div>
                
        </div>


        <!-- Section: User Data -->
        <section class="user-data-profile">
            
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <div class="row username-row">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-9">
                                    <h3 class="fs-1"><strong>Username</strong></h3>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </div>
                            </div>
                            
                            <p class="text-muted fs-3 username-text">
                                ThisIsFine
                            </p>
                        </div>
                    </div>
                    <div class="row name-row">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-9">
                                    <h3 class="fs-1"><strong>Name</strong></h3>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </div>
                            </div>

                            <p class="text-muted fs-3 name-text">
                                André Mindelo
                            </p>
                        </div>
                    </div>
                    <div class="row based-on-row">
                        <div class="col-md-6">
                            
                            <div class="row">
                                <div class="col-9">
                                    <h3 class="fs-1"><strong>Based on</strong></h3>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </div>
                            </div>

                            <p class="text-muted fs-3 based-on-text">
                                Amarante, Porto
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col my-auto">

                    <div class="row">
                        <div class="col-5">
                            <h3 class="fs-1"><strong>About me</strong></h3>
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </div>
                    </div>

                    <p class="text-muted fs-3 about-me-text">
                        Hello! I'm André, a fellow car collector!<br>
                        I've been collecting super cars for the last 10 years and once every few months I go look for another piece for my collection.
                    </p>
                </div>
            </div>
            
        </section>
        <!-- Section: User Data -->

    </div>

</section>

<?php } ?>