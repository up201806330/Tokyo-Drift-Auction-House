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
        // TODO "Full Text Search" ?
        // if (is_null($request->brand)) $request->brand = '/w*';
        // if (is_null($request->model)) $request->model = '/w*';

        // dd(Vehicle::where('brand', 'regexp', '/[A-Z]')->get());
        // dd($request->brand);

        $condition = $request->condition;
        $brand = $request->brand;
        $model = $request->model;
        $not_finalized = $request->switchFinalizedAuctions ? null : true;

        // TODO categories not being stored in db :/
        $categories_array = array();
        if ($request->sportsCategory    == 'on') array_push($categories_array, 'sport');
        if ($request->antiquesCategory  == 'on') array_push($categories_array, 'antique');
        if ($request->familyCategory    == 'on') array_push($categories_array, 'family');


        $rangeLimits = SearchController::horsepowerYearLimits();


        $auctions_to_display = Auction::join('vehicle', 'vehicle.id', '=', 'auction.vehicle_id')->whereRaw("plainto_tsquery(?) @@ to_tsvector(auction_name || ' ' || brand || ' ' || model)", [$brand])->get();
        // dd($stuff->get());

        // $stuff = Vehicle::selectRaw(' "vehicle", to_tsquery($brand) AS query, to_tsvector(', [$brand])

        // $results = DB::table("'auction', to_tsquery where_subquery_group_1_ as query, to_tsvector where_subquery_group_2_ as textsearch")
        // ->where("query", "@@", textsearch\\)
        // ->orderBy("rank","desc")
        // ->get();

        try {
            $auctions_to_display_ = Auction::whereIn('vehicle_id',
                                        Vehicle::selectRaw('brand @@ to_tsquery(\'english\', ?)', [$brand])

                                            // when($condition, function($query) use ($condition) {
                                            //     return $query->where('condition', $condition);
                                            // })
                                            // ->where('horsepower', '<=', $request->multiRangeHorsepowerMax)
                                            // ->where('horsepower', '>=', $request->multiRangeHorsepowerMin)
                                            // ->where('year', '<=', $request->multiRangeYearMax)
                                            // ->where('year', '>=', $request->multiRangeYearMin)
                                            // ->when($brand, function($query) use ($brand) {
                                            //     return $query->where('brand', $brand);
                                            // })
                                            // ->when($model, function($query) use ($model) {
                                            //     return $query->where('model', $model);
                                            // })
                                        ->get()->map->only(['id'])
                                    )
                                    ->when($not_finalized, function($query) {
                                        return $query->where('auction.endingtime', '>', \Carbon\Carbon::now()->toDateString());
                                    })
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
