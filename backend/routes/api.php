<?php

use App\Http\Controllers\API\Booking\BookingController;
use App\Http\Controllers\API\CardItem\CardController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Comment\CommentController;
use App\Http\Controllers\API\Comment\ReplyController;
use App\Http\Controllers\API\Message\MessageController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\APi\Province\ProvinceController;
use App\Http\Controllers\APi\Service\ServiceController;
use App\Http\Controllers\API\Slide\SlideshowController;
use App\Http\Controllers\API\Store\StoreController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\QR\QRController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/registerOwner', [AuthController::class, 'registerOwner'])->name('register.owner');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');

//province list
Route::get('province/list', [ProvinceController::class, 'index']);

//slide show
Route::get('slideshow/list', [SlideshowController::class, 'index']);

Route::middleware('auth:sanctum')->prefix('service')->group(function () {
    Route::get('/list', [ServiceController::class, 'index']);
    Route::get('/show/{id}', [ServiceController::class, 'show']);
    Route::post('/create', [ServiceController::class, 'store']);
    Route::put('/update/{id}', [ServiceController::class, 'update']);
    Route::delete('/destroy/{id}', [ServiceController::class, 'destroy']);
});

Route::get('store/list', [StoreController::class, 'index']);
Route::get('store/StoreByProvince', [StoreController::class, 'StoreByProvince']);
Route::get('store/list/{provinceId}', [StoreController::class, 'GetStoreByProvinceId']);
Route::get('service/list/{storeId}', [ServiceController::class, 'GetServiceByStoreId']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::put('/updateInfo', [UserController::class, 'update']);
    Route::post('store/update', [StoreController::class, 'update']);
    Route::post('/update/infoOwner', [UserController::class, 'update']);

    //add services to the cards list
    Route::get('/card/list', [CardController::class, 'index']);
    Route::post('/card/add/{service_id}', [CardController::class, 'add']);
    Route::delete('/card/remove/{cardItem_id}', [CardController::class, 'destroy']);

    //booking
    Route::post('/booking', [BookingController::class, 'store']);
    Route::get('/booking/list', [BookingController::class, 'index']);
    Route::delete('{id}', [BookingController::class, 'destroy']);
    Route::get('/services/detail/{booking_id}', [BookingController::class, 'getBookingService']);

});

Route::get('/category/list', [CategoryController::class, 'index']);

//comment
Route::middleware('auth:sanctum')->prefix('comment')->group(function () {
    Route::post('/create/{service_id}', [CommentController::class, 'store']);
    Route::post('/update/{comment_id}', [CommentController::class, 'update']);
    Route::delete('/delete/{comment_id}', [CommentController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->prefix('reply')->group(function () {
    Route::post('/{comment_id}', [ReplyController::class, 'store']);
    Route::post('/update/{reply_id}', [ReplyController::class, 'update']);
    Route::delete('/delete/{reply_id}', [ReplyController::class, 'destroy']);
});
Route::get('comment/list/{service_id}', [CommentController::class, 'index']);
Route::get('reply/list/{comment_id}', [ReplyController::class, 'index']);

//payment
Route::post('/stripe/payment', [StripePaymentController::class, 'makePayment']);



//chat
Route::middleware('auth:sanctum')->prefix('chat')->group( function (){
    Route::post('/create',[MessageController::class, 'store']);
});


Route::get('/getAllUser', [UserController::class, 'index']);