<!-- Card -->
<div class="col mb-3 card-container">
    <div class="card">
        
        <img src="{{ asset('assets/' . $vehicle_imgs[0]->path) }}" alt="..." class="cover car-img-thumbnail">

        <!-- Card Body -->
        <div class="card-body">
            <h4 class="card-title text-center text-nowrap">{{$brand}} {{$model}}</h4>
                <div class="card-body-info">
                    <p class="card-text time-remaining-text">
                        <i class="fa fa-clock-o clock"></i>
                        <span class="hour">{{ $time_diff }}</span>
                    </p>
                    <p class="card-text current-value">
                    <i class="fa fa-money money"></i>
                        <span class="card-price">Currently at {{$max_bid->amount}}€</span>
                    </p>
                    <a href="{{ url('/auctions/' . $id) }}" class="stretched-link"></a> <!-- Card as a link -->
            </div>
        </div>
        <!-- End of Card Body -->
    </div>
</div>
<!-- End of Card -->