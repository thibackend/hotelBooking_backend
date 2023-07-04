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
use App\Http\Controllers\hotel_booking_api\InforUserController;
use App\Http\Controllers\hotel_booking_api\RoomServiceControlle as Hotel_booking_apiRoomServiceControlle;
use App\Http\Controllers\hotel_booking_api\ServiceController;
use App\Http\Controllers\hotel_booking_api\UserInforController as Hotel_booking_apiUserInforController;
use App\Models\RoomService;

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




Route::controller(TypeRoomController::class)  // xữ lý xong
    ->group(function () {
        Route::get('/type_rooms', "index");
        Route::get('/type_rooms/{id}', 'show');
        Route::post('/type_rooms', "store");
        Route::put('/type_rooms/{id}', 'update');
        Route::delete('/type_rooms/{id}', 'destroy');
    });

// Route::post('/login', [AuthController::class, 'Login']);

// Route::any('{any}', [ApiController::class, 'NotFound'])->where('any', '.*');

// Route::group(['middleware' => 'auth.jwt'], function () {
//     // Protected routes
//     // ...

// User Registration
Route::post('/register', [UserController::class, 'register']);

// User Login
Route::post('/login', [UserController::class, 'login']);


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
    Route::get('/', [ServiceController::class, 'index']);
    Route::post('/', [ServiceController::class, 'store']);
    Route::get('/{id}', [ServiceController::class, 'show']);
    Route::put('/{id}', [ServiceController::class, 'update']);
    Route::delete('/{id}', [ServiceController::class, 'destroy']);
});

//Route::apiResource('rooms', RoomController::class);
// Route::apiResource('room-images', RoomImageController::class);
Route::controller(RoomController::class)  // xữ lý xong
    ->group(function () {
        Route::get('/room-and-images', "getRoomImages");
        Route::get('/rooms', "index");
        Route::get('/rooms/{id}', "show");
        Route::post('/rooms', 'store');
        Route::put('/rooms/{id}', 'update');
        Route::delete('/rooms/{id}', 'destroy');

        // route này dùng để lấy tất cả các room để show ra trang giao diện
        Route::get('/room-and-images', "getRoomImages");

        // route này dùng để lấy một room và ảnh của nó để thực hiện show ra chi tiết.
        Route::get('/getOne-room-and-images/{id}', 'getOneRoomImage');

        // route này dùng để lấy tất cả các services theo room id.
        Route::get('/get-room-with-services/{room_id}', 'getRoomWithServiecs');
    });

Route::group(['prefix' => 'room-images'], function () {
    Route::get('/', [RoomImageController::class, 'index']);
    Route::post('/', [RoomImageController::class, 'store']);
    Route::get('/{id}', [RoomImageController::class, 'show']);
    Route::put('/{id}', [RoomImageController::class, 'update']);
    Route::delete('/{id}', [RoomImageController::class, 'destroy']);
});


Route::group(['prefix' => 'room-services'], function () {
    Route::get('/', [Hotel_booking_apiRoomServiceControlle::class, 'index']);
    Route::post('/', [Hotel_booking_apiRoomServiceControlle::class, 'store']);
    Route::get('/{id}', [Hotel_booking_apiRoomServiceControlle::class, 'show']);
    Route::put('/{id}', [Hotel_booking_apiRoomServiceControlle::class, 'update']);
    Route::delete('/{id}', [Hotel_booking_apiRoomServiceControlle::class, 'destroy']);
});


Route::apiResource('hotel_images', HotelImageController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('bookings', BookingController::class);
