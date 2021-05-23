<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Auction;
use App\Models\Vehicle;
use App\Models\Comment;
use App\Models\Bid;
use App\Models\Image;
use App\Models\User;
use App\Models\AuctionGuest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // TODO -> em vez de redirecionar, aparecer overlay
            return redirect('/login');
        }

        $all_users = User::all();
        $users=[];
        foreach($all_users as $user){
            $new_user = [
                'id' => $user->id,
                'username' => $user->username,
                'image_path' => Image::find($user->profileimage)->path,
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
        if (Auth::guest()) {
            return redirect('/login');
        }

        $vehicle = new Vehicle([
            'owner' => Auth::id(),
            'brand' => $request->get('brand'),
            'model' => $request->get('model'),
            'condition' => $request->get('condition'),
            'year' => $request->get('year'),
            'horsepower' => $request->get('horsepower'),
        ]);

        $vehicle->save();

        $auction = new Auction([   
            'auction_name' => $request->get('auctionName'),
            'vehicle_id' => $vehicle->id,
            'startingbid' => $request->get('startingBid'),
            'startingtime' => $request->get('startingTime'),
            'endingtime' => $request->get('endingTime'),
        ]);

        $auction->save();

        if ($request->get('private') == 'on'){
            $auction->auctiontype = 'Private';
            $auction->save();
            
            $invited_users = $request->get('invited');
            foreach($invited_users as $user){
                $auction->guests()->attach($user);
            }
            $auction->save();
        }


        return redirect()->back();
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

    public function bid(Request $request, int $auction_id) : RedirectResponse {
        $bid = new Bid;

        $bid->user_id = Auth::id();
        $bid->auction_id = $auction_id;
        $bid->amount = $request->get('amount');

        $bid->save();

        return redirect()->back();
    }

    public function getHighestBid(Request $request, int $auction_id) : JsonResponse {
        $auction = Auction::find($auction_id);
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

        $start = new Carbon($request->startingdate . ' ' . $request->startingtime, 'Europe/London');
        $end = new Carbon($request->endingdate . ' ' . $request->endingtime, 'Europe/London');
        
        $auction = Auction::find($auction_id);
        $vehicle = Vehicle::find($auction->vehicle_id);
        
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

        // update auction information
        Auction::where('id', $auction_id)->update(
            [
                'startingtime'  => Carbon::parse($start->setTimezone('UTC'))->format('Y-m-d H:i:s'),
                'endingtime'    => Carbon::parse($end->setTimezone('UTC'))->format('Y-m-d H:i:s'),
        ]);

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
