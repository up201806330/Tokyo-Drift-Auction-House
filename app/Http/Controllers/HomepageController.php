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
        $auctionsForHomepage = $this->getRandomAuctions(3);

        return view('pages.homepage', ['auctions' => $auctionsForHomepage]);
    }

    public function getRandomAuctions($nAuctions) : Collection {
        return Auction::inRandomOrder()->limit($nAuctions)->get();
    }

}
