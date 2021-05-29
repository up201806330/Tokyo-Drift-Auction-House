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


    public function showFiltered(Request $request) {
        // dd($request->sportsCategory);
        if (is_null($request->condition)) $request->condition = 'All';

        // TODO "Full Text Search"

        // TODO categories not being stored in db :/
        $categories_array = array();
        if ($request->sportsCategory    == 'on') array_push($categories_array, 'sport');
        if ($request->antiquesCategory  == 'on') array_push($categories_array, 'antique');
        if ($request->familyCategory    == 'on') array_push($categories_array, 'family');


        $rangeLimits = SearchController::horsepowerYearLimits();

        try {
            if ($request->condition == 'All') {

                $auctions_to_display = Auction::whereIn('vehicle_id',
                                             Vehicle::where('horsepower', '<=', $request->multiRangeHorsepowerMax)
                                                    ->where('horsepower', '>=', $request->multiRangeHorsepowerMin)
                                                    ->where('year', '<=', $request->multiRangeYearMax)
                                                    ->where('year', '>=', $request->multiRangeYearMin)
                                            ->get()->map->only(['id'])
                                        )
                                        ->get();
            }
            else {
                $auctions_to_display =  Auction::whereIn('vehicle_id', 
                                             Vehicle::where('condition', $request->condition)
                                                    ->where('horsepower', '<=', $request->multiRangeHorsepowerMax)
                                                    ->where('horsepower', '>=', $request->multiRangeHorsepowerMin)
                                                    ->where('year', '<=', $request->multiRangeYearMax)
                                                    ->where('year', '>=', $request->multiRangeYearMin)
                                                    ->get()->map->only(['id'])
                                        )
                                        ->get();
            }
        } catch (Exception $e) {
            return view('pages.search', ['auctions_to_display' => [], 'range_limits' => $rangeLimits]);
        }

        return view('pages.search', [
            'auctions_to_display' => $auctions_to_display,
            'range_limits' => $rangeLimits
        ]);
    }

}
