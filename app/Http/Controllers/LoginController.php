<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // ログインを表示するフォーム
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理を行う
    public function login(Request $request)
    {
        // バリデーションルールを定義
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 認証試行
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // 認証に成功した場合
            $user = Auth::user();

            // ユーザーの役割に応じてリダイレクト先を変更
            if ($user->role === 'admin') {
                // 管理者の場合は管理者ダッシュボードにリダイレクト
                return Redirect::intended('/admin/dashboard');
            }

            // 一般ユーザーの場合は通常のリダイレクト
            return Redirect::intended('/stores/search');
        }

        // 認証に失敗した場合
        throw ValidationException::withMessages([
            'email' => ['メールアドレスまたはパスワードが間違っています。'],
        ]);
    }

    // ログアウト処理を行う
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
