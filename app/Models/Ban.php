<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'ban';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id', 'created_by', 'ban_type', 'auction_id'
  ];

  /**
   * Get the User that is banned
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function user(): HasMany
  {
      return $this->hasMany(User::class, 'user_id', 'id');
  }

  /**
   * Get the Auctions that the user is banned from
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function auctions(): HasMany
  {
      return $this->hasMany(Auction::class, 'auction_id');
  }
}