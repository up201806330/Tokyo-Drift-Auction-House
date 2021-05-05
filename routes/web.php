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
// Home
// Route::get('/', 'Auth\LoginController@home');


// Auction
Route::get('/auctions/new', 'AuctionController@showCreateForm')->name('create_auction');
Route::get('/auctions/{id}', 'AuctionController@show');

// Homepage
Route::get('/home', 'HomepageController@show')->name('homepage');

// Comment Section
Route::post('/auctions/{id}/comments', 'CommentController@create');
Route::delete('/auctions/{id}/comments/{comment_id}', 'CommentController@delete');

// Profile
Route::get('/users/{id}', 'UserController@showProfile')->name('show_profile');
Route::post('/users/{id}', 'UserController@editProfile')->name('edit_profile');
Route::get('/users/{id}/photo', 'UserController@showPhoto')->name('show_profile_photo');

// Route::get('/', function () {
//     return view('pages.auction');
// });

// // Cards
// Route::get('cards', 'CardController@list');
// Route::get('cards/{id}', 'CardController@show');

// // API
Route::get('/auctions/{id}/comments', 'CommentController@getAuctionComments');
// Route::put('api/cards', 'CardController@create');
// Route::delete('api/cards/{card_id}', 'CardController@delete');
// Route::put('api/cards/{card_id}/', 'ItemController@create');
// Route::post('api/item/{id}', 'ItemController@update');
// Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
