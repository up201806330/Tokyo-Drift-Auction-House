<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  protected $table = 'vehicle_image';

    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'vehicle_id', 'image_id', 'sequence_number'
  ];


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
