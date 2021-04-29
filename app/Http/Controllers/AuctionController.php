<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\VehicleImage;
use App\Models\Image;
use App\Models\User;
use App\Models\Bid;
use DB;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        // gets images array of provided vehicle_id
        $images_infos = VehicleImage::where('vehicle_id', $vehicle->id)->get();

        // foreach ($images_infos as $img) {
        //     echo $img->image_id;
        // }

        $images_paths = DB::table('image')
                        ->join('vehicle_image', 'vehicle_image.image_id', '=', 'image.id')
                        ->join('vehicle', 'vehicle.id', '=', 'vehicle_image.vehicle_id')
                        ->select('vehicle.id', 'vehicle_image.sequence_number', 'image.path')
                        ->where('vehicle.id', '=', $vehicle->id)
                        ->get();

        // $current_max_bid_amount = DB::table('bid')
        //                 ->join('auction', 'auction.id', '=', 'bid.auction_id')
        //                 ->select('auction.id', 'bid.user_id', 'bid.amount')
        //                 ->where('auction.id', '=', $auction->id)
        //                 ->max('bid.amount');

        $owner = User::find($vehicle->owner);

        $owner_profile_img = Image::find($owner->profileimage);

        $current_max_bid_amount = Bid::where('auction_id',  '=', $id)->max('amount');

        $current_max_bid = Bid::where([
            ['amount',      '=', $current_max_bid_amount],
            ['auction_id',  '=', $id],
        ])->firstOrFail();

        $highest_bidder = User::find($current_max_bid->user_id);

        $highest_bidder_profile_img = Image::find($highest_bidder->profileimage);

        return view('pages.auction', [
            'auction'       => $auction,
            'vehicle'       => $vehicle,
            'images_paths'  => $images_paths,
            'max_bid'       => $current_max_bid_amount,
            'owner'         => $owner,
            'owner_img'     => $owner_profile_img,
            'highest_bidder'=> $highest_bidder,
            'bidder_img'    => $highest_bidder_profile_img
        ]);
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
