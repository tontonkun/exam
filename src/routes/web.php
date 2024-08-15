<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

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

// お問い合わせフォームを表示するルート
Route::get('/', [ContactController::class, 'contact']);

// 確認画面からの送信でデータを保存するルート
Route::post('/contacts', [ContactController::class, 'store']);

// 確認画面を表示するルート
Route::post('/confirm', [ContactController::class, 'confirm']);

//登録フォームへのアクセス
Route::get('/register', [RegisterController::class, 'register']);

//登録フォームでのユーザー情報登録
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('web')->group(function () {

//Loginフォームへのアクセス
Route::get('/login', [LoginController::class, 'startLogin']);

//Loginフォームでのログイン
Route::post('/login', [LoginController::class, 'login']);

//Loginフォームでのログアウト
Route::post('/logout', [LoginController::class, 'logout']);

});

//管理フォームへのアクセス
Route::middleware('auth')->group(function () {
Route::get('/admin', [AdminController::class, 'admin']);
});

//管理フォームでの検索
Route::get('/search', [AdminController::class, 'search']);




// Route::get('/z', [ContactController::class, 'z_contact']);

// // 確認画面を表示するルート
// Route::post('/z/contacts/confirm', [ContactController::class, 'z_confirm']);

// // 確認画面からの送信でデータを保存するルート
// Route::post('/z/contacts', [ContactController::class, 'z_store']);

// Route::post('/z/store', [ContactController::class, 'z_store']);





