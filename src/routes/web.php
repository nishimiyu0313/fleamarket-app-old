<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;



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

Route::get('/', [ItemController::class, 'list']);
Route::get('/item/{item_id}', [ItemController::class, 'detail']);

Route::middleware('auth')->group(function () {
    Route::post('/item/{item_id}\comments', [ItemController::class, 'storeComment']);
    Route::get('/mypage/profile', [ProfileController::class, 'index']);
    Route::post('/mypage/profile', [ProfileController::class, 'store']);
    Route::get('/purchase/{item_id}', [PaymentController::class, 'index']);
    Route::post('/purchase/{item_id}', [PaymentController::class, 'index']);
    Route::get('/purchase/address/{item_id}', [ProfileController::class, 'address']);
    Route::get('/mypage/buy', [ItemController::class, 'profileBuy']);
    Route::get('/sell', [ItemController::class, 'index']);
    Route::post('/sell', [ItemController::class, 'sell']);
    Route::get('/item/search', [ItemController::class, 'search']);
});
