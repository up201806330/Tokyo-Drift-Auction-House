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

        $auctions_mod = AuctionModerator::where('user_id', '=', $user->id)->get();


        if (!$user->moderator() && $auctions_mod->isEmpty()){
            return view('layouts.error');
        }

        if ($user->moderator()){
            $auctions = Auction::all();
        }
        else{
            $auctions=[];
            foreach($auctions_mod as $auction_mod){
                $auction = Auction::find($auction_mod->auction_id);
                array_push($auctions, $auction);
            }
        }

        $all_users = User::all();
        $users=[];
        foreach($all_users as $u){
            if (!$u->admin()->exists() && !$u->banned()->exists()){
                array_push($users, $u);
            }
        }
        
        return view('pages.moderator', [
            'user' => $user,
            'users' => $users,
            'auctions' => $auctions,
        ]);
    }
}