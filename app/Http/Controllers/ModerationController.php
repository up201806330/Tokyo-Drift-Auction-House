<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Auction;
use App\Models\Vehicle;
use App\Models\User;
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
            return redirect('/');
        }

        $user = User::find(Auth::id());

        if (!$user->moderator()){
            return redirect('/');
        }

        if ($user->globalMod()->exists() || $user->admin()->exists()){
            $auctions = Auction::all();
        }
        else{
            $auctions_mod = $user->auctionMod;
            $auctions=[];
            foreach($auctions_mod as $auction){
                array_push($auctions, $auction->auction);
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