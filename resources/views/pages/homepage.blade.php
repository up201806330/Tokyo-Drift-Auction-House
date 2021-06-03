@extends('layouts.app')

@section('title', 'Tokyo Drift Auction House')

@section('content')

<div>
    <!-- Search Top Part of Homepage -->
    <!-- <div class="overlay" id="overlay" onclick="resetBg()"></div> -->
    <div class="homepage-bg-top">
        <div class="col-md-5 col-lg-5 col-xl-4 col-6 mx-auto my-auto search-box">
            <form method="post" action="{{ route('search') }}">
                @csrf
                <div class="input-group form-container">
                    <input type="hidden" name="homepageIdentifier" value="homepage" >
                    <input type="text" name="homepageSearch" class="form-control search-input" placeholder="Tesla Model S" autofocus="autofocus" autocomplete="off">
                    
                    <span class="input-group-btn">
                        <button class="btn btn-search" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
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

    <!-- Featured Condition Auctions Part of Homepage -->
    <div class="homepage-bg-bottom">
        <h4 class="full-res featured-cat-text text-md-start fs-1 text-white" style="float:left; padding-right: 0.4em !important;">Featured Condition - </h4>
        <h4 class="short-res featured-cat-text fs-1 text-white">Featured Condition</h4>
        <h4 class="featured-cat-text text-md-start fs-1 text-white">{{$condition_name}}</h4>
        
        <div class="container-fluid" id="search-background" style="flex: auto">
            <div class="row h-100">
                <!-- Container For All Featured Auctions -->
                <main class="col ms-sm-auto pt-4 px-md-4">
                    <div class="row row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 d-flex justify-content-center">
                        @foreach ($featured_condition as $auction)
                            
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

    <!-- Featured Past Auctions Part of Homepage -->
    <div class="homepage-bg-bottom">
        <h4 class="featured-cat-text fs-1 text-white">Past Auctions</h4>
        
        <div class="container-fluid" id="search-background" style="flex: auto">
            <div class="row h-100">
                <!-- Container For All Featured Auctions -->
                <main class="col ms-sm-auto pt-4 px-md-4">
                    <div class="row row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 d-flex justify-content-center">
                        @foreach ($past_auctions as $auction)
                            
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
