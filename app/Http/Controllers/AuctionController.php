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
use App\Models\AuctionModerator;
use App\Models\Favourite;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use \Carbon\Carbon;

class AuctionController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateForm() : View
    {
        if (Auth::guest()) {
            return view('layouts.error');
        }

        $user = User::find(Auth::id());
        if (!$user->seller()->exists()){
            return view('layouts.error');
        }

        $all_users = User::all();
        $users=[];

        foreach($all_users as $user){
            $new_user = [
                'id' => $user->id,
                'username' => $user->username,
                'image_path' => $user->getImagePath(),
                'moderator' => $user->moderator(),
            ];
            array_push($users, $new_user);
        }

        return view('pages.create_auction', [
            'users' => $users,
        ]);
    }

    /**
   * Creates a new auction.
   *
   * @param  Request request containing the description
   * @return Response
   */
    public function create(Request $request)
    {
        //if user not authenticated, redirect him to homepage
        if (Auth::guest()) {
            return redirect('/');
        }

        $validator = Validator::make($request->all(),
            [
                'auctionName'   => 'required|max:50',
                'brand'         => 'required|max:50',
                'model'         => 'required|max:50',
                'year'          => 'required|numeric',
                'condition'     => 'required|in:Mint,Clean,Average,Rough',
                'horsepower'    => 'required|numeric',
            ]);
        if( $validator->fails() ) {
            return redirect()->back()->withErrors($validator);
        }

        // date / time validator
        $validator = Validator::make($request->all(), [
            'startingdate' => 'required|date',
            'endingdate'   => 'required|date|after:startingdate',
        ]);
        if( $validator->fails() ) { // Dates are the same or wrong; checking time
            $validator = Validator::make($request->all(), [
               'startingdate'    => 'required|date',
               'endingdate'      => 'required|date|date_equals:startingdate',
               'startingtime'    => 'required|date_format:H:i:s',
               'endingtime'    => 'required|date_format:H:i:s|after_or_equal:startingtime',
            ]);
            if( $validator->fails() ) {
               return redirect()->back()->withErrors(['End Date must be later than Start Date']);
            }
        }

        //create vehicle
        $vehicle = new Vehicle([
            'owner' => Auth::id(),
            'brand' => $request->get('brand'),
            'model' => $request->get('model'),
            'condition' => $request->get('condition'),
            'year' => $request->get('year'),
            'horsepower' => $request->get('horsepower'),
        ]);
        $vehicle->save();

        $start = new Carbon($request->startingdate . ' ' . $request->startingtime, 'Europe/London');
        $end = new Carbon($request->endingdate . ' ' . $request->endingtime, 'Europe/London');

        //create auction
        $auction = new Auction([   
            'auction_name' => $request->get('auctionName'),
            'vehicle_id' => $vehicle->id,
            'startingbid' => $request->get('startingBid'),
            'startingtime' => Carbon::parse($start->setTimezone('UTC'))->format('Y-m-d H:i:s'),
            'endingtime' => Carbon::parse($end->setTimezone('UTC'))->format('Y-m-d H:i:s'),
        ]);

        //private auction handling
        if ($request->get('private') == 'on'){
            $auction->auctiontype = 'Private';
            $auction->save();

            $invited_users = $request->get('invited');
            if ($invited_users){
                foreach($invited_users as $user){
                    $auction->guests()->attach($user);
                }
            }
        }
        $auction->save();

        //moderators handling
        $moderators = $request->get('moderator');
        if ($moderators){
            foreach($moderators as $user){
                $auction_moderator = new AuctionModerator([
                    'user_id' => $user,
                    'auction_id' => $auction->id,                
                ]);
                $auction_moderator->save();
            }
        }
        $auction_moderator = new AuctionModerator([
            'user_id' => Auth::id(),
            'auction_id' => $auction->id,                
        ]);
        $auction_moderator->save();

        //pictures
        $directory = base_path('public/assets/car_photos/' . $vehicle->id);
        Storage::makeDirectory($directory);
        $pictures = $request->file('picture');
        $num = 1;
        foreach($pictures as $picture){
            //save file in storage
            $fileNameExtension = $picture->extension();
            $fileName = $num . '.' . $fileNameExtension;
            $picture->move($directory, $fileName);
            
            //save image in db
            $image = new Image([
                'path' => 'car_photos/' . $vehicle->id . '/' . $fileName,
            ]);
            $image->save();

            $vehicle_image = new VehicleImage([
                'vehicle_id' => $vehicle->id,
                'image_id' => $image->id,
                'sequence_number' => $num,
            ]);
            $vehicle_image->save();

            $num++;
        }
        return redirect('/');
    }

     /**
     * Creates a new auction.
     *
     * @param  Request request containing the description
     * @return Response
     */
    public function addFavourite(Request $request)
    {
        $auction_id = $request->route('id');
        //if user not authenticated, redirect him to homepage
        if (Auth::guest()) {
            return redirect('/auctions/' . $auction_id);
        }

        $user_id = Auth::id();
        $favourite_db = Favourite::where('auction_id', $auction_id)->where('user_id', $user_id)->get();
        if ($favourite_db->isEmpty()){
            $favourite = new Favourite([
                'auction_id' => $auction_id,
                'user_id' => $user_id,
            ]);
            $favourite->save();
        }

        return redirect('/auctions/' . $auction_id);
    }

    /**
     * Creates a new auction.
     *
     * @param  Request request containing the description
     * @return Response
     */
    public function removeFavourite(Request $request)
    {
        $auction_id = $request->route('id');

        //if user not authenticated, redirect him to homepage
        if (Auth::guest()) {
            return redirect('/auctions/' . $auction_id);
        }

        $user_id = Auth::id();
        $favourite_db = Favourite::where('auction_id', $auction_id)->where('user_id', $user_id)->first();
        if ($favourite_db){
            $favourite_db->delete();
        }

        return redirect('/auctions/' . $auction_id);
    }

    /**
     * Creates a new auction.
     *
     * @param  Request request containing the description
     * @return Response
     */
    public function deleteAuction(Request $request)
    {
        $auction_id = $request->route('id');

        //if user not authenticated, redirect him to homepage
        if (Auth::guest()) {
            return redirect('/auctions/' . $auction_id);
        }

        $user_id = Auth::id();
        $auction = Auction::findOrFail($auction_id);
        $vehicle = $auction->vehicle;

        if ($user_id != $vehicle->owner) {
            return redirect('/auctions/' . $auction_id);
        }

        $bids = $auction->bids;

        if (!($bids->isEmpty())){
            return redirect('/auctions/' . $auction_id);
        }

        $vehicle->delete();

        return redirect('/')->with('message', 'Auction deleted successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : void
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\View
     */
    public function show(int $id) : View
    {
        $auction = Auction::findOrFail($id);
        $vehicle = $auction->vehicle;

        $images_paths = $auction->getVehicleFromAuction();

        $user = User::find(Auth::id());
        if($auction->auctiontype == 'Private' && !($user->moderator() || $user->guestAuction($id))){
            return view('layouts.error');
        }

        if($user->bannedAuction($id)->exists()){
            return view('pages.banned_auction');
        }

        $owner = User::findOrFail($vehicle->owner);
        $auction_comments = $auction->getComments();

        $favourite = false;
        //know if this auction is favourited by user
        if (!Auth::guest()) {
            $user_id = Auth::id();
            $favourite_db = Favourite::where('auction_id', $auction->id)->where('user_id', $user_id)->get();
            if (!($favourite_db->isEmpty()))
                $favourite = true;
        }

        $users=[];
        //check if moderator to fill moderator area
        if (!Auth::guest() && $user->moderator()) {
            $users = User::all();
        } 

        try {
            $current_max_bid_amount = Bid::where('auction_id', '=', $id)->max('amount');

            $current_max_bid = $auction->getCurrentMaxBid();

            $highest_bidder = $auction->getCurrentMaxBidder();

            $bid_history = Bid::where('auction_id', '=', $id)
                ->join('user',  'user.id',      '=', 'bid.user_id')
                // ->join('image', 'user.profileimage',  '=', 'image.id')
                ->select('user.username', 'amount', 'createdon')
                ->orderBy('createdon', 'DESC')
                ->get();     
            
        }
        catch (Exception $e) {
            return view('pages.auction', [
                'auction'       => $auction,
                'vehicle'       => $vehicle,
                'images_paths'  => $images_paths,
                'max_bid'       => null,
                'owner'         => $owner,
                'highest_bidder'=> null,
                'comments'      => $auction_comments,
                'favourite'     => $favourite,
                'users'         => $users,
                'bid_history'   => null
            ]);
        }
        
        return view('pages.auction', [
            'auction'       => $auction,
            'vehicle'       => $vehicle,
            'images_paths'  => $images_paths,
            'max_bid'       => $current_max_bid_amount,
            'owner'         => $owner,
            'highest_bidder'=> $highest_bidder,
            'comments'      => $auction_comments,
            'favourite'     => $favourite,
            'users'         => $users,
            'bid_history'   => $bid_history
        ]);
    }

    public function bid(Request $request, int $auction_id) : RedirectResponse {

        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $bid = new Bid;

        $bid->user_id = Auth::id();
        $bid->auction_id = $auction_id;
        $bid->amount = $request->get('amount');

        try {
            $bid->save();
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['Invalid Amount']);
        }

        return redirect()->back();
    }

    public function getHighestBid(Request $request, int $auction_id) : JsonResponse {
        $auction = Auction::findOrFail($auction_id);
        $highestBid = $auction->getCurrentMaxBid();
        $highestBidder = $auction->getCurrentMaxBidder();
        if($highestBidder !== null) $highestBid['username'] = $highestBidder->username;
        if ($request->wantsJson()) {
            return response()->json($highestBid, 200);
        } else {
            return response('', 415);
        }
    }

    /**
     * Update the specified resource in database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAuction(Request $request, int $auction_id) : RedirectResponse
    {
        $validated = $request->validate([
            'brand'         => 'required|max:50',
            'model'         => 'required|max:50',
            'year'          => 'required|numeric',
            'condition'     => 'required|in:Mint,Clean,Average,Rough',
            'horsepower'    => 'required|numeric',
        ]);

        // date / time validator
        $validator = Validator::make($request->all(), [
            'startingdate' => 'required|date',
            'endingdate'   => 'required|date|after:startingdate',
        ]);
        if( $validator->fails() ) { // Dates are the same or wrong; checking time
            $validator = Validator::make($request->all(), [
               'startingdate'    => 'required|date',
               'endingdate'      => 'required|date|date_equals:startingdate',
               'startingtime'    => 'required|date_format:H:i:s',
               'endingtime'    => 'required|date_format:H:i:s|after_or_equal:startingtime',
            ]);
            if( $validator->fails() ) {
               return redirect()->back()->withErrors(['End Date must be later than Start Date']);
            }
        }

        $start = new Carbon($request->startingdate . ' ' . $request->startingtime, 'Europe/London');
        $end = new Carbon($request->endingdate . ' ' . $request->endingtime, 'Europe/London');
        
        $auction = Auction::findOrFail($auction_id);
        $vehicle = Vehicle::findOrFail($auction->vehicle_id);
        
        // update vehicle information
        try {
            Vehicle::where('id', $auction->vehicle_id)->update(
                [
                    'brand'     => $request->brand,
                    'model'     => $request->model,
                    'year'      => $request->year,
                    'condition' => $request->condition,
                    'horsepower'=> $request->horsepower,
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['Invalid Vehicle Information']);
        }

        try {
            // update auction information
            Auction::where('id', $auction_id)->update(
                [
                    'startingtime'  => Carbon::parse($start->setTimezone('UTC'))->format('Y-m-d H:i:s'),
                    'endingtime'    => Carbon::parse($end->setTimezone('UTC'))->format('Y-m-d H:i:s'),
            ]);
        } catch(\Exception $e) {
            return redirect()->back()->withErrors(['Ending must be at least 1 hour after the Start']);
        }

        return redirect()->back()->withSuccess('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) : void
    {
        //
    }
}
