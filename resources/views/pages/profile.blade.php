@extends('layouts.app')


@section('content')

<section class="sign-in-container">
    <div class="container bg-light rounded pb-1">
        <div class="display-1 pt-5 ps-2 text-start">Profile page</div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5 ps-4 pt-1">
            <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
        </nav>

        <div class="container">
            <div class="row ps-4">
                <div class="col-12 col-lg-6">
                    <div class="container d-flex justify-content-center position-relative">
                        <div class="d-flex justify-content-center circular--portrait img-fluid">
                            <img src="{{ asset('assets/' . $profileImage->path) }}" alt="" class="position-absolute">
                        </div>
                        <div class="position-absolute" style="margin-top:220px; margin-left:220px">

                            {{-- for a possible future profile image update --}}
                            {{-- <form id="profile-image-form" method="post" action="{{'/users/' . $profileOwner->id}}">
                                @csrf --}}
                                <label for="file-input">
                                    <i class="fa fa-cog" aria-hidden="true" style="pointer: cursor;"></i>
                                </label>
                                {{-- <input id="file-input" type="file" name="file" style="display: none;"/> --}}

                            {{-- </form> --}}

                            {{-- <script>
                                document.getElementById("file-input").onchange = function() {
                                    document.getElementById("profile-image-form").submit();
                                };
                            </script> --}}
                        </div>
                    </div>

                    <p class="display-5 fw-bold name-text text-center" style="margin-top:250px; margin-bottom: -0.4rem !important;" id="adminTextStatic">{{$profileOwner->firstname}} {{$profileOwner->lastname}}</p>
                    <p class="fs-5 fw-bold name-text text-muted text-center" style="letter-spacing: 3px; ">{{'@'}}{{$profileOwner->username}}</p>
                    <p class="fs-6 fw-bold name-text text-center" ><i class="fa fa-map-marker" style="margin-left:-0.5rem; margin-right:0.5rem;"></i>{{$profileOwner->location}}</p>
                    
                    <div class="container iconHolder d-flex justify-content-center">
                        <a class="permission-icon" href="../pages/mod.php" data-mdb-toggle="tooltip" title="Moderator">
                            <i class="fas fa-user-cog gold fa-3x pe-3"></i> 
                        </a>
                        <a class="permission-icon" href="#" data-mdb-toggle="tooltip" title="Buyer">
                            <i class="fas fa-wallet red fa-3x"></i>
                        </a>
                        <a class="permission-icon" href="#" data-mdb-toggle="tooltip" title="Seller">
                            <i class="fas fa-store green fa-3x ps-3"></i>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 bg-light mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-5">
                            <h3 class="fs-1 text-nowrap"><strong>About me</strong></h3>
                        </div>
                        <div class="col d-flex justify-content-start align-items-center">

                            <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                            </a>

                        </div>
                    </div>

                    <p class="text-muted fs-3 about-me-text">
                        {{$profileOwner->about}}
                    </p>
                    
                    <div class="collapse" id="collapseExample">
                        <form id="profile-about" method="post" action="{{'/users/' . $profileOwner->id}}">
                            @csrf
                            <textarea rows="5" cols="60" name="about_update"></textarea>
                            <br><br>
                            <input type="submit" value= "Update About" />
                        </form>
                    </div>
                </div>
            </div>

            <div class="profile-auction-gallery">
                <div class="display-3 ps-2 ms-5 pb-3">History</div>
                <div class="dropdown pb-3" id="dropdown-auctions-profile">
                    <button class="btn bg-dark text-white border-dark dropdown-toggle fs-4 profile-auction-gallery-title rounded-pill" type="button" id="selectAuctionsProfile" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Auctions
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="selectAuctionsProfile">
                        <li><a class="dropdown-item" href="#selectAuctionsProfile" onclick="updateDropdownAuctionsProfile(this)">Currently Bidding</a></li>
                        <li><a class="dropdown-item" href="#selectAuctionsProfile" onclick="updateDropdownAuctionsProfile(this)">Currently Selling</a></li>
                        <li><a class="dropdown-item" href="#selectAuctionsProfile" onclick="updateDropdownAuctionsProfile(this)">Successfully Bought</a></li>
                        <li><a class="dropdown-item" href="#selectAuctionsProfile" onclick="updateDropdownAuctionsProfile(this)">Successfully Sold</a></li>
                    </ul>
                </div>

                <?php?>
                {{-- include_once('../templates/tpl_mod.php');
                draw_auction_gallery(); --}}
                <?php?>

            </div>
        </div>
        
    </div>
</section>

@endsection