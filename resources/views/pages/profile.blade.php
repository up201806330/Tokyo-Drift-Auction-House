@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/tpl_mod.css')}}">
@endsection

@section('title', 'Profile | ' . $profileOwner->username )

@section('content')

<section class="sign-in-container" style="flex: 1;">
    <div class="container bg-light rounded" style="height: 100%;">
        <div class="display-1 pt-5 ps-3 text-start">Profile page</div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-5 ps-4 pt-1">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="container d-flex justify-content-center position-relative">
                        <div class="d-flex justify-content-center circular--portrait img-fluid">
                            <img src="{{ asset('assets/' . $profileImage->path) }}" alt="" class="position-absolute">
                        </div>
                        
                        <div class="position-absolute" style="margin-bottom:220px; margin-left:220px">
                            @if (!Auth::guest())
                                @if (Auth::user()->id == $profileOwner->id)
                                    <div class="col d-flex justify-content-start align-items-center">

                                        <form id="profile-image-form" method="post" action="{{'/users/' . $profileOwner->id}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col mb-3">
                                                <label for="formFile" class="form-label">
                                                    <i class="fa fa-cog edit-cog" aria-hidden="true" style="cursor: pointer;"></i>
                                                </label>
                                                <input class="form-control" type="file" id="formFile" name="profileimage" style="display: none;" accept="image/png, image/jpeg">
                                            </div>
                                        </form>

                                        <script>
                                            document.getElementById("formFile").onchange = function() {
                                                document.getElementById("profile-image-form").submit();
                                            };
                                        </script>

                                    </div>
                                @endif
                            @endif
                        </div>

                        <div class="position-absolute" style="margin-top:220px; margin-left:220px">

                            @if (!Auth::guest())
                                @if (Auth::user()->id == $profileOwner->id)
                                    <div class="col d-flex justify-content-start align-items-center">

                                        <a class="" data-bs-toggle="collapse" href="#generalCollapse" role="button" aria-expanded="false" aria-controls="generalCollapse">
                                            <i class="fa fa-cog edit-cog" aria-hidden="true"></i>
                                        </a>

                                    </div>
                                @endif
                            @endif

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

                    <br>
                    
                </div>
                <div class="col-12 col-lg-6 bg-light mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-5">
                            <h3 class="fs-1 text-nowrap"><strong>About me</strong></h3>
                        </div>
                        @if (!Auth::guest())
                            @if (Auth::user()->id == $profileOwner->id)
                                <div class="col d-flex justify-content-start align-items-center">

                                    <a class="" data-bs-toggle="collapse" href="#aboutCollapse" role="button" aria-expanded="false" aria-controls="aboutCollapse">
                                        <i class="fa fa-cog edit-cog" aria-hidden="true"></i>
                                    </a>

                                </div>
                            @endif
                        @endif
                    </div>

                    <p class="text-muted fs-3 about-me-text">
                        {{$profileOwner->about}}
                    </p>
                    
                    <div class="collapse" id="aboutCollapse">
                        <form id="profile-about" method="post" action="{{'/users/' . $profileOwner->id}}" class="text-center">
                            @csrf
                            <textarea class="form-control" name="about_update" style="max-width: 100%;"></textarea>
                            <br>
                            <input type="submit" id="save_about" class="btn m-3 mt-0 rounded-pill w-75 fw-bold" value="Save Changes" />
                        </form>
                    </div>
                </div>
            </div>

            <br>
            
            <div class="collapse" id="generalCollapse">
                <form id="profile-general" method="post" action="{{'/users/' . $profileOwner->id}}">
                    @csrf
                    <div class="row" style="--bs-gutter-x:0;">
                        <div class="col form-floating mb-3 align-self-start">
                            <input required type="text" name="firstname" class="form-control" id="floatingInput" value="{{ old('firstname', $profileOwner->firstname) }}">
                            <label for="floatingInput">First Name</label>
                        </div>

                        <div class="col form-floating mb-3 ">
                            <input required type="text" name="lastname" class="form-control" id="floatingInput" value="{{ old('lastname', $profileOwner->lastname) }}">
                            <label for="floatingInput">Last Name</label>
                        </div>
                    </div>

                    <div class="row" style="--bs-gutter-x:0;">
                        <div class="col form-floating mb-3">
                            <input required type="text" name="username" class="form-control" id="floatingInput" value="{{ old('username', $profileOwner->username) }}">
                            <label for="floatingInput">Username</label>
                        </div>

                        <div class="col form-floating mb-3">
                            <input required type="text" name="location" class="form-control" id="floatingInput" value="{{ old('location', $profileOwner->location) }}">
                            <label for="floatingInput">Location</label>
                        </div>
                    </div>

                    <div class="row" style="--bs-gutter-x:0;">
                        
                        <div class="col modal-footer justify-content-center login-button px-5 pt-3 rounded-pill"> 
                            <button type="submit" id="save-general" class="btn m-3 mt-0 float-end rounded-pill w-75 fw-bold">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <div>
            @if (!Auth::guest())
                @if (Auth::user()->id == $profileOwner->id)
                    <main class="accordion-container border border-2 rounded-3">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Favourite Auctions
                                </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body fw-light row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-start mod-gallery p-sm-4 p-0 mx-0 rounded-3" style="overflow-y: scroll;">
                                        @foreach ($favouriteAuctions as $auction)
                                            @include('partials.auction_card', array(
                                                'id'            => $auction->id,
                                                'brand'         => $auction->vehicle->brand,
                                                'model'         => $auction->vehicle->model,
                                                'max_bid'       => $auction->getCurrentMaxBid(),
                                                'vehicle_imgs'  => $auction->getVehicleFromAuction(),
                                                'time_diff'     => $auction->getAdequateTimeDifference()
                                            ))
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-0">
                                <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Bidding on
                                </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body fw-light row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-start mod-gallery p-sm-4 p-0 mx-0 rounded-3" style="overflow-y: scroll;">
                                        @foreach ($biddingAuctions as $auction)
                                            @include('partials.auction_card', array(
                                                'id'            => $auction->id,
                                                'brand'         => $auction->vehicle->brand,
                                                'model'         => $auction->vehicle->model,
                                                'max_bid'       => $auction->getCurrentMaxBid(),
                                                'vehicle_imgs'  => $auction->getVehicleFromAuction(),
                                                'time_diff'     => $auction->getAdequateTimeDifference()
                                            ))
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item mt-0">
                                <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fs-2" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    Selling
                                </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body fw-light row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-start mod-gallery p-sm-4 p-0 mx-0 rounded-3" style="overflow-y: scroll;">
                                        @foreach ($ownedAuctions as $auction)
                                            @include('partials.auction_card', array(
                                                'id'            => $auction->id,
                                                'brand'         => $auction->vehicle->brand,
                                                'model'         => $auction->vehicle->model,
                                                'max_bid'       => $auction->getCurrentMaxBid(),
                                                'vehicle_imgs'  => $auction->getVehicleFromAuction(),
                                                'time_diff'     => $auction->getAdequateTimeDifference()
                                            ))
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                @endif
            @endif

            </div>
        </div>
        
    </div>
</section>

@if($errors->any())
    <div class="notification red-notif">
        <div class="row align-items-center">
            <div class="col-2 rounded-circle cross-container d-flex align-items-center justify-content-center">
                <i class="fa fa-times"></i>
            </div>
            <div class="col justify-content-center">
                {{$errors->first()}}
            </div>
        </div>        
    </div>
@else
    @if(session('success'))
        <div class="notification green-notif">
            <div class="row align-items-center">
                <div class="col-2 rounded-circle cross-container d-flex align-items-center justify-content-center">
                    <i class="fa fa-check"></i>
                </div>
                <div class="col justify-content-center">
                    {{session('success')}}
                </div>
            </div>        
        </div>
    @endif
@endif

@endsection