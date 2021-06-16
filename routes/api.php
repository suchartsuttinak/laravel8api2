<?php

use Illuminate\Http\request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/', function () {
    return config('app.url') . 'date:' . now();
});
Route::get('home', function () {
    return 'Hello home';
});
Route::get('staff/{id}', function ($id) {
    return 'Hello staff ' . $id;
});


