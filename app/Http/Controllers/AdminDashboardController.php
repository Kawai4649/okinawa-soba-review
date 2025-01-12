<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {    
        return view('admin.dashboard');
    }

    public function reviews()
    {
        // 全レビューを取得し、関連するユーザーとストア情報も取得
        $reviews = Review::with('user', 'store')->get();
        // ビューにデータを渡す
        return view('admin.reviews', compact('reviews'));
    }
    public function destroyReview(Review $review)
    {
       
        // レビューを削除
        $review->delete();
        // 成功メッセージとともにレビュー管理ページへリダイレクト
        return redirect()->route('admin.admin.reviews')->with('success', 'レビューが削除されました。');
    }

    
        // ストアの存在を確認
    public function users()
    {
        $users = User::all();
        // 'admin.users' ビューにユーザー情報を渡す
        return view('admin.users', compact('users'));
    }
    public function destroyUser($id)
    {
        // 指定されたユーザーを取得し、削除
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.admin.users')->with('success', 'アカウントが削除されました。');
    }
    

    public function stores()
    {
        return view('admin.index');
    }

}
