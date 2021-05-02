<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleImage;
use App\Models\Auction;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use App\Models\Bid;
use DB;

use Carbon\Carbon;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $auction_id)
    {
        $comment = new Comment;

        $comment->id = Comment::all()->max('id') + 1;
        $comment->user_id = 1;
        $comment->auction_id = $auction_id;
        $comment->createdon = \Carbon\Carbon::now()->toDateTimeString();
        $comment->content = $request->get('content');
    
        $comment->save();

        return redirect()->back();
    }


}
