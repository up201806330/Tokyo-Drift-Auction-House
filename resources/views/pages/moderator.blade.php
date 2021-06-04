@extends('layouts.app')

@section('title', 'Moderator')

@section('head')
    <script src="{{ asset('js/moderator.js')}}"></script>
@endsection

@section('content')

<div class="container" id="modContainer" style="background-color: rgb(223, 223, 223);">
    <main class="mod col-12 col-md-10 mx-auto bg-light rounded">
        <div class="marginsMod">
            <div class="display-1 text-start pt-5 ps-2">
                Moderator page
            </div>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-5 ps-4 pt-1 pb-5">
                <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../pages/profile.php">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Moderator page</li>
            </ol>
            </nav>
            @if ($user->isAdmin())
                <div class="display-4 ps-4 pb-1 pt-0 pt-md-5">
                    Manage user profiles
                </div>
                <div class="display-5 fs-3 pb-4 ps-4">
                    <i>You can manage these users' permissions. <a href="../pages/tos.php#admins">What's this?</a></i>
                </div>

                <!-- Show users for moderation-->
                <div class="overflow-auto user_search">
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
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading">
                                <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-controls="collapse{{$user->id}}">
                                    <a class="profile_text">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img src="{{ $user->getImagePath() }}" class="rounded-circle profile_picture_comment m-2" alt="{{$user->username}}"> 
                                            <h5 class="my-3 ms-3" style="color: rgb(204, 174, 2)">@<span class="username">{{$user->username}}</span></h5>
                                        </div>
                                    </a>
                                </button>
                                <div id="collapse{{$user->id}}" class="accordion-collapse collapse" aria-labelledby = "heading{{$user->id}}" data-bs-parent="#userAccordion">
                                    <div class="accordion-body">
                                        <form method="post" action="{{ url('moderator/users/' . $user->id) }}">
                                            @csrf
                                            <div class="row p-2 rounded mb-1">
                                                <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Seller">
                                                    <i class="fas fa-store fa-3x fs-2"></i>
                                                </a>
                                                <h5 class="green d-none d-sm-inline col pt-1">Seller privileges</h5>
                                                <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                                                    <input class="form-check-input" name="seller" type="checkbox" checked>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row p-2 rounded mb-1">
                                                <a class="permission-icon col col-sm-1 align-self-start" href="#" data-mdb-toggle="tooltip" title="Buyer">
                                                    <i class="fas fa-wallet fa-3x fs-2"></i>
                                                </a>
                                                <h5 class="red d-none d-sm-inline col pt-1">Global Moderator privileges</h5>
                                                <div class="form-group form-check form-switch col-2 col-md-1 pt-1">
                                                    <input class="form-check-input" name="global" type="checkbox">
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row p-2 rounded mb-1">
                                                <button type="submit" class="btn btn-outline-success">Submit Changes</button>
                                            </div>
                                        </form>
                                        <form method="post" action="{{ url('/users/' . $user->id . '/banned') }}">
                                            @csrf
                                            <div class="row p-2 rounded mb-1">
                                                <button type="submit" class="btn btn-outline-danger">Ban User</button>
                                            </div>
                                        </form>
                                        <form method="post" action="{{ url('/users/' . $user->id) }}">
                                            @csrf
                                            @method('delete')
                                            <div class="row p-2 rounded mb-1">
                                                <button type="submit" class="btn btn-outline-danger">Delete Account</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="display-4 ps-4 pb-1 pt-0 pt-md-5">
                Manage auctions
            </div>
            <div class="display-5 fs-3 pb-4 ps-4">
                <i>You have moderator privileges over these auctions. <a href="../pages/tos.php#mods">What's this?</a></i>
            </div>
            <!-- Show Auctions for moderation -->
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 justify-content-start mod-gallery overflow-auto p-sm-4 p-0  mx-0 mx-md-5 rounded-3 border border-5 border-secondary">
                <div class="input-group form-container pb-4">
                    <input type="text" name="search" class="form-control search-input" placeholder="Search for an auction" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">
                    <span class="input-group-btn">
                        <a href="../pages/search.php">
                            <button class="btn btn-search">
                                <i class="fa fa-search"></i>
                            </button>
                        </a>
                    </span>
                </div>

                @foreach ($auctions as $auction)                           
                    @include('partials.auction_card', array(
                        'id'            => $auction->id,
                        'brand'         => $auction->vehicle->brand,
                        'model'         => $auction->vehicle->model,
                        'max_bid'       => $auction->getCurrentMaxBid(),
                        'vehicle_imgs'  => $auction->getVehicleFromAuction(),
                        'time_diff'     => $auction->getAdequateTimeDifference()
                    ))
                @endforeach
            <div class="row p-4"></div>
        </div>
    </main>
</div>



</div>

@endsection