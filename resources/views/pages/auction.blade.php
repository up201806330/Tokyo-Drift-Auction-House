@extends('layouts.app')

@section('head')
    <script src="{{ asset('js/comments.js')}}"></script>
@endsection

@section('content')

<div class="auction_background">
    <!-- Top Bar with car details -->
    <div class="container-fluid car-details">
      
    <div class="display-3 text-white text-start ps-1">
        Auction {{ $auction->id }}
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb fs-5 ps-2 pt-1 pb-2">
            <li class="breadcrumb-item"><a href="../pages/homepage.php">Home</a></li>
            <li class="breadcrumb-item"><a href="../pages/search.php">Search</a></li>
            <li class="breadcrumb-item active" aria-current="page">Auction {{ $vehicle->id }}</li>
        </ol>
    </nav>

    <div class="row align-items-center text-center">

        <!-- Pictures Carrousel -->
        <div class="col-12 col-lg-6 mb-5 ms-1 ms-md-4 d-flex justify-content-center justify-content-lg-start" id="under_heart">
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
                                <img style="width:640px;height:360px;" src="{{ asset('assets/' . $images_path->path) }}" class="d-block w-100" alt="bmw i8">
                            </div>
                        @else
                            <div class="carousel-item">
                                {{-- TODO mini hack to resize imgs :/ --}}
                                <img style="width:640px;height:360px;" src="{{ asset('assets/' . $images_path->path) }}" class="d-block w-100" alt="bmw i8">
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

        <!-- Car Info -->
        <div class="col-lg text-nowrap">
            <h1>{{$vehicle->year}}' {{$vehicle->brand}} {{$vehicle->model}}</h1>
                <div class="row align-items-center m-3">
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
                </div>
            <div class="row align-items-center m-3 text-center">
                <div class="col">
                    <p>Started at:</p>
                    <h6>{{\Carbon\Carbon::parse($auction->startingtime)->format('H:i:s')}}</h6>
                    <h6>{{\Carbon\Carbon::parse($auction->startingtime)->format('Y-m-d')}}</h6>
                </div>
                <div class="col">
                    <p>Ends at:</p>
                    <h6>{{\Carbon\Carbon::parse($auction->endingTime)->format('H:i:s')}}</h6>
                    <h6>{{\Carbon\Carbon::parse($auction->endingTime)->format('Y-m-d')}}</h6>
                </div>
            </div>
        </div>
    </div>
      
</div>
  
<div class="auction_content rounded-3 border border-2 border-dark bg-white">
    <!-- Current Bid info -->
    <div class="container" id="auction_content_area">
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
                <h1 class="current_bid">{{$max_bid}}</h1>
            </div>
            <div class="col-12 col-md-4 mt-3 mb-3">
                <h2 class="text-nowrap">Top Bidder</h2>
                <a href="{{ url('/users/' . $highest_bidder->id) }}" class="profile_text">
                    <img src="{{ asset('assets/' . $bidder_img->path) }}" class="rounded-circle profile_picture mt-3" alt="Hank Geller"> 
                    <h4 class="m-0">{{$highest_bidder->username}}</h4>
                </a>
            </div>
        </div>
    </div>

    <!-- Place Bid -->
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

    <!-- Countdown -->
    <div class="container mt-5" id="auction_content_area">
        <div class="row d-flex flex-row justify-content-around align-items-center">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6 countdown_box">
                        <h1 class="display-1 m-0">4</h1>
                        <h4>Days</h4>
                    </div>
                    <div class="col-6 countdown_box">
                        <h1  class="display-1 m-0">14</h1>
                        <h4>Hours</h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6 countdown_box">
                        <h1  class="display-1 m-0">35</h1>
                        <h4>Minutes</h4>
                    </div>
                    <div class="col-6 countdown_box">
                        <h1  class="display-1 m-0">23</h1>
                        <h4>Seconds</h4>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="d-flex justify-content-between mt-3 pb-5">
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
            <span>B</span>
            <span>E</span>
            <span>G</span>
            <span>I</span>
            <span>N</span>
            <span>S</span>
            <span> </span>
        </h4>
    </div>

</div>

<!-- Comment Section -->
<div class="display-1" style="margin-left: 15%;">Comment Section</div>
    <div class="container-fluid p-0 rounded-3 border border-2 border-dark bg-light" id="comment_section">
      
    @if (!Auth::guest())
        <!-- Place Comment -->
        <div class="comment pb-2 clearfix rounded-3 border border-2">
            <form onsubmit="Comment.submit(this, '{{$auction->id}}'); return false;">
            @csrf
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

    @foreach($comments as $comment)

    @include('partials.comment', array(
        'auction_id'=> $auction->id,
        'comment_id'=> $comment->id,
        'username'  => $comment->username,
        'datetime'  => $comment->createdon,
        'user_id'   => $comment->user_id,
        'content'   => $comment->content
    ))

    {{-- <div class="not_moderator">
        @include('partials.comment')
    </div> --}}

    @endforeach

  <!-- Chat Button -->
  <a href="#" class="chat_button">
      <i class="fa fa-comments chat_icon"></i>
  </a>
</div>

@endsection
