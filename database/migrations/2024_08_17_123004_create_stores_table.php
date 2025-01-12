<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // 新規店舗作成フォームの表示
    public function create()
    {
        return view('admin.stores.create');
    }

    // 新規店舗の保存処理
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'picture' => 'nullable|url',
            'postalcode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'closeddays' => 'required|string|max:255',
            'openinghours' => 'required|string|max:255',
        ]);

        // 新規店舗の作成
        Store::create([
            'name' => $request->input('name'),
            'kana' => $request->input('kana'),
            'picture' => $request->input('picture'),
            'postalcode' => $request->input('postalcode'),
            'address' => $request->input('address'),
            'closeddays' => $request->input('closeddays'),
            'openinghours' => $request->input('openinghours'),
        ]);

        // 店舗管理ページにリダイレクト
        return redirect()->route('admin.stores.index')->with('success', '店舗が登録されました。');
    }

    // 店舗一覧ページの表示
    public function index()
    {
        $stores = Store::all();
        return view('admin.stores.index', compact('stores'));
    }
}

