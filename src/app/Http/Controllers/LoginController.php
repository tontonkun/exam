<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function startLogin()
     {
         return view('login');
     }

     public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
        // リダイレクト先をクリア
            session()->forget('url.intended');
        // 認証に成功した場合
           return redirect()->to('/admin'); // 認証後のリダイレクト先
        }

        // 認証に失敗した場合
        return redirect()->back()->withErrors([
            'email' => '認証に失敗しました。メールアドレスまたはパスワードが間違っています。',
        ]);
    }

    // ログアウト処理
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
     
