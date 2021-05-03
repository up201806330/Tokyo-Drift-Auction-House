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

        if (Auth::guest()) {
            $comment->user_id = 1;
        }
        else {
            $comment->user_id = Auth::id();
        }
        $comment->auction_id = $auction_id;
        $comment->createdon = \Carbon\Carbon::now()->toDateTimeString();
        $comment->content = $request->get('content');
    
        $comment->save();

        // return $comment->id;
        return redirect()->back();
    }

    
    public function delete(Request $request) {
        
        if (! Gate::allows('commentOwner', Comment::find($request->comment_id))) {
            // abort(403);
            return redirect()->back();
        }

        $comment = Comment::find($request->comment_id);

        $comment->delete();
        return redirect()->back();
    }


}
