<?php

namespace App\Http\Controllers;

use App\Models\Auction;
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
        $categories = array('Sports', 'Antique', 'Family');
        $rand_index = array_rand($categories, 1);
        $category_name = $categories[$rand_index];

        $fireDealsAuctionsForHomepage = $this->getRandomInProgressAuctions(3);
        $featuredCategAuctionsForHomepage = $this->getRandomCatAuctions(3);

        return view('pages.homepage', [
            'fire_deals' => $fireDealsAuctionsForHomepage,
            'featured_categ' => $featuredCategAuctionsForHomepage,
            'category_name' => $category_name
            ]);
    }

    public function getRandomInProgressAuctions($nAuctions) : Collection {
        return Auction::inRandomOrder()->limit($nAuctions)->where('auction.endingtime', '>', \Carbon\Carbon::now()->toDateString())->where('auction.startingtime', '<', \Carbon\Carbon::now()->toDateString())->get();
    }

    public function getRandomCatAuctions($nAuctions) : Collection {
        return Auction::inRandomOrder()->limit($nAuctions)->where('auction.endingtime', '>', \Carbon\Carbon::now()->toDateString())->get();
    }

}
