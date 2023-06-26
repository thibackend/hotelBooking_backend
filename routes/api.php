<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\hotel_booking_api\RoomController;
use App\Http\Controllers\hotel_booking_api\BookingController;
use App\Http\Controllers\hotel_booking_api\CategoryController;
use App\Http\Controllers\hotel_booking_api\CommentController;
use App\Http\Controllers\hotel_booking_api\HotelImageController;
use App\Http\Controllers\hotel_booking_api\RoomImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserInforController;
use App\Http\Controllers\hotel_booking_api\InforUserController;
use App\Http\Controllers\hotel_booking_api\ServiceController;
use App\Http\Controllers\hotel_booking_api\UserInforController as Hotel_booking_apiUserInforController;

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


// Route::controller(HotelImageController::class) // xữ lý xong.
//     ->group(function () {
//         Route::get('/hotel_images', 'index');
//         Route::get('/hotel_images/{id}', 'show');
//         Route::post('/hotel_images', 'store');
//         Route::put('/hotel_images/{id}', 'update');
//         Route::delete('/hotel_images/{id}', 'destroy');
//     });




// Route::controller(RoomController::class)  // xữ lý xong
//     ->group(function () {
//         Route::get('/room_and_images/{hotelID}', "get_room_in_a_hotel");
//         Route::get('/rooms', "index");
//         Route::get('/rooms/{id}', 'show');
//         Route::post('/rooms', "store");
//         Route::put('/rooms/{id}', 'update');
//         Route::delete('/rooms/{id}', 'destroy');
//     });
// Route::controller(RoomImageController::class)  // xữ lý xong
//     ->group(function () {
//         Route::get('/room_images', "index");
//         Route::get('/room_images/{id}', 'show');
//         Route::post('/room_images', "store");
//         Route::put('/room_images/{id}', 'update');
//         Route::delete('/room_images/{id}', 'destroy');
//     });




// Route::controller(CommentController::class)
//     ->group(function () {
//         Route::get('/comments', "index");
//         Route::get('/comments/{id}', 'show');
//         Route::post('/comments', "store");
//         Route::put('/comments/{id}', 'update');
//         Route::delete('/comments/{id}', 'destroy');
//     });


// Route::controller(BookingController::class)
//     ->group(function () {
//         Route::get('/bookings', "index");
//         Route::get('/bookings/{id}', 'show');
//         Route::post('/bookings', "store");
//         Route::put('/bookings/{id}', 'update');
//         Route::delete('/bookings/{id}', 'destroy');
//     });

// Route::post('/login', [AuthController::class, 'Login']);
// Route::any('{any}', [ApiController::class, 'NotFound'])->where('any', '.*');


// User Registration
Route::post('/register', [UserController::class, 'register']);

// User Login
Route::post('/login', [UserController::class, 'login']);
// Route::group(['middleware' => 'auth.jwt'], function () {
//     // Protected routes
//     // ...


// });
Route::controller(Hotel_booking_apiUserInforController::class) //xữ lý xong
    ->group(function () {
        Route::get('/users', "index");
        Route::get('/users/{id}', 'show');
        Route::post('/users', "store");
        Route::put('/users/{id}', 'update');
        Route::delete('/users/{id}', 'destroy');
    });

    Route::controller(CategoryController::class)  // xữ lý xong
    ->group(function () {
        Route::get('/categories', "index");
        Route::get('/categories/{id}', 'show');
        Route::post('/categories', "store");
        Route::put('/categories/{id}', 'update');
        Route::delete('/categories/{id}', 'destroy');
    });

    Route::group(['prefix' => 'services'], function () {
        Route::get('/', [ServiceController::class,'index']);
        Route::post('/', [ServiceController::class,'store']);
        Route::get('/{id}', [ServiceController::class,'show']);
        Route::put('/{id}', [ServiceController::class,'update']);
        Route::delete('/{id}',[ServiceController::class,'destroy']);
    });

    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('room-images',RoomImageController::class);