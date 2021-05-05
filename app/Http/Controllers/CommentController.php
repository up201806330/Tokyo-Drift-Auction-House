<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Gate;
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

        // now probably never enters this if
        if (Auth::guest()) {
            $comment->user_id = 1;
        }
        else {
            $comment->user_id = Auth::id();
        }
        $comment->auction_id = $auction_id;
        // $comment->createdon = \Carbon\Carbon::now()->toDateTimeString();
        $comment->content = $request->get('content');
    
        $comment->save();

        return $comment->id;
    }

    
    public function delete(Request $request) {
        
        if (! Gate::allows('commentOwner', Comment::find($request->comment_id))) {
            return redirect()->back();
        }

        $comment = Comment::find($request->comment_id);

        $comment->delete();
        return redirect()->back();
    }


    public function getAuctionComments(Request $request, $auction_id) {
        if ($request->wantsJson()) {
            $comments = Auction::find($auction_id)->getComments();
            return response()->json($comments, 200);
        }
        else {
            return response()->json(['error' => 'Error msg'], 415);
        }

    }


}
