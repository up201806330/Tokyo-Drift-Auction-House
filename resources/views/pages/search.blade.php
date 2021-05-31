@extends('layouts.app')

@section('title', "Search")

@section('head')
@endsection

@section('content')

<div class="container-fluid" id="search-background">
<div class="row h-100" style="display: flex">


<a class="btn toggleSidebar text-white border-top-1 rounded-0" data-bs-toggle="collapse" href="#sidebarMenu" role="button" aria-expanded="true" aria-controls="collapseExample">
    Filter Results
</a>

<!-- Sidebar -->
<nav id="sidebarMenu" class="col-12 col-sm-12 col-md-12 col-lg-3 border-end border-secondary collapse show text-white">
    <div class="position-sticky py-3">
        <form id="search-general" method="post" action="{{ route('search') }}">
            @csrf
            <ul class="nav flex-column">
                <li class="nav-item pt-3">
                    <div class="display-6">
                    Filter results
                    </div class="display-6">
                </li>

                <li class="nav-item pt-3">
                    {{-- <label class="form-slider-label" for="brand_search">Find Auction</label> --}}
                    <div class="input-group form-container">
                        <input type="text" name="textBoxSearch" class="form-control search-input fs-5" placeholder="Brand, Model, Auction Name..." autocomplete="off" id="brand_search">
                    </div>
                </li>

                <li class="nav-item pt-5">
                    <select required class="col mx-auto text-center form-select fs-5" style="cursor: pointer;" aria-label="condition" id="selectCondition" name="condition">
                        <option selected disabled>Condition</option>
                        <option value="Mint">Mint</option>
                        <option value="Clean">Clean</option>
                        <option value="Average">Average</option>
                        <option value="Rough">Rough</option>
                        <option value="All">Any</option>
                    </select>
                </li>
                
                <li class="nav-item pt-5">
                    <label class="form-slider-label fs-4" for="multiRangeHorsepower">Horsepower (HP)</label>
                    <?php draw_multi_range_slider("multiRangeHorsepower", $range_limits[0], $range_limits[1]); ?>
                </li>
                
                <li class="nav-item pt-4">
                    <label class="form-slider-label fs-4" for="multiRangeYear">Year of manufacture</label>
                    <?php draw_multi_range_slider("multiRangeYear", $range_limits[2], $range_limits[3]); ?>
                </li>
                
                <li class="nav-item pt-4 ms-2">
                    <div class="form-check form-switch pt-2">
                        <input class="form-check-input" type="checkbox" id="switchFinalizedAuctions" name="switchFinalizedAuctions" value="on">
                        <label class="form-check-label ps-2" for="switchFinalizedAuctions">Show Finalized Auctions</label>
                    </div>
                </li>

                <li class="d-flex align-self-center mt-3 mb-2">
                    <button class="btn float-end clearfix rounded-pill" type="submit" id="submit_button"><b>SEARCH</b></button>
                </li>

            </ul>
        </form>
        
    </div>
</nav>

<!-- Search Results -->
<main class="col ms-sm-auto pt-4 px-md-4" style="flex: 1">
    <p class="fs-3 pt-3">{{count($auctions_to_display)}} Results Found</p>
    <div class="row row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 d-flex justify-content-start">

    @foreach ($auctions_to_display as $auction)
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

</div></div>
@endsection


<!-- Adapted from https://codepen.io/glitchworker/pen/XVdKqj -->
<?php function draw_multi_range_slider($id, $min, $max) { ?>

    <div slider id="<?=$id?>">
      <div>
        <div inverse-left style="width:70%;"></div>
        <div inverse-right style="width:70%;"></div>
        <div range style="left:0%;right:0%;"></div>
        <span thumb style="left:0%;"></span>
        <span thumb style="left:100%;"></span>
        <div sign style="left:0%;">
          <span id="value">{{round(($max - $min) * 0 + $min)}}</span>
        </div>
        <div sign style="left:100%;">
          <span id="value">{{round(($max - $min) * 1.0 + $min)}}</span>
        </div>
      </div>
      <input type="range" style="z-index:99;" name="<?=$id?>Min" tabindex="0" value="{{round(($max - $min) * 0.0 + $min)}}" max="<?=$max?>" min="<?=$min?>" step="1" oninput="
      this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
      var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
      var children = this.parentNode.childNodes[1].childNodes;
      children[1].style.width=value+'%';
      children[5].style.left=value+'%';
      children[7].style.left=value+'%';children[11].style.left=value+'%';
      children[11].childNodes[1].innerHTML=this.value;" />
    
      <input type="range" style="z-index:99;" name="<?=$id?>Max" tabindex="0" value="{{round(($max - $min) * 1.0 + $min)}}" max="<?=$max?>" min="<?=$min?>" step="1" oninput="
      this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
      var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
      var children = this.parentNode.childNodes[1].childNodes;
      children[3].style.width=(100-value)+'%';
      children[5].style.right=(100-value)+'%';
      children[9].style.left=value+'%';children[13].style.left=value+'%';
      children[13].childNodes[1].innerHTML=this.value;" />
    </div>
    
    <?php } ?>