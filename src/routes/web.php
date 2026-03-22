<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ============== 追加 =================
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// ============== 追加 end =================

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

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
});

// ============== 追加 =================
// ログイン送信
Route::post('/login', [LoginController::class, 'store'])
    ->middleware(['guest', 'web'])
    ->name('login.store');

// 会員登録送信
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware(['guest', 'web'])
    ->name('register.store');
// ============== 追加 end =================
