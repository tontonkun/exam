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

// 確認画面を表示するルート
Route::post('/confirm', [ContactController::class, 'confirm']);

//確認画面での修正ボタン押下
Route::get('/edit', [ContactController::class, 'contact']);

// 確認画面からの送信でデータを保存するルート
Route::post('/contacts', [ContactController::class, 'store']);

// 登録フォームへのアクセス
Route::get('/register', [RegisterController::class, 'register']);

// 登録フォームでのユーザー情報登録
Route::post('/register', [RegisterController::class, 'store']);

//登録フォームでの削除
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

// ログイン関連のルート（webミドルウェアの外に移動）
Route::get('/login', [LoginController::class, 'startLogin']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// 認証ミドルウェアを使って管理関連のルートを保護
Route::middleware('auth')->group(function () {
    // 管理フォームへのアクセス
    Route::get('/admin', [AdminController::class, 'admin']);

    // 管理フォームでの検索
    Route::get('/search', [AdminController::class, 'search']);

    // 管理フォームでのExport
    Route::get('/export-csv', [AdminController::class, 'exportCsv'])->name('export.csv');
});
