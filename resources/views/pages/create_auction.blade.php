@extends('layouts.app')

@section('title', 'Create auction')

@section('content')

<div id="create_auction_background">

    <!-- Form -->
    <div class="container-fluid p-5 mb-5 mt-5 clearfix text-left border border-1 border-secondary rounded-3" id="create_auction">
        <div class="display-3 text-start">Create Auction</div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5 pt-2 ps-2">
            <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
            <li class="breadcrumb-item"><a href="../pages/profile.php">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Auction</li>
        </ol>
        </nav>
        <hr class="bg-dark border-5 border-top border-dark">
        <form>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-4">
                    <div class="form-group m-1 m-md-2">
                        <label for="auctionName">Auction Name</label>
                        <input required type="text" class="form-control input_box" id="auctionName" placeholder="Auction Name">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="brand">Brand</label>
                        <input required type="text" class="form-control input_box" id="brand" placeholder="Brand">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="model">Model</label>
                        <input required type="text" class="form-control input_box" id="model" placeholder="Model">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="category">Category</label>
                        <input required type="text" class="form-control input_box" id="category" placeholder="Category">
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 m-0">
                    <img src="https://www.automaistv.com.br/wp-content/uploads/2019/04/bmw_i8_roadster_34-990x660.jpg" class="d-block mx-auto mt-3 border border-2 border-secondary rounded-3" id="image_input_preview" alt="bmw i8">
                    <div class="form-group mb-3  m-1 m-md-2">
                        <input type="file" class="form-control mx-auto" id="image_input" placeholder="Images Upload" multiple>
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="year">Year</label>
                        <input required type="number" min="1950" max="2021" class="form-control input_box" id="year" placeholder="Year">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="horsePower">Horse Power</label>
                        <div class="input-group">
                            <input type="number" min="0" max="2000" class="form-control input_box text-right" id="horsePower" placeholder="Horse Power">
                            <div class="input-group-append">
                                <span class="input-group-text append_box">hp</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="condition">Condition</label>
                        <select required class="form-select input_box" aria-label="condition">
                            <option selected value="" disabled>Select a condition</option>
                            <option value="mint">Mint</option>
                            <option value="clean">Clean</option>
                            <option value="average">Average</option>
                            <option value="rough">Rough</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="startingTime">Starting Time</label>
                        <input type="datetime-local" class="form-control input_box" id="startingTime" name="startingTime" value="2021-03-15T19:30">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="endingTime">Ending Time</label>
                        <input type="datetime-local" class="form-control input_box" id="endingTime" name="endingTime" value="2021-03-20T19:30">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="startingBid">Starting Bid</label>
                        <div class="input-group" id="staring_bid_group">
                            <input required type="number" min="0" max="100000000" class="form-control input_box text-right" id="startingBid" placeholder="Starting Bid">
                            <div class="input-group-append">
                                <span class="input-group-text append_box">€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-check form-switch m-3 m-md-4">
                <input class="form-check-input" type="checkbox" id="private" onclick="privateChange()">
                <label class="form-check-label private_label" for="private">Private Auction</label>
            </div>
            <div id="private_content" class="overflow-auto">
                <h5 class="text-center">Invited Bidders</h5>
                <div class="input-group form-container">
                    <input type="text" name="search" class="form-control search-input" placeholder="Hanna Green" autocomplete="off" onclick="setBgToDark()">
                    <span class="input-group-btn">
                        <a href="../pages/search.php">
                            <button class="btn btn-search">
                                <i class="fa fa-search"></i>
                            </button>
                        </a>
                    </span>
                </div>
                not here yet

            </div>

            <div class="text-center">
                <button class="btn float-end clearfix rounded-pill" type="submit" id="submit_button"><b>CREATE AUCTION</b></button>
            </div>
        </form>
    </div>
</div>

@endsection
