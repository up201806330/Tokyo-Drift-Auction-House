<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    'auction_name', 'vehicle_id', 'startingBid', 'startingTime', 'endingTime', 'auctionType'
  ];

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
   * Get the user that owns the Auction
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function vehicle()
  {
      return $this->belongsTo(Vehicle::class, 'vehicle_id');
  }
}
