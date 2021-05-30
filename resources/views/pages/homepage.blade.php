@extends('layouts.app')

@section('title', 'Tokyo Drift Auction House')

@section('content')

<div>
    <!-- Search Top Part of Homepage -->
    <!-- <div class="overlay" id="overlay" onclick="resetBg()"></div> -->
    <div class="homepage-bg-top">
        <div class="col-md-5 col-lg-5 col-xl-4 col-6 mx-auto my-auto search-box">
            <div class="input-group form-container">
                <input type="text" name="search" class="form-control search-input" placeholder="Tesla Model S" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">
                <span class="input-group-btn">
                    <a href="../pages/search.php">
                        <button class="btn btn-search">
                            <i class="fa fa-search"></i>
                        </button>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <!-- Fire Deals Part of Homepage -->
    <div class="homepage-bg-bottom">
        <h4 class="fire-deals-text text-md-start pt-5">Fire Deals</h4>
        
        <div class="container-fluid" id="search-background" style="flex: auto">
            <div class="row h-100">
                <!-- Container For All Displayed Auctions -->
                <main class="col ms-sm-auto pt-4 px-md-4">
                    <div class="row row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 d-flex justify-content-center">
                        @foreach ($fire_deals as $auction)
                            
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
                </main>
            </div>
        </div>
        <!-- End of Container For All Displayed Auctions -->
    </div>

    <!-- Featured Auctions Part of Homepage -->
    <div class="homepage-bg-bottom">
        <h4 class="full-res featured-cat-text text-md-start fs-1 text-white" style="float:left; padding-right: 0.4em !important;">Featured Category - </h4>
        <h4 class="short-res featured-cat-text fs-1 text-white">Featured Category</h4>
        <h4 class="featured-cat-text text-md-start fs-1 text-white">{{$category_name}}</h4>
        
        <div class="container-fluid" id="search-background" style="flex: auto">
            <div class="row h-100">
                <!-- Container For All Featured Auctions -->
                <main class="col ms-sm-auto pt-4 px-md-4">
                    <div class="row row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 d-flex justify-content-center">
                        @foreach ($featured_categ as $auction)
                            
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
                </main>
                <!-- End of Container For All Featured Auctions -->
            </div>
        </div>
    </div>
</div>

@endsection
