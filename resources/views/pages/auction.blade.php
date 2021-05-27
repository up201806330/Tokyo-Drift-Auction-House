@extends('layouts.app')

@section('title', $vehicle->year . "' " . $vehicle->brand . " " . $vehicle->model)

@section('head')
    <script src="{{ asset('js/DateFormatter.js')}}"></script>
    <script src="{{ asset('js/Comment.js')}}"></script>
    <script src="{{ asset('js/Bid.js')}}"></script>
    <script src="{{ asset('js/CountdownClock.js')}}"></script>

    <script>
        const auctionId = '{{$auction->id}}';
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function(){
            // Get comments
            Comment.updateSection(auctionId);

            // Get bids
            Bid.updateSection(auctionId);

            // Update start and end times
            document.querySelector('#start-date').innerHTML = DateFormatter.formatLocal(Utils.DateFromUTC("{{ $auction->startingtime }}"), "%Y-%m-%d @ %H:%M:%S");
            document.querySelector('#end-date'  ).innerHTML = DateFormatter.formatLocal(Utils.DateFromUTC("{{ $auction->endingtime   }}"), "%Y-%m-%d @ %H:%M:%S");
        });
    </script>

    <script>
        // Auction countdown
        let startingTime = Utils.DateFromUTC('{{$auction->startingtime}}');
        let endingTime   = Utils.DateFromUTC('{{$auction->endingtime  }}');
        let auctionCountdown = new CountdownClock(
            (
                new Date() < startingTime ?
                startingTime :
                endingTime
            ),
            function (t) {
                t = Math.max(-t, 0);
                document.querySelector('#days'   ).innerText = Utils.padLeft(Math.floor((t                        ) / (1000 * 60 * 60 * 24)).toString(), 2, '0');
                document.querySelector('#hours'  ).innerText = Utils.padLeft(Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60     )).toString(), 2, '0');
                document.querySelector('#minutes').innerText = Utils.padLeft(Math.floor((t % (1000 * 60 * 60     )) / (1000 * 60          )).toString(), 2, '0');
                document.querySelector('#seconds').innerText = Utils.padLeft(Math.floor((t % (1000 * 60          )) / (1000               )).toString(), 2, '0');

                auctionCountdown.begin = (new Date() < startingTime ? startingTime : endingTime);
            }
        );
        auctionCountdown.start();
    </script>

    <script>
        // Bid last updated countdown
        let bidCountdown = new CountdownClock(
            new Date(),
            function (t) {
                let s = `Last updated ${Math.floor(t/1000)} seconds ago`;
                document.querySelector('#bid-last-updated').innerHTML = s;
            }
        );
        bidCountdown.start();

        let periodicBidUpdateTimer = setInterval(() => Bid.updateSection(auctionId), 10000);
    </script>

    @include('templates.tpl_comment')
@endsection

@section('content')

<section class="sign-in-container">

    <div class="container bg-light rounded py-3 mb-5">

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb fs-5 ps-2 pt-1 pb-2">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
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
                                    <img src="{{ asset('assets/' . $images_path->path) }}" class="d-block w-100 img-cover" alt="bmw i8">
                                </div>
                            @else
                                <div class="carousel-item">
                                    {{-- TODO mini hack to resize imgs :/ --}}
                                    <img src="{{ asset('assets/' . $images_path->path) }}" class="d-block w-100 img-cover" alt="bmw i8">
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
                @if (!Auth::guest())
                        @if ($favourite)
                            <form method="post" action="{{ route('add_favourite', ['id' => $auction->id]) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="heart heart_favourite">
                        @else
                            <form method="post" action="{{ route('add_favourite', ['id' => $auction->id]) }}">
                            <button type="submit" class="heart">
                        @endif
                                <i class="fa fa-heart"></i>
                            </button>
                    <form>
                @endif
            </div>

            <!-- Vehicle Information 1 -->
            <div class="col-lg text-nowrap">
                
                <!-- General "name" -->
                <div class="row rounded-3 bg-dark text-white text-center my-2 text-wrap">

                    @if (!Auth::guest())
                        @if (Auth::user()->id == $owner->id)
                            <div class="col-10">
                                <h1>{{$vehicle->year}}' {{$vehicle->brand}} {{$vehicle->model}}</h1>
                            </div>
                            {{-- <div class="col d-flex justify-content-start align-items-center"> --}}
                            <div class="col-2 d-flex justify-content-start align-items-center">
                                <a class="" data-bs-toggle="collapse" href="#editAuctionCollapse" role="button" aria-expanded="false" aria-controls="editAuctionCollapse">
                                    <i class="fa fa-cog edit-cog" aria-hidden="true" style="color:white;"></i>
                                </a>

                            </div>
                            {{-- </div> --}}
                        @endif
                    @else
                        <h1>{{$vehicle->year}}' {{$vehicle->brand}} {{$vehicle->model}}</h1>
                    @endif
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
                        <div class="col fire-text">   <i class="fas fa-fire m-3"></i> {{Str::upper($vehicle->condition)}} </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates -->
        <div class="row text-white text-center align-items-center my-3 mx-auto">
            <div class="col-lg text-nowrap rounded-start bg-dark">
                <div class="row py-2 fs-4">
                    <div class="col">   Starting date:  </div>
                    <div id="start-date" class="col">   {{\Carbon\Carbon::parse($auction->startingtime)->format('Y-m-d @ H:i:s')}} UTC </div>
                </div>
            </div>

            <div class="col-lg text-nowrap rounded-end bg-dark">
                <div class="row py-2 fs-4">
                    <div class="col">   Closing date:   </div>
                    <div id="end-date" class="col">   {{\Carbon\Carbon::parse($auction->endingtime)->format('Y-m-d @ H:i:s')}} UTC </div>
                </div>
            </div>
        </div>


        <!-- Edit Auction Collapsable -->
        <div class="collapse" id="editAuctionCollapse">
            <form id="profile-general" method="post" action="{{'/auctions/' . $auction->id}}">
                @csrf
                <div class="row" style="--bs-gutter-x:0;">
                    <div class="col form-floating mb-3 align-self-start">
                        <input required type="text" name="brand" class="form-control" id="floatingInput" value="{{ old('brand', $vehicle->brand) }}">
                        <label for="floatingInput">Brand</label>
                    </div>

                    <div class="col form-floating mb-3 ">
                        <input required type="text" name="model" class="form-control" id="floatingInput" value="{{ old('model', $vehicle->model) }}">
                        <label for="floatingInput">Model</label>
                    </div>

                    <div class="col form-floating mb-3 year-input">
                        <input required type="number" name="year" class="form-control" id="floatingInput" value="{{ old('year', $vehicle->year) }}">
                        <label for="floatingInput">Year</label>
                    </div>
                </div>

                <div class="row" style="--bs-gutter-x:0;">
                    @if (\Carbon\Carbon::now()->lte($auction->startingtime))
                        <div class="col form-floating mb-3 align-self-start">
                            <select required class="form-select input_box" aria-label="condition" id="selectCondition" name="condition">
                                <option selected="false" value="Mint">Mint</option>
                                <option selected="false" value="Clean">Clean</option>
                                <option selected="false" value="Average">Average</option>
                                <option selected="false" value="Rough">Rough</option>
                            </select>
                            <label for="floatingInput">Condition</label>
                        </div>

                        <script>
                            // change the default selected option to the current one
                            let options = document.querySelectorAll('#selectCondition option');
                            let optionsArray = Array.prototype.slice.call(options);
                            
                            optionsArray.forEach(option => {
                                if (option.getAttribute('value') == '{{$vehicle->condition}}') {
                                    option.selected = true;
                                } else { option.selected = false; }
                            });
                        </script>
                    @else
                        <div class="col form-floating mb-3 year-input">
                            <input required type="text" name="condition" class="form-control" id="floatingInput" value="{{$vehicle->condition}}" readonly>
                            <label for="floatingInput">Condition</label>
                        </div>
                    @endif

                    <div class="col form-floating mb-3 horsepower-input">
                        <input required type="number" name="horsepower" class="form-control" id="floatingInput" value="{{ old('horsepower', $vehicle->horsepower) }}">
                        <label for="floatingInput">Horsepower</label>
                    </div>
                </div>
                <div class="row" style="--bs-gutter-x:0;">
                    <div class="col form-floating mb-3">
                        <input required type="date" name="startingdate" class="form-control input_box" id="floatingInput" value="{{ old('startingdate', \Carbon\Carbon::parse($auction->startingtime)->setTimezone('Europe/London')->format('Y-m-d')) }}">
                        <label for="floatingInput">Starting Date</label>
                    </div>
                    <div class="col form-floating mb-3">
                        <input required type="time" name="startingtime" class="form-control input_box" id="floatingInput" value="{{ old('startingtime', \Carbon\Carbon::parse($auction->startingtime)->setTimezone('Europe/London')->format('H:i:s')) }}">
                        <label for="floatingInput">Starting Time</label>
                    </div>

                    <div class="col form-floating mb-3">
                        <input required type="date" name="endingdate" class="form-control" id="floatingInput" value="{{ old('endingdate', \Carbon\Carbon::parse($auction->endingtime)->setTimezone('Europe/London')->format('Y-m-d')) }}">
                        <label for="floatingInput">Closing Date</label>
                    </div>
                    <div class="col form-floating mb-3">
                        <input required type="time" name="endingtime" class="form-control input_box" id="floatingInput" value="{{ old('endingtime', \Carbon\Carbon::parse($auction->endingtime)->setTimezone('Europe/London')->format('H:i:s')) }}">
                        <label for="floatingInput">Closing Time</label>
                    </div>
                </div>

                <script>
                    // car related elements
                    let brandElement = document.querySelector('input[name="brand"]');
                    let modelElement = document.querySelector('input[name="model"]');
                    let yearElement = document.querySelector('input[name="year"]');
                    let horsepowerElement = document.querySelector('input[name="horsepower"]');
                    
                    // date related elements
                    let startingDateElement = document.querySelector('input[name="startingdate"]');
                    let startingTimeElement = document.querySelector('input[name="startingtime"]');
                    let endingDateElement = document.querySelector('input[name="endingdate"]');
                    let endingTimeElement = document.querySelector('input[name="endingtime"]');

                    // auction already started
                    if (new Date() > startingTime) {
                        
                        brandElement.readOnly = true;
                        modelElement.readOnly = true;
                        yearElement.readOnly = true;
                        horsepowerElement.readOnly = true;

                        startingDateElement.readOnly = true;
                        startingTimeElement.readOnly = true;
                        endingDateElement.readOnly = true;
                        endingTimeElement.readOnly = true;

                    } else {
                        brandElement.readOnly = false;
                        modelElement.readOnly = false;
                        yearElement.readOnly = false;
                        horsepowerElement.readOnly = false;

                        startingDateElement.readOnly = false;
                        startingTimeElement.readOnly = false;
                        endingDateElement.readOnly = false;
                        endingTimeElement.readOnly = false;
                    }
                </script>

                @if (\Carbon\Carbon::now() < $auction->startingtime)
                    <div class="row" style="--bs-gutter-x:0;">
                        
                        <div class="col modal-footer justify-content-center login-button px-5 pt-3 rounded-pill"> 
                            <button type="submit" id="save-general" class="btn m-3 mt-0 float-end rounded-pill w-75 fw-bold">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                @else
                    <div class="row" style="--bs-gutter-x:0;">
                            
                        <div class="col modal-footer justify-content-center login-button px-5 pt-0 pb-4 rounded-pill fw-bold"> 
                                {{ __('No Changes Allowed') }}
                        </div>
                    </div>
                @endif
            </form>

        </div>

        <!-- Start of bordered box -->
        <div class="rounded-3 border border-2 border-dark">

            <!-- Current Bid info -->
            <div class="row mt-5 mb-4 mx-auto">
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
                    <div id="bid-container" class="p-1">
                        <div class="text-center">Current Bid</div>
                        @if (isset($max_bid))
                            <div id="max-bid" class="text-center fs-1 flash-bid">{{$max_bid}}€</div>  
                        @else
                            <div class="text-center fs-1">No bids</div>  
                        @endif

                        <div id="bid-last-updated" class="text-center fs-6 text-secondary pb-1">Last updated 0 seconds ago</div>
                    </div>
                    
                    <!-- Place Bid -->
                    @if (!Auth::guest() and (\Carbon\Carbon::now() < $auction->endingtime) and (\Carbon\Carbon::now() >= $auction->startingtime))
                        <div class="row text-center d-flex justify-content-center mt-2">
                            <form class="row justify-content-center" onsubmit="Bid.submit(this, auctionId).then(() => Bid.updateSection(auctionId)); return false;">
                                @csrf
                                <div class="col bid-input input-group mb-2 p-0">
 
                                    <span class="input-group-text" onclick="this.parentNode.querySelector('[type=number]').stepDown(5000);" style="cursor:pointer;">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </span>
                                    
                                    @if (isset($max_bid))
                                        <input type="number" class="form-control text-center" id="bid_input" aria-label="Amount (to the nearest dollar)" min="{{$max_bid + 1}}" max="100000000" step="0.01" value="{{$max_bid + 1}}" name="amount">
                                    @else
                                        <input type="number" class="form-control text-center" id="bid_input" aria-label="Amount (to the nearest dollar)" min="{{$auction->startingbid}}" max="100000000" step="0.01" value="{{$auction->startingbid}}" name="amount">
                                    @endif

                                    <span class="input-group-text" onclick="this.parentNode.querySelector('[type=number]').stepUp(5000);"  style="cursor:pointer;">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </span>
                                    
                                </div>

                                <button type="submit" class="btn rounded-pill" id="bid_button"><h4 class="m-0 p-2">Place Bid</h4></button>
                            
                            </form>
                        </div>
                    @endif
                </div>

                <div class="col fs-3">
                    <div class="text-center">Top Bidder</div>
                    <div class="text-center">
                        @if (isset($highest_bidder))
                            <a id="max-bidder-anchor" href="{{ url('/users/' . $highest_bidder->id) }}" class="profile_text">
                                <img id="max-bidder-img" src="{{ asset('assets/' . $bidder_img->path) }}" class="rounded-circle profile_picture" alt="Hank Geller"> 
                                <h4 id="max-bidder-username" class="">{{$highest_bidder->username}}</h4>
                            </a>
                        @else
                            <a href="" class="profile_text">
                                <img src="{{ asset('assets/generic_profile.png') }}" class="rounded-circle profile_picture" alt="Hank Geller"> 
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Countdown -->
            <div class="container mt-5" id="auction_content_area">
                <div class="row d-flex flex-row justify-content-around align-items-center text-center">
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

                <h4 class="center-block mt-3 pb-5 auction-status text-center">
                    @if (\Carbon\Carbon::now() > $auction->endingtime)
                        AUCTION HAS ENDED
                        @else UNTIL AUCTION 
                            @if ($auction->startingtime > \Carbon\Carbon::now()) BEGINS
                            @else ENDS
                        @endif
                    @endif
                </h4>
                
            </div>

        <!-- End of bordered box -->
        </div>

    <!-- End of White Box -->
    </div>

    
    <!-- Comment Section -->
    <div class="display-1 text-center" style="margin-bottom: 0.5em;">Comment Section</div>
    <div class="around-container container bg-light rounded mb-5">

        <div class="container-fluid p-0 rounded-3 border border-2 border-dark bg-light" id="comment_section">
        
            @if (!Auth::guest())
                <!-- Place Comment -->
                <div class="comment pb-2 clearfix rounded-3 border border-2">
                    <form onsubmit="Comment.submit(this, auctionId).then(() => Comment.updateSection(auctionId)); return false;">
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

        </div>
        
        <!-- Chat Button -->
        <!--<a href="#" class="chat_button">
            <i class="fa fa-comments chat_icon"></i>
        </a>-->
    
    <!-- End of White Box -->
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
