<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'favourite_auction';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'auction_id'
  ];

  /**
   * Get the User that favourites the auction
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo
  {
      return $this->belongsTo(User::class, 'user_id');
  }

  /**
   * Get the Auction that is favourited by the user
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function auction(): BelongsTo
  {
      return $this->belongsTo(Auction::class, 'auction_id');
  }
}
