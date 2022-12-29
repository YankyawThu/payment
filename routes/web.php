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

Route::get('/', function () {
    $gateway = new Braintree\Gateway([
        'environment' => 'sandbox',
        'merchantId' => 'w9r3mrqrktwqpfjc',
        'publicKey' => 'nvqpwry7r47d9d2v',
        'privateKey' => '6a9a0a8659f18ba347df8723f46dc1c5'
    ]);
    $clientToken = $gateway->clientToken()->generate();
    return view('welcome', ['token' => $clientToken]);
});

Route::post('/pay', [PayController::class, 'index'])->name('pay');
