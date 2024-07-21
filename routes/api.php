<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChatController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('getAllUsers', [AuthController::class, 'getAllUsers']);

Route::get('createCoutry', [BlogController::class, 'createCoutry']);

Route::post('validation', [BlogController::class, 'validation']);


Route::group(['prefix' => 'chats', 'controller' => ChatController::class], function () {
    Route::post('provide', 'provide');
    Route::group(['prefix' => 'rooms'], function () {
       Route::get('/', 'getRooms');
        Route::group(['prefix' => '{room:id}'], function () {
            Route::get('/', 'getMessages');
            Route::post('load', 'loadMoreMessages');
            Route::post('send', 'send');
            Route::put('read', 'read');
        });
    });
   Route::group(['prefix' => 'go'], function () {
       Route::put('online', 'goOnline');
       Route::put('offline', 'goOffline');
   });
});


Route::post('chats/provide', [ChatController::class,'provide']);
Route::post('chats/rooms/{rooms:id}/send', [ChatController::class,'send']);



// Route::get('chats/rooms', [ChatController::class,'getRooms']);
// Route::get('chats/rooms/{rooms:id}', [ChatController::class,'getMessages']);
// Route::post('chats/rooms/{rooms:id}/load', [ChatController::class,'loadMoreMessages']);

// Route::put('chats/rooms/{rooms:id}/read', [ChatController::class,'read']);
