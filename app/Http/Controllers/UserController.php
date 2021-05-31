<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Auction;
use App\Models\Vehicle;
use App\Models\Image;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function showProfile(int $id) : View
    {
        $profileOwner = User::findOrFail($id);
        $profileImage = Image::findOrFail($profileOwner->profileimage);

        $biddingAuctions = Auction::whereIn('id', Bid::distinct('auction_id')
            ->where('user_id', $id)
            ->get()->map->only(['auction_id'])
        )->get();

        $ownedAuctions = Auction::whereIn('vehicle_id',
            Vehicle::where('owner', $id)
            ->get()->map->only(['id'])
        )->get();

        $favouriteAuctions = Auction::whereIn('id',
            Favourite::where('user_id', $id)
            ->get()->map->only(['auction_id'])
        )->get();
        
        return view('pages.profile', [
            'profileOwner' => $profileOwner,
            'profileImage' => $profileImage,
            'biddingAuctions' => $biddingAuctions,
            'ownedAuctions' => $ownedAuctions,
            'favouriteAuctions' => $favouriteAuctions,
        ]);
    }

    /**
     * Update the specified resource in database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request, int $user_id) : RedirectResponse
    {
        if (! Gate::allows('profileOwner', Auth::user())) {
            return redirect()->back();
        }

        // editing only the "about" part
        if ($request->has('about_update')) {
            User::where('id', $user_id)->update(['about' => $request->about_update]);
        }
        
        // editing only the profile image
        else if ($request->file('profileimage')) {
            $file = $request->file('profileimage');

            $fileNameExtension = ".jpg";

            // Upload file
            $file->move(base_path('public\assets\profile_photos'), User::findOrFail($user_id)->profileimage . $newFileName);
        }

        // editing profile information
        else {
            User::where('id', $user_id)->update(
                [
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'username' => $request->username,
                    'location' => $request->location
                ]
            );
        }

        return redirect()->back()->withSuccess('Updated successfully');
    }

    public function showPhoto(Request $request, int $user_id) : RedirectResponse
    {
        $user = User::findOrFail($user_id);
        return redirect('assets/'.$user->getImage()->path);
    }
}
