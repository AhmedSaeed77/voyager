<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\InvoiceController;

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
})->name('/');

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
Route::resource('goals', GoalController::class);
Route::get('getimages/{id}', [BlogController::class,'getimages']);

Route::get('notification', [BlogController::class,'notification'])->middleware('auth');
Route::get('token',function(){ return $token = uniqid('', true); });

Route::get('recapatcha',function(){ return view('recapatcha'); });
Route::get('testmultiple',function(){ return view('testmultiple'); });
Route::get('edit',[BlogController::class,'edit']);
Route::post('testmultiple', [BlogController::class,'testmultiple'])->name('testmultiple');

Route::get('message', [BlogController::class,'message'])->name('message');

Route::get('getpageajax', [BlogController::class,'getpageajax'])->name('getpageajax');
Route::get('showajax', [BlogController::class,'showajax'])->name('showajax');


Route::get('livewire', function(){ return view('livewire'); });

Route::get('article', function(){ return view('livewireArticle'); });

Route::get('loginajax', function(){ return view('loginajax'); });
Route::post('loginajax', [BlogController::class,'loginajax']);

Route::controller(PDFController::class)->group(function(){
    Route::get('read-pdf-file', 'index');
});

Route::get('facebook', function(){ return view('facebook'); });

Route::get('usernotify', [BlogController::class, 'usernotify']);
Route::get('testrelation', [BlogController::class, 'test']);

Route::get('searchcity', [BlogController::class, 'searchcity']);
Route::get('invoice-pdf', [InvoiceController::class, 'index']);

Route::get('download-zip', ZipController::class);

Route::get('paypal', [PayPalController::class, 'index'])->name('paypal');
Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment/cancel');