<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class HomepageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show() : View
    {
        $conditions = array('Mint', 'Clean', 'Average', 'Rough');
        $rand_index = array_rand($conditions, 1);
        $condition_name = $conditions[$rand_index];

        $fireDealsAuctionsForHomepage = $this->getRandomInProgressAuctions(4);
        $featuredConditionAuctionsForHomepage = $this->getRandomConditionAuctions(4, $condition_name);
        $pastAuctionsForHomepage = $this->getRandomPastAuctions(4);

        return view('pages.homepage', [
            'fire_deals' => $fireDealsAuctionsForHomepage,
            'featured_condition' => $featuredConditionAuctionsForHomepage,
            'condition_name' => $condition_name,
            'past_auctions' => $pastAuctionsForHomepage
            ]);
    }

    public function getRandomInProgressAuctions($nAuctions) : Collection {
        return Auction::inRandomOrder()->limit($nAuctions)->where('auction.endingtime', '>', \Carbon\Carbon::now()->toDateString())->where('auction.startingtime', '<', \Carbon\Carbon::now()->toDateString())->get();
    }

    public function getRandomConditionAuctions($nAuctions, $condition) : Collection {
        return Auction::inRandomOrder()->limit($nAuctions)
            ->where('endingtime', '>', \Carbon\Carbon::now()->toDateString())
            ->whereIn('vehicle_id',
                Vehicle::when($condition, function($query) use ($condition) {
                    return $query->where('condition', $condition);
                })->get()->map->only(['id'])
            )
            ->get();
    }

    public function getRandomPastAuctions($nAuctions) : Collection {
        return Auction::inRandomOrder()->limit($nAuctions)->where('auction.endingtime', '<', \Carbon\Carbon::now()->toDateString())->get();
    }

}
