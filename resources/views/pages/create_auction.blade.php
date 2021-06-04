@extends('layouts.app')

@section('title', 'Create auction')

@section('head')
    <script src="{{ asset('js/create_auction.js')}}"></script>
@endsection

@section('content')

<div id="create_auction_background">

    <!-- Form -->
    <div class="container-fluid p-5 mb-5 mt-5 clearfix text-left border border-1 border-secondary rounded-3" id="create_auction">
        <div class="display-3 text-start">Create Auction</div>
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5 pt-2 ps-2">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Auction</li>
        </ol>
        </nav>
        <hr class="bg-dark border-5 border-top border-dark">
        <form method="post" enctype="multipart/form-data" action="{{ route('create_auction') }}" onsubmit="return validateForm()">
            @csrf
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-4">
                    <div class="form-group m-1 m-md-2">
                        <label for="auctionName">Auction Name</label>
                        <input required type="text" class="form-control input_box" id="auctionName" name="auctionName" placeholder="Auction Name">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="brand">Brand</label>
                        <input required type="text" class="form-control input_box" id="brand" name="brand" placeholder="Brand">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="model">Model</label>
                        <input required type="text" class="form-control input_box" id="model" name="model" placeholder="Model">
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 m-0">
                    <fieldset class="form-group text-center">
                        <button class="btn btn-search w-100" type="button" onclick="button_click()">Upload Image</button>
                        <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
                    </fieldset>
                    <div id="preview-images-zone"></div>
                    <div id="hidden-input-pictures"></div>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group m-1 m-md-2 year-input">
                        <label for="year">Year</label>
                        <input required type="number" min="1950" max="2021" class="form-control input_box" id="year" name="year" placeholder="Year">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="horsePower">Horse Power</label>
                        <div class="input-group horsepower-input">
                            <input required type="number" min="0" max="2000" class="form-control input_box text-right" id="horsePower" name="horsepower" placeholder="Horse Power">
                            <div class="input-group-append">
                                <span class="input-group-text append_box">hp</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="condition">Condition</label>
                        <select required class="form-select input_box" name="condition" aria-label="condition">
                            <option selected value="" disabled>Select a condition</option>
                            <option value="Mint">Mint</option>
                            <option value="Clean">Clean</option>
                            <option value="Average">Average</option>
                            <option value="Rough">Rough</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="startingDate">Starting Date</label>
                        <input required type="date" name="startingdate" class="form-control input_box" id="startingDate" value="">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="startingTime">Starting Time</label>
                        <input required type="time" name="startingtime" class="form-control input_box" id="startingTime" value="00:00" step="60">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="endingDate">Closing Date</label>
                        <input required type="date" name="endingdate" class="form-control input_box" id="endingDate" value="">
                    </div>
                    <div class="form-group m-1 m-md-2">
                        <label for="endingTime">Closing Time</label>
                        <input required type="time" name="endingtime" class="form-control input_box" id="endingTime" value="00:00" step="60">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group m-1 m-md-2">
                        <label for="startingBid">Starting Bid</label>
                        <div class="input-group year-input" id="staring_bid_group">
                            <input required type="number" min="0" max="100000000" class="form-control input_box text-right" id="startingBid" name="startingBid" placeholder="Starting Bid">
                            <div class="input-group-append">
                                <span class="input-group-text append_box">€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-check form-switch m-3 m-md-4">
                <input class="form-check-input" type="checkbox" id="private" name="private" onclick="privateChange()">
                <label class="form-check-label private_label" for="private">Private Auction</label>
            </div>

            <div class="d-flex">
                <div id="moderators_content" class="moderator_search overflow-auto">
                    <h5 class="text-center">Auction Moderators</h5>
                    <div class="input-group form-container">
                        <input type="text" name="search" class="form-control search-input" placeholder="Hanna Green" autocomplete="off" id="user_search">
                        <span class="input-group-btn">
                            <button class="btn btn-search" type="button" onclick="updateModerators()">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- Show the users for selection, filter through js-->
                    <div id="moderator_rows">
                        @foreach($users as $user)
                            @if (!$user['moderator'] && !($user['id']==Auth::id()))
                                <div class="user_row d-flex justify-content-between align-items-center">
                                    <span class="user_id d-none">{{$user['id']}}</span>
                                    <a href="../pages/profile.php" class="profile_text">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img src="{{ $user['image_path'] }}" class="rounded-circle profile_picture_comment m-2" alt="{{$user['username']}}"> 
                                                <h5 class="my-3 ms-3" style="color: rgb(204, 174, 2)">@<span class="username">{{$user['username']}}</span></h5>
                                        </div>
                                    </a>
                                    <div class="moderator area text-center">
                                        <div class="form-group form-check form-switch">
                                            <input class="form-check-input moderator_user" type="checkbox">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div id="hidden_moderator_rows"></div>
                </div>

                <div id="private_content" class="user_search overflow-auto">
                    <h5 class="text-center">Invited Bidders</h5>
                    <div class="input-group form-container">
                        <input type="text" name="search" class="form-control search-input" placeholder="Hanna Green" autocomplete="off" id="user_search">
                        <span class="input-group-btn">
                            <button class="btn btn-search" type="button" onclick="updateUsers()">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- Show the users for selection, filter through js-->
                    <div id="user_rows">
                        @foreach($users as $user)
                            <div class="user_row d-flex justify-content-between align-items-center">
                                <span class="user_id d-none">{{$user['id']}}</span>
                                <a href="../pages/profile.php" class="profile_text">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img src="{{ $user['image_path'] }}" class="rounded-circle profile_picture_comment m-2" alt="{{$user['username']}}"> 
                                            <h5 class="my-3 ms-3" style="color: rgb(204, 174, 2)">@<span class="username">{{$user['username']}}</span></h5>
                                    </div>
                                </a>
                                <div class="moderator area text-center">
                                    <div class="form-group form-check form-switch">
                                        <input class="form-check-input private_user" type="checkbox">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div id="hidden_user_rows"></div>
                </div>
            </div>

            <div class="text-center">
                <button class="btn float-end clearfix rounded-pill" type="submit" id="submit_button"><b>CREATE AUCTION</b></button>
            </div>
        </form>
    </div>
</div>

<div class="red-notif" id="upload_error" style="display:none;z-index: 0;">
    <div class="row align-items-center">
        <div class="col-2 rounded-circle cross-container d-flex align-items-center justify-content-center">
            <i class="fa fa-times"></i>
        </div>
        <div class="col justify-content-center" id="notification_text">
        </div>
    </div>        
</div>

@endsection
