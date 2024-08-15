<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        session()->forget('contact');
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        // 入力データを取得
        $userData = $request->only(['name', 'email', 'password']);

        // パスワードをハッシュ化
        $userData['password'] = Hash::make($userData['password']);

        // ユーザーの作成
        User::create($userData);

        // 登録が成功したらセッションの情報をクリア
        $request->session()->forget('contact');

        return redirect('/login');
    }
}
