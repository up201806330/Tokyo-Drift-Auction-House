<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\VehicleImage;
use App\Models\Image;
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

        // return $images_paths;
        
        // return $images_infos;
        // return $images_infos[1]->image_id;

        return view('pages.auction', ['auction' => $auction, 'vehicle' => $vehicle, 'images_paths' => $images_paths]);
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
