<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth.basic')->post('/tokens/create', 'TokenController@create');


Route::middleware('auth:sanctum')->group(function() {

	Route::get('/users/{user}/show', 'UserController@show');

});
