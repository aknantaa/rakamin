<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'App\Http\Controllers\API\UserController@login');
Route::post('register', 'App\Http\Controllers\API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'App\Http\Controllers\API\UserController@details');
});
Route::get('get', 'App\Http\Controllers\API\ArticleController@list');
Route::get('get/{id}', 'App\Http\Controllers\API\ArticleController@show');
Route::post('create', 'App\Http\Controllers\API\ArticleController@create');
Route::put('update/{id}', 'App\Http\Controllers\API\ArticleController@update');
Route::delete('delete/{id}', 'App\Http\Controllers\API\ArticleController@destroy');