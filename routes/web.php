<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/ttt', function () {
//     return DB::connection('mysql')->table('users')->get();
//     return $usersSecondDB = DB::connection('second_mysql')->table('users')->get();
// });

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('slug', [LocationController::class, 'slug']);

Route::get('display-user', [LocationController::class, 'getUserInfo']);
Route::post('store_coordinates', [LocationController::class, 'store_coordinates'])->name('store_coordinates');
Route::get('test', [LocationController::class, 'test']);
Route::post('teststore', [LocationController::class, 'teststore'])->name('teststore');

Auth::routes();
// Auth::routes(['verify' => true]);

// Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });

Route::resource('blogs', BlogController::class);
