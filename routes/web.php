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

Route::pattern('card', '[0-9]+');
Route::pattern('obsolete', '[0-9]+');


Route::get('/', 'CardController@index')->name('index');

Route::get('/deck', 'DeckController@index')->name('deck.index');
Route::post('/upgrade_deck', 'DeckController@upgrade')->name('deck.upgrade');

Route::get('/card_autocomplete', 'CardController@cardAutocomplete')->name('card.autocomplete');
Route::post('/card/search', 'CardController@search')->name('card.search');

Route::get('/card/{card?}', 'CardController@create')->name('card.create');
Route::post('/card', 'CardController@store')->name('card.store');

Route::post('/upvote/{obsolete}', 'CardController@upvote')->name('upvote');
Route::post('/downvote/{obsolete}', 'CardController@downvote')->name('downvote');


// API
Route::get('/api-guide', 'ApiController@guide')->name('api.guide');

Route::group(['middleware' => 'throttle:100,1'], function () {
	Route::get('/api/obsoletes/{search?}', 'ApiController@obsoletes')->name('api.obsoletes');
});