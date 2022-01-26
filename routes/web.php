<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferOrderController;
use App\Models\Airport;
use App\Models\TransferPoint;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/de');

Route::group(['prefix' => '{language}'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/aboutus', [AboutUsController::class, 'index'])->name('aboutus');

    Route::get('/myorder', [MyOrderController::class, 'index'])->name('myorder');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::get('/transfer', function () {
        return redirect()->route('home', app()->getLocale());
    });

    Route::post('/transfer', [TransferController::class, 'index'])->name('transfer');

    Route::get('/transfer-order', function () {
        return redirect()->route('home', app()->getLocale());
    });

    Route::post('/transfer-order', [TransferOrderController::class, 'index'])->name('transfer-order');

    Route::get('order-details/{order}', [OrderDetailsController::class, 'index'])->name('order-details');
});

Route::group(['prefix' => 'api/v1'], function (){
    Route::post('airports', function () {
        return Airport::all();
    });

    Route::post('transfer-points', function () {
       return TransferPoint::orderBy('name', 'asc')->get();
    });

    Route::post('verify-phone', [PhoneNumberController::class, 'show']);

    Route::post('create-order', [CreateOrderController::class, 'create']);

    Route::post('order-details', [OrderDetailsController::class, 'check'])->name('check-order-details');

    Route::post('contact-form', [ContactFormController::class, 'index']);
});
