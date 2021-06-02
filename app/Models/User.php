<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Image;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'profileimage',
        'firstname',
        'lastname',
        'email',
        'username',
        'password',
        'location',
        'about',
        'registeredon',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'firstName' => 'string',
        'lastName' => 'string',
        'email' => 'string',
        'username' => 'string',
        'password' => 'string',
        'location' => 'string',
        'about' => 'string',
        'registeredOn' => 'string', // to change (?)
        'profileImage' => 'integer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImage(){
        return Image::findOrFail($this->profileimage);
    }


    public static function findUserImage($id) {
        $user = User::findOrFail($id);
        return $user->getImage();
    }


    /**
     * Get the profileImage that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profileImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'profileImage');
    }

    /**
     * Get all of the vehicle for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany('App\Models\Vehicle');
    }

    /**
     * Get all of the auctions that User is invited to
     */
    public function auctionGuest(){
        return $this->belongsToMany(Auction::class);
    }

    /**
     * Get all of the auctions that User is invited to
     */
    public function guestAuction($auction_id){
        return $this->auctionGuest()->where('auction_id', '=', $auction_id)->first();
    }

    /**
     * Get all of the auctions that User has favourited
     */
    public function auctionFavourite(){
        return $this->belongsToMany(Favourite::class);
    }

    /**
     * Get all of the auctions that User moderates
     */
    public function auctionMod(){
        return $this->belongsTo(AuctionModerator::class, 'id', 'user_id');
    }

    /**
     * Get all of the auctions that User is invited to
     */
    public function modAuction($auction_id){
        return $this->auctionMod()->where('auction_id', '=', $auction_id)->first();
    }

    /**
     * Get if user is global moderator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function globalMod(){
        return $this->belongsTo(GlobalMod::class, 'id');
    }

    /**
     * Get if user is admin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(){
        return $this->belongsTo(Admin::class, 'id');
    }

    /**
     * Get if user is seller
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller(){
        return $this->belongsTo(Seller::class, 'id');
    }

    /**
     * Get if user is moderator (of any kind)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moderator(){
        return ($this->globalMod()->exists() || $this->admin()->exists());
    }

     /**
     * Get if user is banned
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function banned(){
        return $this->belongsTo(Ban::class, 'id', 'user_id');
    }
}
