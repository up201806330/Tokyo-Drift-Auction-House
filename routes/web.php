<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get   ('/'                                   , 'HomepageController@show'                     )->name('homepage'          );
Route::get   ('/about'                              , function () { return view('pages.about'); }   )->name('about'             );
Route::get   ('/tos'                                , function () { return view('pages.tos'  ); }   )->name('tos'               );
Route::get   ('/login'                              , 'Auth\LoginController@showLoginForm'          )->name('login'             );
Route::post  ('/login'                              , 'Auth\LoginController@login'                  );
Route::get   ('/logout'                             , 'Auth\LoginController@logout'                 )->name('logout'            );
Route::get   ('/register'                           , 'Auth\RegisterController@showRegistrationForm')->name('register'          );
Route::post  ('/register'                           , 'Auth\RegisterController@register'            );
Route::get   ('/auctions/new'                       , 'AuctionController@showCreateForm'            )->name('create_auction'    );
Route::post  ('/auctions/new'                       , 'AuctionController@create'                    )->name('create_auction'    );
Route::get   ('/auctions/{id}/bids/highest'         , 'AuctionController@getHighestBid'             )->name('highest_bid'       );
Route::post  ('/auctions/{id}/bids'                 , 'AuctionController@bid'                       )->name('bid'               );
Route::delete('/auctions/{id}/comments/{comment_id}', 'CommentController@delete'                    );
Route::get   ('/auctions/{id}/comments'             , 'CommentController@getAuctionComments'        );
Route::post  ('/auctions/{id}/comments'             , 'CommentController@create'                    );
Route::get   ('/auctions/{id}'                      , 'AuctionController@show'                      );
Route::post  ('/auctions/{id}'                      , 'AuctionController@editAuction'               );
Route::delete('/auctions/{id}'                      , 'AuctionController@deleteAuction'             )->name('delete_auction'    );
Route::post  ('/auctions/{id}/favourites'           , 'AuctionController@addFavourite'              )->name('add_favourite'     );
Route::delete('/auctions/{id}/favourites'           , 'AuctionController@removeFavourite'           )->name('remove_favourite'  );
Route::get   ('/auctions'                           , 'SearchController@showAll'                    )->name('search'            );
Route::post  ('/auctions'                           , 'SearchController@showFiltered'               )->name('search'            );
Route::get   ('/users/{id}/photo'                   , 'UserController@showPhoto'                    )->name('show_profile_photo');
Route::get   ('/users/{id}'                         , 'UserController@showProfile'                  )->name('show_profile'      );
Route::post  ('/users/{id}'                         , 'UserController@editProfile'                  )->name('edit_profile'      );
