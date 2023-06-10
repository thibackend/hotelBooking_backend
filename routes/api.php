<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\hotel_booking_api\HotelController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/get-user',[ApiController::class,"getUser"]);


// Route::controller(HotelController::class)->group(function () {
//     Route::get('/hotel', 'index');
//     Route::post('/orders', 'store');
// });

Route::get('/hotel',[HotelController::class,'index']);

