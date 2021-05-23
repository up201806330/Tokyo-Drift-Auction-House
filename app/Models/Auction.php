<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bid;
use DB;

class Auction extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'auction';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    // not including the creationTime
    'auction_name', 'vehicle_id', 'startingbid', 'startingtime', 'endingtime', 'auctiontype'
  ];


  public function getVehicleFromAuction() {
    return DB::table('image')
    ->join('vehicle_image', 'vehicle_image.image_id', '=', 'image.id')
    ->join('vehicle', 'vehicle.id', '=', 'vehicle_image.vehicle_id')
    ->select('vehicle.id', 'vehicle_image.sequence_number', 'image.path')
    ->where('vehicle.id', '=', $this->vehicle->id)
    ->get();
  }

  public function getMaxBidAmount($auction_id) {
    return Bid::where('auction_id', '=', $auction_id)->max('amount');
  }

  public function getCurrentMaxBid() {
    return Bid::where([
      ['amount',      '=', $this->getMaxBidAmount($this->id)],
      ['auction_id',  '=', $this->id],
    ])->first();
  }

  public function getCurrentMaxBidder() {
    $maxBid = $this->getCurrentMaxBid();
    if($maxBid == null) return null;
    return User::find($maxBid->user_id);
  }

  public function getAdequateTimeDifference() {
    if (\Carbon\Carbon::now() > $this->endingtime)
      return "Ended "       . \Carbon\Carbon::parse($this->endingtime)->diffForHumans();

    else if ($this->startingtime > \Carbon\Carbon::now())
      return "Starts in "   . \Carbon\Carbon::parse($this->startingtime)->diffForHumans();
    
    else return "Ends in "  . \Carbon\Carbon::parse($this->endingtime)->diffForHumans();
  }


  /**
   * Get the vehicle associated with the Auction
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  // public function vehicle(): HasOne
  // {
  //     return $this->hasOne('App\Models\Vehicle');
  // }

  /**
   * Get the vehicle that owns the Auction
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function vehicle()
  {
      return $this->belongsTo(Vehicle::class, 'vehicle_id');
  }

  public function getComments(){
    // $auction_comments = Comment::where('auction_id', '=', $this->id)->get();
    return DB::table('comment')
      ->join('user', 'user.id', '=', 'comment.user_id')
      ->where('comment.auction_id', '=', $this->id)
      ->select('auction_id', 'comment.id', 'comment.user_id', 'username', 'profileimage', 'createdon', 'content')
      ->orderBy('createdon', 'desc')
      ->get();
  }

  /**
  * Get the guests associated with the Auction
  */
  public function guests(){
    return $this->belongsToMany(User::class);
  }
}
