@extends('layouts.app')

@section('head')
    <script src="{{ asset('js/Comment.js')}}"></script>
    <script>
        const auctionId = '{{$auction->id}}';

        // Get comments
        Comment.updateSection(auctionId);
    </script>

    <script src="{{ asset('js/Countdown.js')}}"></script>

    <script>
        const startDateTime = '{{$auction->startingtime}}';
        const endDateTime = '{{$auction->endingtime}}';
        setup(startDateTime, endDateTime);
    </script>

    @include('templates.tpl_comment')
@endsection

@section('content')

<section class="sign-in-container">

    <div class="container bg-light rounded py-3 mb-5">

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-5 ps-2 pt-1 pb-2">
                <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
                <li class="breadcrumb-item"><a href="../pages/search.php">Search</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$vehicle->year}}' {{$vehicle->brand}} {{$vehicle->model}}</li>
            </ol>
        </nav>

        <div class="row align-items-center mx-auto">

            <!-- Pictures Carrousel -->
            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-start" id="under_heart">
            
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">

                        @foreach($images_paths as $images_path)
                            @if($images_path->sequence_number == 1)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="{{'Slide' . $images_path->sequence_number}}"></button>
                            @else
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$images_path->sequence_number - 1}}" aria-current="true" aria-label="{{'Slide' . $images_path->sequence_number}}"></button>
                            @endif
                        @endforeach

                    </div>
                    <div class="carousel-inner">
                        @foreach($images_paths as $images_path)
                            @if($images_path->sequence_number == 1)
                                <div class="carousel-item active">
                                    {{-- TODO mini hack to resize imgs :/ --}}
                                    <img src="{{ asset('assets/' . $images_path->path) }}" class="d-block w-100" alt="bmw i8">
                                </div>
                            @else
                                <div class="carousel-item">
                                    {{-- TODO mini hack to resize imgs :/ --}}
                                    <img src="{{ asset('assets/' . $images_path->path) }}" class="d-block w-100" alt="bmw i8">
                                </div>
                            @endif
                        @endforeach
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
                <a href=# class="heart">
                    <i class="fa fa-heart"></i>
                </a>
            </div>

            <!-- Vehicle Information 1 -->
            <div class="col-lg text-nowrap">
                
                <!-- General "name" -->
                <div class="row rounded-3 bg-dark text-white text-center my-2">
                    <h1>{{$vehicle->year}}' {{$vehicle->brand}} {{$vehicle->model}}</h1>
                </div>

                <!-- Specific Information -->
                <div class="row rounded-3 bg-dark text-white text-center py-2">
                    
                    <div class="row py-2 fs-4">
                        <div class="col">   Brand:              </div>
                        <div class="col">   {{$vehicle->brand}} </div>
                    </div>
                    <div class="row py-2 fs-4">
                        <div class="col">   Model:              </div>
                        <div class="col">   {{$vehicle->model}} </div>
                    </div>
                    <div class="row py-2 fs-4">
                        <div class="col">   Year:               </div>
                        <div class="col">   {{$vehicle->year}}  </div>
                    </div>
                    <div class="row py-2 fs-4">
                        <div class="col">   Horsepower:              </div>
                        <div class="col">   {{$vehicle->horsepower}} </div>
                    </div>
                    <div class="row py-2 fs-4 align-items-center">
                        <div class="col">   Condition:                          </div>
                        <div class="col fire-text">   <i class="fa fa-fire m-3"></i> {{Str::upper($vehicle->condition)}} </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates -->
        <div class="row text-white text-center align-items-center my-2 mx-auto">
            <div class="col-lg text-nowrap rounded-start bg-dark">
                <div class="row py-2 fs-4">
                    <div class="col">   Starting date:  </div>
                    <div class="col">   {{\Carbon\Carbon::parse($auction->startingtime)->format('Y-m-d')}} @ {{\Carbon\Carbon::parse($auction->startingtime)->format('H:i:s')}} </div>
                </div>
            </div>

            <div class="col-lg text-nowrap rounded-end bg-dark">
                <div class="row py-2 fs-4">
                    <div class="col">   Closing date:   </div>
                    <div class="col">   {{\Carbon\Carbon::parse($auction->endingtime)->format('Y-m-d')}} @ {{\Carbon\Carbon::parse($auction->endingtime)->format('H:i:s')}} </div>
                </div>
            </div>
        </div>

        <!-- Start of bordered box -->
        <div class="rounded-3 border border-2 border-dark">

            <!-- Current Bid info -->
            <div class="row mt-4 mb-4">
                <div class="col fs-3">
                    <div class="text-center">Owner</div>
                    <div class="text-center">
                        <a href="{{ url('/users/' . $owner->id) }}" class="profile_text">
                            <img src="{{ asset('assets/' . $owner_img->path) }}" class="rounded-circle profile_picture" alt="Hanna Green"> 
                            
                            <h4 class="" style="color: rgb(204, 174, 2)">{{ $owner->username }}</h4>
                        </a>
                    </div>
                </div>

                <div class="col fs-3">
                    <div class="text-center">Current Bid</div>
                    <div class="text-center fs-1">{{$max_bid}}€</div>
                    
                    
                    <!-- Place Bid -->
                    @if (!Auth::guest())
                        {{-- <div class="row-sm"> --}}
                        <div class="row text-center justify-content-around">
                            <form class="row justify-content-around">
                                <div class="bid-input input-group mb-3">
                                    {{-- <button type="button" onclick="this.parentNode.querySelector('[type=number]').stepDown();"> --}}
                                    <span class="input-group-text" onclick="this.parentNode.querySelector('[type=number]').stepDown();">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </span>
                                    {{-- </button> --}}

                                    <input type="number" class="form-control text-center" id="bid_input" aria-label="Amount (to the nearest dollar)" min="{{$max_bid + 1}}" max="100000000" value="{{$max_bid + 1}}">
                                    {{-- <input type="number" name="bidamount" min="{{$max_bid + 1}}" max="100000000" value="{{$max_bid + 1}}" id="bid_input"> --}}

                                    <span class="input-group-text" onclick="this.parentNode.querySelector('[type=number]').stepUp();">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </span>
                                    
                                    {{-- <button class="btn btn-secondary" type="button" onclick="this.parentNode.querySelector('[type=number]').stepUp();">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </button> --}}
                                </div>

                                <button type="submit" class="btn rounded-pill" id="bid_button"><h4 class="m-0 p-2">Place Bid</h4></button>
                            
                            </form>
                        </div>
                    @endif
                </div>

                <div class="col fs-3">
                    <div class="text-center">Top Bidder</div>
                    <div class="text-center">
                        <a href="{{ url('/users/' . $highest_bidder->id) }}" class="profile_text">
                            <img src="{{ asset('assets/' . $bidder_img->path) }}" class="rounded-circle profile_picture" alt="Hank Geller"> 
                            <h4 class="">{{$highest_bidder->username}}</h4>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Countdown -->
            <div class="container mt-5" id="auction_content_area">
                <div class="row d-flex flex-row justify-content-around align-items-center">
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-6 countdown_box">
                                <h1 class="display-1 m-0" id="days"></h1>
                                <h4>Days</h4>
                            </div>
                            <div class="col-6 countdown_box">
                                <h1  class="display-1 m-0" id="hours"></h1>
                                <h4>Hours</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-6 countdown_box">
                                <h1  class="display-1 m-0" id="minutes"></h1>
                                <h4>Minutes</h4>
                            </div>
                            <div class="col-6 countdown_box">
                                <h1  class="display-1 m-0" id="seconds"></h1>
                                <h4>Seconds</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <h4 class="d-flex justify-content-between mt-3 pb-5">

                    @if (\Carbon\Carbon::now() > $auction->endingtime)
                        <span> </span>
                        <span>A</span><span>U</span><span>C</span><span>T</span><span>I</span><span>O</span><span>N</span>
                        <span> </span><span> </span>
                        <span>H</span><span>A</span><span>S</span>
                        <span> </span><span> </span>
                        <span>E</span><span>N</span><span>D</span><span>E</span><span>D</span>
                        <span> </span>
                    @else
                        <span> </span>
                        <span>T</span><span>I</span><span>L</span><span>L</span>
                        <span> </span><span> </span>
                        <span>A</span><span>U</span><span>C</span><span>T</span><span>I</span><span>O</span><span>N</span>
                        <span> </span><span> </span>
                        @if ($auction->startingtime > \Carbon\Carbon::now())
                            <span>B</span><span>E</span><span>G</span><span>I</span><span>N</span><span>S</span>
                        @else
                            <span>E</span><span>N</span><span>D</span><span>S</span>
                        @endif
                        <span> </span>

                    @endif
                </h4>
            </div>

        <!-- End of bordered box -->
        </div>

    <!-- End of White Box -->
    </div>
</section>

<div class="auction_background">
    <!-- Top Bar with car details -->
    <div class="container-fluid car-details">
      

    <div class="row align-items-center mx-auto">

        <!-- Car Info -->
        <div class="col-lg text-nowrap">
            {{-- <h1>{{$vehicle->year}}' {{$vehicle->brand}} {{$vehicle->model}}</h1> --}}
                {{-- <div class="row align-items-center m-3">
                    <div class="col">
                        <h2>{{$vehicle->brand}}</h2>
                        <h4>{{$vehicle->year}}</h4>
                    </div>
                    <div class="col">
                        <h2>{{$vehicle->model}}</h2>
                        <h4>{{$vehicle->horsepower}} hp</h4>
                    </div>
                    <div class="col fire-text d-flex align-items-center justify-content-center" style="font-size: 4rem;">
                        <i class="fa fa-fire m-3"></i>
                        <h4 class="mb-0">{{Str::upper($vehicle->condition)}}</h4>
                    </div>
                </div> --}}
            {{-- <div class="row align-items-center m-3 text-center">
                <div class="col">
                    <p>Start date:</p>
                    <h6>{{\Carbon\Carbon::parse($auction->startingtime)->format('H:i:s')}}</h6>
                    <h6>{{\Carbon\Carbon::parse($auction->startingtime)->format('Y-m-d')}}</h6>
                </div>
                <div class="col">
                    <p>End date:</p>
                    <h6>{{\Carbon\Carbon::parse($auction->endingTime)->format('H:i:s')}}</h6>
                    <h6>{{\Carbon\Carbon::parse($auction->endingTime)->format('Y-m-d')}}</h6>
                </div>
            </div> --}}
        </div>
    </div>
      
</div>
  
{{-- <div class="auction_content rounded-3 border border-2 border-dark bg-white"> --}}
    <!-- Current Bid info -->
    {{-- <div class="container" id="auction_content_area">
        <div class="row mx-auto align-items-center justify-content-around">
            <div class="col-12 col-md-4 mt-3 mb-3">
                <h2>Owner</h2>
                <a href="{{ url('/users/' . $owner->id) }}" class="profile_text">
                    <img src="{{ asset('assets/' . $owner_img->path) }}" class="rounded-circle profile_picture mt-3" alt="Hanna Green"> 
                      
                    <h4 class="m-0" style="color: rgb(204, 174, 2)">{{ $owner->username }}</h4>
                </a>
            </div>
            <div class="col-12 col-md-4 mt-3 mb-1">
                <h2>Current Bid</h2>
                <h1 class="current_bid">{{$max_bid}} €</h1>
            </div>
            <div class="col-12 col-md-4 mt-3 mb-3">
                <h2 class="text-nowrap">Top Bidder</h2>
                <a href="{{ url('/users/' . $highest_bidder->id) }}" class="profile_text">
                    <img src="{{ asset('assets/' . $bidder_img->path) }}" class="rounded-circle profile_picture mt-3" alt="Hank Geller"> 
                    <h4 class="m-0">{{$highest_bidder->username}}</h4>
                </a>
            </div>
        </div>
    </div> --}}

    <!-- Place Bid -->
    {{-- @if (!Auth::guest())
        <div class="container mt-5" id="auction_content_area">
            <form>
                <div class="row align-items-center">
                    <div class="col-sm">
                        <div class="input-group">
                            <input type="number" min="0.00" step="1" value="205000" class="form-control" id="bid_input" placeholder="Your Bid">
                                <div class="input-group-append">
                                    <span class="input-group-text append_box" id="bid_input_box">€</span>
                                </div>
                        </div>

                    </div>
                    <div class="col-sm p-0 mt-3 mb-3">
                        <button type="submit" class="btn rounded-pill" id="bid_button"><h2 class="m-0 p-2">PLACE BID</h2></button>
                    </div>
                </div>
            </form>
        </div>
    @endif --}}

    <!-- Countdown -->
    {{-- <div class="container mt-5" id="auction_content_area">
        <div class="row d-flex flex-row justify-content-around align-items-center">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6 countdown_box">
                        <h1 class="display-1 m-0" id="days"></h1>
                        <h4>Days</h4>
                    </div>
                    <div class="col-6 countdown_box">
                        <h1  class="display-1 m-0" id="hours"></h1>
                        <h4>Hours</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6 countdown_box">
                        <h1  class="display-1 m-0" id="minutes"></h1>
                        <h4>Minutes</h4>
                    </div>
                    <div class="col-6 countdown_box">
                        <h1  class="display-1 m-0" id="seconds"></h1>
                        <h4>Seconds</h4>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="d-flex justify-content-between mt-3 pb-5">

            @if (\Carbon\Carbon::now() > $auction->endingtime)
                <span> </span>
                <span>A</span>
                <span>U</span>
                <span>C</span>
                <span>T</span>
                <span>I</span>
                <span>O</span>
                <span>N</span>
                <span> </span>
                <span> </span>
                <span>H</span>
                <span>A</span>
                <span>S</span>
                <span> </span>
                <span> </span>
                <span>E</span>
                <span>N</span>
                <span>D</span>
                <span>E</span>
                <span>D</span>
                <span> </span>
            @else
                <span> </span>
                <span>T</span>
                <span>I</span>
                <span>L</span>
                <span>L</span>
                <span> </span>
                <span> </span>
                <span>A</span>
                <span>U</span>
                <span>C</span>
                <span>T</span>
                <span>I</span>
                <span>O</span>
                <span>N</span>
                <span> </span>
                <span> </span>
                @if ($auction->startingtime > \Carbon\Carbon::now())
                    <span>B</span>
                    <span>E</span>
                    <span>G</span>
                    <span>I</span>
                    <span>N</span>
                    <span>S</span>
                @else
                    <span>E</span>
                    <span>N</span>
                    <span>D</span>
                    <span>S</span>
                @endif
                <span> </span>

            @endif
        </h4>
    </div> --}}

{{-- </div> --}}

<!-- Comment Section -->
<div class="display-1" style="margin-left: 15%;">Comment Section</div>
    <div class="container-fluid p-0 rounded-3 border border-2 border-dark bg-light" id="comment_section">
      
    @if (!Auth::guest())
        <!-- Place Comment -->
        <div class="comment pb-2 clearfix rounded-3 border border-2">
            <form onsubmit="Comment.submit(this, auctionId); Comment.updateSection(auctionId); return false;">
                <!-- User and date -->
                <a href="{{ route('show_profile', ['id' => Auth::id()]) }}" class="profile_text">
                @if (Auth::guest())
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ asset('assets/generic_profile.png') }}" class="rounded-circle profile_picture_comment m-3" alt="generic profile picture"> 
                    </div>
                @else
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ asset('assets/' . App\Models\User::findUserImage(Auth::id())->path) }}" class="rounded-circle profile_picture_comment m-3" alt="user profile image"> 
                        <div>
                            <h6 class="m-0">{{App\Models\User::find(Auth::id())->username}}</h6>
                        </div>
                    </div>
                @endif
                </a>
                <div class="m-3 mt-0">
                    <textarea class="form-control text-justify" name="content" id="comment_input" rows="3" placeholder="Insert your comment here."></textarea>
                </div>
                <button type="submit" class="btn m-3 mt-0 float-end rounded-pill" id="comment_button">COMMENT</button>
            </form>
        </div>
    @endif
    
    <div id="other-comments">
    </div>

  <!-- Chat Button -->
  <a href="#" class="chat_button">
      <i class="fa fa-comments chat_icon"></i>
  </a>
</div>

@endsection
