<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home;
use App\Http\Controllers\AboutUs;
use App\Http\Controllers\MyOrder;
use App\Http\Controllers\Contact;

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

Route::get('/', [Home::class, 'index']);

Route::get('/aboutus', [AboutUs::class, 'index']);

Route::get('/myorder', [MyOrder::class, 'index']);

Route::get('/contact', [Contact::class, 'index']);
