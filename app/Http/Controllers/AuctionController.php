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
                'image_path' => Image::findOrFail($user->profileimage)->path,
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
            foreach($invited_users as $user){
                $auction->guests()->attach($user);
            }
        }
        $auction->save();

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
     * Display all Auctions.
     *
     * @return \Illuminate\Http\View
     */
    public function showAll() : View {

        $all_auctions = Auction::all();

        return view('pages.search', [
            'auctions_to_display' => $all_auctions
        ]);
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
        // dd($categories_array);

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
            return view('pages.search', ['auctions_to_display' => []]);
        }

        return view('pages.search', [
            'auctions_to_display' => $auctions_to_display
        ]);
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

        $owner = User::findOrFail($vehicle->owner);
        $owner_profile_img = Image::findOrFail($owner->profileimage);
        $auction_comments = $auction->getComments();

        $favourite = false;
        //know if this auction is favourited by user
        if (!Auth::guest()) {
            $user_id = Auth::id();
            $favourite_db = Favourite::where('auction_id', $auction->id)->where('user_id', $user_id)->get();
            if (!($favourite_db->isEmpty()))
                $favourite = true;
        }

        try {
            $current_max_bid_amount = Bid::where('auction_id', '=', $id)->max('amount');

            $current_max_bid = $auction->getCurrentMaxBid();

            $highest_bidder = $auction->getCurrentMaxBidder();

            $highest_bidder_profile_img = Image::findOrFail($highest_bidder->profileimage);

            
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
                'comments'      => $auction_comments,
                'favourite'     => $favourite,
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
            'comments'      => $auction_comments,
            'favourite'     => $favourite,
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
