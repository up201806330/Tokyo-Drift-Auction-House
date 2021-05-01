<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleImage;
use App\Models\Auction;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Bid;
use DB;

class HomepageController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $auctionsForHomepage = $this->getRandomAuctions(3);

        return view('pages.homepage', ['auctions' => $auctionsForHomepage]);
    }

    public function getRandomAuctions($nAuctions) {
        return Auction::inRandomOrder()->limit($nAuctions)->get();
    }

}
