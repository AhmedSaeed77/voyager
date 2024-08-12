<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ZipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\PayMobController ;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\SmsController;

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
})->middleware('visitor')->name('/');

Route::get('slug2', function () {
    $delimiter = '-';
    $text2 = 'Cairo Egypt';
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $text2))))), $delimiter));
    // return $slug;
    $text = 'المنتجات الغذائيه (4 كيلو)';
    $delimiter = '-';
    $cleanedText = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, $cleanedText)), $delimiter));
    return $slug;
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


Route::get('dropzone', function(){
    return view('dropzone');
 });

Route::post('/dropzone/upload', [InvoiceController::class, 'upload'])->name('dropzone.upload');

Route::get('profile', [ProfileController::class, 'store']);

Route::get('/deposit', [App\Http\Controllers\DepositController::class,'deposit'])->name('deposit');
Route::get('/mark-as-read', [App\Http\Controllers\DepositController::class,'markAsRead'])->name('mark-as-read');


Route::get('/social', function () {
    return view('social');
})->name('social');

Route::get('/login/{provider}', [SocialController::class,'redirect']);
Route::get('/login/{provider}/callback', [SocialController::class,'callback']);



Route::get('processed',[CheckoutController::class,'index']);
Route::post('checkout/processed',[PayMobController::class,'checkout_processed']);
Route::get('checkout/response',[PayMobController::class,'responseStatus']);
Route::get('checkout',[PayMobController::class,'checkout']);

Route::get('/send-emails', [SmsController::class, 'sendEmails']);

Route::get('/upload', [VideoController::class, 'create'])->name('videos.create');
Route::post('/upload', [VideoController::class, 'store'])->name('videos.store');
Route::get('/show', [VideoController::class, 'show'])->name('videos.show');
