<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Vehicle extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'vehicle';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    // not including the creationTime
    'owner', 'brand', 'model', 'condition', 'year', 'horsepower'
  ];

  /**
   * Get the auction that owns the Vehicle
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function auction(): BelongsTo
  {
      return $this->belongsTo('App\Models\Auction');
  }


}