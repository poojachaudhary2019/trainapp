<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
    //return $request->user();
//});

Route::get('destinations', ['as' => 'destinations', 'uses' => 'ApiController@getDestinations']);
Route::post('showTrains', ['as' => 'showTrains', 'uses' => 'ApiController@getTrains']);
Route::post('bookTicket', ['as' => 'bookTicket', 'uses' => 'ApiController@bookTicket']);
Route::get('getTicket/{pnr}', ['as' => 'getTicket', 'uses' => 'ApiController@getTicket']);
