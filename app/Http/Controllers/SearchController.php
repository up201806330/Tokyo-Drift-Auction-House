<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Auction;
use App\Models\Vehicle;
use App\Models\Comment;
use App\Models\Bid;
use App\Models\Image;
use App\Models\VehicleImage;
use App\Models\User;
use App\Models\AuctionGuest;
use App\Models\Favourite;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use \Carbon\Carbon;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : void
    {

    }

    /**
     * Display all Auctions.
     *
     * @return \Illuminate\Http\View
     */
    public function showAll() : View {

        $all_auctions = Auction::all();

        $rangeLimits = SearchController::horsepowerYearLimits();

        return view('pages.search', [
            'auctions_to_display' => $all_auctions,
            'range_limits' => $rangeLimits
        ]);
    }

    public static function horsepowerYearLimits() {
        $lowerHP = Vehicle::min('horsepower');
        $upperHP = Vehicle::max('horsepower');

        $lowerY = Vehicle::min('year');
        $upperY = Vehicle::max('year');

        return [$lowerHP, $upperHP, $lowerY, $upperY];
    }

    public function fromHomepageShowFiltered(Request $request, Array $rangeLimits) {

        $validator = Validator::make($request->all(), [
            'homepageSearch' => 'nullable|max:50',
        ]);
        if( $validator->fails() ) {
            return redirect()->back()->withErrors($validator);
         }
        
        $homepageSearch = $request->homepageSearch;

        $auctions_to_display =  Auction::when(true, function($query) {
                                    return $query->where('auction.endingtime', '>', \Carbon\Carbon::now()->toDateString());
                                })
                                ->whereIn('id',
                                    Auction::when($homepageSearch, function($query) use ($homepageSearch) {
                                        return $query->join('vehicle', 'vehicle.id', '=', 'auction.vehicle_id')->whereRaw("plainto_tsquery(?) @@ to_tsvector(auction_name || ' ' || brand || ' ' || model)", [$homepageSearch]);
                                    })
                                    ->get()->map->only(['id'])
                                )
                                ->get();

        return view('pages.search', [
            'auctions_to_display' => $auctions_to_display,
            'range_limits' => $rangeLimits
        ]);
    }


    public function showFiltered(Request $request) {
        $rangeLimits = SearchController::horsepowerYearLimits();

            if (!is_null($request->homepageIdentifier)) {
                return SearchController::fromHomepageShowFiltered($request, $rangeLimits);
            }
        
        try {
            $validator = Validator::make($request->all(),
            [
                'textBoxSearch' => 'nullable|max:50',
                'condition'     => 'nullable|in:Mint,Clean,Average,Rough,All',
                'multiRangeHorsepowerMax'=> 'required|numeric',
                'multiRangeHorsepowerMin'=> 'required|numeric',
                'multiRangeYearMax'      => 'required|numeric',
                'multiRangeYearMin'      => 'required|numeric',
                'switchFinalizedAuctions'=> 'nullable|in:on',
            ]);
            if( $validator->fails() ) {
                return redirect()->back()->withErrors($validator);
            }

            $condition = ($request->condition == "All") ? null : $request->condition;
            $textBoxSearch = $request->textBoxSearch;
            $model = $request->model;
            $not_finalized = $request->switchFinalizedAuctions ? null : true;

            // Alternative query (only 1 instead of 2 queries)
            $auctions_to_display = Auction::whereIn('vehicle_id',
                                        Vehicle::when($condition, function($query) use ($condition) {
                                                return $query->where('condition', $condition);
                                            })
                                            ->where('horsepower', '<=', $request->multiRangeHorsepowerMax)
                                            ->where('horsepower', '>=', $request->multiRangeHorsepowerMin)
                                            ->where('year', '<=', $request->multiRangeYearMax)
                                            ->where('year', '>=', $request->multiRangeYearMin)
                                        ->get()->map->only(['id'])
                                    )
                                    ->when($not_finalized, function($query) {
                                        return $query->where('auction.endingtime', '>', \Carbon\Carbon::now()->toDateString());
                                    })
                                    ->whereIn('id',
                                        Auction::when($textBoxSearch, function($query) use ($textBoxSearch) {
                                            return $query->join('vehicle', 'vehicle.id', '=', 'auction.vehicle_id')->whereRaw("plainto_tsquery(?) @@ to_tsvector(auction_name || ' ' || brand || ' ' || model)", [$textBoxSearch]);
                                        }
                                    )
                                    ->get()->map->only(['id'])
                                    )
                                    ->get();

        } catch (Exception $e) {
            return view('pages.search', ['auctions_to_display' => [], 'range_limits' => $rangeLimits]);
        }

        return view('pages.search', [
            'auctions_to_display' => $auctions_to_display,
            'range_limits' => $rangeLimits
        ]);
    }

}
