<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;

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

Route::get('/', [PayController::class, 'index']);
Route::post('/pay', [PayController::class, 'pay'])->name('pay');
