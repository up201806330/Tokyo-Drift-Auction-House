<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Auction;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Image;
use App\Models\AuctionModerator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ModerationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showModeration() : View
    {
        if (Auth::guest()) {
            return view('layouts.error');
        }

        $user = User::find(Auth::id());

        $auctions_mod = AuctionModerator::where('user_id', '=', $user->id);

        if (!$user->moderator() && empty($auctions_mod)){
            return view('pages.tos');
        }

        if ($user->moderator()){
            $auctions = Auction::all();
        }
        else{
            $auctions=[];
            foreach($auctions_mod->get() as $auction_mod){
                echo "<script>console.log('" . json_encode($auction_mod) . "');</script>";
                $auction = Auction::find($auction_mod->auction_id);
                array_push($auctions, $auction);
            }
        }

        $admin = false;
        if ($user->admin()->exists()){
            $admin = true;
        }

        $all_users = User::all();
        $users=[];
        foreach($all_users as $user){
            $new_user = [
                'id' => $user->id,
                'username' => $user->username,
                'image_path' => Image::findOrFail($user->profileimage)->path,
                'seller' => $user->seller()->exists(),
                'admin' => $user->admin()->exists(),
                'global' => $user->globalMod()->exists(),
            ];
            array_push($users, $new_user);
        }
        
        return view('pages.moderator', [
            'users' => $users,
            'auctions' => $auctions,
            'admin' => $admin,
        ]);
    }
}