<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\hotel_booking_api\HotelController;
use App\Http\Controllers\hotel_booking_api\RoleController;
use App\Http\Controllers\hotel_booking_api\RoomController;
use App\Http\Controllers\hotel_booking_api\TypeRoomController;
use App\Http\Controllers\hotel_booking_api\UserController;
use App\Http\Controllers\hotel_booking_api\AccountController;
use App\Http\Controllers\hotel_booking_api\AuthController;
use App\Http\Controllers\hotel_booking_api\BookingController;
use App\Http\Controllers\hotel_booking_api\CommentController;
use App\Http\Controllers\hotel_booking_api\HotelImageController;
use App\Http\Controllers\hotel_booking_api\RoomImageController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/get-user',[ApiController::class,"getUser"]);


Route::controller(HotelController::class) // đã xữ lý xong
    ->group(function () {
        Route::get('/hotels', 'index');
        Route::get('/hotels/{id}', 'show');
        Route::post('/hotels', 'store');
        Route::put('/hotels/{id}', 'update');
        Route::delete('/hotels/{id}', 'destroy');
    });

Route::controller(HotelImageController::class) // xữ lý xong.
    ->group(function () {
        Route::get('/hotel_images', 'index');
        Route::get('/hotel_images/{id}', 'show');
        Route::post('/hotel_images', 'store');
        Route::put('/hotel_images/{id}', 'update');
        Route::delete('/hotel_images/{id}', 'destroy');
    });





Route::controller(TypeRoomController::class)  // xữ lý xong
    ->group(function () {
        Route::get('/type_rooms', "index");
        Route::get('/type_rooms/{id}', 'show');
        Route::post('/type_rooms', "store");
        Route::put('/type_rooms/{id}', 'update');
        Route::delete('/type_rooms/{id}', 'destroy');
    });

Route::controller(RoomController::class)  // xữ lý xong
    ->group(function () {
        Route::get('/rooms', "index");
        Route::get('/rooms/{id}', 'show');
        Route::post('/rooms', "store");
        Route::put('/rooms/{id}', 'update');
        Route::delete('/rooms/{id}', 'destroy');
    });
Route::controller(RoomImageController::class)  // xữ lý xong
    ->group(function () {
        Route::get('/room_images', "index");
        Route::get('/room_images/{id}', 'show');
        Route::post('/room_images', "store");
        Route::put('/room_images/{id}', 'update');
        Route::delete('/room_images/{id}', 'destroy');
    });

Route::controller(RoleController::class)  //xữ lý xong
    ->group(function () {
        Route::get('/roles', 'index');
        Route::get('/roles/{id}', 'show');
        Route::post('/roles', 'store');
        Route::put('/roles/{id}', 'update');
        Route::delete('/roles/{id}', 'destroy');
    });
Route::controller(UserController::class) //xữ lý xong
    ->group(function () {
        Route::get('/users', "index");
        Route::get('/users/{id}', 'show');
        Route::post('/users', "store");
        Route::put('/users/{id}', 'update');
        Route::delete('/users/{id}', 'destroy');
    });




Route::controller(AccountController::class) //xữ lý xong
    ->group(function () {
        Route::get('/accounts', "index");
        Route::get('/accounts/{id}', 'show');
        Route::post('/accounts', "store");
        Route::put('/accounts/{id}', 'update');
        Route::delete('/accounts/{id}', 'destroy');
    });

Route::controller(CommentController::class)
    ->group(function () {
        Route::get('/comments', "index");
        Route::get('/comments/{id}', 'show');
        Route::post('/comments', "store");
        Route::put('/comments/{id}', 'update');
        Route::delete('/comments/{id}', 'destroy');
    });


Route::controller(BookingController::class)
    ->group(function () {
        Route::get('/bookings', "index");
        Route::get('/bookings/{id}', 'show');
        Route::post('/bookings', "store");
        Route::put('/bookings/{id}', 'update');
        Route::delete('/bookings/{id}', 'destroy');
    });

Route::post('/login', [AuthController::class, 'Login']);
Route::any('{any}', [ApiController::class, 'NotFound'])->where('any', '.*');
