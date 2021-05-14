<?php

namespace App\Http\Controllers;

use Exception;
use Auth;
use Illuminate\Http\Request;
use App\Models\VehicleImage;
use App\Models\Auction;
use App\Models\Vehicle;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Bid;
use DB;

use Carbon\Carbon;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateForm()
    {
        if (Auth::guest()) {
            // TODO -> em vez de redirecionar, aparecer overlay
            return redirect('/login');
        }
        return view('pages.create_auction');
    }

    /**
   * Creates a new auction.
   *
   * @param  Request request containing the description
   * @return Response
   */
    public function create(Request $request)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $vehicle = new Vehicle([
            'id' => Vehicle::all()->max('id') + 1,
            'owner' => Auth::id(),
            'brand' => $request->get('brand'),
            'model' => $request->get('model'),
            'condition' => $request->get('condition'),
            'year' => $request->get('year'),
            'horsepower' => $request->get('horsepower'),
        ]);

        $vehicle->save();

        $auction = new Auction;

        $auction->id = Auction::all()->max('id') + 1;        
        $auction->auction_name = $request->get('auction_name');
        $auction->vehicle_id = $vehicle->id;
        $auction->startingBid = $request->get('startingBid');
        $auction->startingTime = $request->get('startingTime');
        $auction->endingTime = $request->get('endingTime');
        $auction->auctionType = $request->get('auctionType');

        $auction->save();

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auction = Auction::find($id);
        $vehicle = $auction->vehicle;

        $images_paths = $auction->getVehicleFromAuction();

        // $images_paths = DB::table('image')
        // ->join('vehicle_image', 'vehicle_image.image_id', '=', 'image.id')
        // ->join('vehicle', 'vehicle.id', '=', 'vehicle_image.vehicle_id')
        // ->select('vehicle.id', 'vehicle_image.sequence_number', 'image.path')
        // ->where('vehicle.id', '=', $vehicle->id)
        // ->get();

        // $current_max_bid_amount = DB::table('bid')
        //                 ->join('auction', 'auction.id', '=', 'bid.auction_id')
        //                 ->select('auction.id', 'bid.user_id', 'bid.amount')
        //                 ->where('auction.id', '=', $auction->id)
        //                 ->max('bid.amount');

        $owner = User::find($vehicle->owner);
        $owner_profile_img = Image::find($owner->profileimage);
        $auction_comments = $auction->getComments();

        try {
            $current_max_bid_amount = Bid::where('auction_id', '=', $id)->max('amount');

            $current_max_bid = $auction->getCurrentMaxBid();

            $highest_bidder = $auction->getCurrentMaxBidder();

            $highest_bidder_profile_img = Image::find($highest_bidder->profileimage);

            
        }
        catch (Exception $e) {
            return view('pages.auction', [
                'auction'       => $auction,
                'vehicle'       => $vehicle,
                'images_paths'  => $images_paths,
                'max_bid'       => null,
                'owner'         => $owner,
                'owner_img'     => $owner_profile_img,
                'highest_bidder'=> null,
                'bidder_img'    => null,
                'comments'      => $auction_comments
            ]);
        }
        
        return view('pages.auction', [
            'auction'       => $auction,
            'vehicle'       => $vehicle,
            'images_paths'  => $images_paths,
            'max_bid'       => $current_max_bid_amount,
            'owner'         => $owner,
            'owner_img'     => $owner_profile_img,
            'highest_bidder'=> $highest_bidder,
            'bidder_img'    => $highest_bidder_profile_img,
            'comments'      => $auction_comments
        ]);
    }

    public function bid(Request $request, $auction_id) {
        $bid = new Bid;

        $bid->id = Bid::all()->max('id') + 1;
        $bid->user_id = Auth::id();
        $bid->auction_id = $auction_id;
        $bid->amount = $request->get('amount');

        $bid->save();

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
