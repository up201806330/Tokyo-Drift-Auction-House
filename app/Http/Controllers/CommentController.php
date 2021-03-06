<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, int $auction_id) : int
    {
        $validated = $request->validate([
            'content'   => 'required|max:511|unique:comment',
        ]);

        $comment = new Comment;

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

    
    public function delete(Request $request, int $id, int $comment_id) {
        $comment = Comment::findOrFail($comment_id);

        if ((!Gate::allows('commentOwner', $comment)) && (!User::find($comment->user_id)->moderator())) {
            return redirect()->back();
        }

        $comment->delete();
    }


    public function getAuctionComments(Request $request, int $auction_id) : JsonResponse {
        if ($request->wantsJson()) {
            $comments = Auction::findOrFail($auction_id)->getComments();
            foreach($comments as $comment){
                $comment->banned = User::findOrFail($comment->user_id)->bannedAuction($auction_id);
            }
            return response()->json($comments, 200);
        }
        else {
            return response()->json(['error' => 'Error msg'], 415);
        }

    }


}
