<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    // ユーザー登録後のリダイレクト先
    protected $redirectTo = '/stores/search';

    // 新規ユーザー登録フォームを表示する
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // ユーザー登録処理を行う
    public function register(Request $request)
    {
        // バリデーションルールを定義
        $this->validator($request->all())->validate();

        // ユーザーを登録する
        event(new Registered($user = $this->create($request->all())));

        // ユーザーをログインさせる
        Auth::login($user);
        
        // リダイレクトするURLを指定する場合
        return redirect()->intended('/stores/search');
    }

    // バリデーションルールを定義
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'kana' => 'required|string|max:255',
        ]);
    }

    // 新しいユーザーを作成する
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'kana' => $data['kana'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'date' => now()->format('Y-m-d')
        ]);
    }
}

