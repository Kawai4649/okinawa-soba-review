<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class AdminStoreController extends Controller
{
    // 店舗一覧表示
    public function index()
    {
        
        // 全店舗を取得し、ページネーションを適用する
        $stores = Store::paginate(10); 
        // ビューに店舗データを渡す
        return view('admin.stores', ['stores' => $stores]);
       
    }

    // 新規店舗登録フォームを表示
    public function create()
    {
        return view('admin.stores.create');
    }

    // 店舗データを保存
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'postalcode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'closeddays' => 'required|string|max:255',
            'openinghours' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

        ]);

            // 画像の処理
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $picturePath = $file->store('public/pictures');
            $picturePath = str_replace('public/', '', $picturePath); // 保存パスを変換
        }

        Store::create([
            'name' => $request->input('name'),
            'kana' => $request->input('kana'),
            'picture' => $picturePath,
            'postalcode' => $request->input('postalcode'),
            'address' => $request->input('address'),
            'closeddays' => $request->input('closeddays'),
            'openinghours' => $request->input('openinghours'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return redirect()->route('admin.admin.stores')->with('success', '店舗が登録されました。');
    }

    public function edit(Store $store)
    {
        return view('admin.stores.edit', compact('store'));
    }
    
    public function update(Request $request, Store $store)
    {
        // バリデーションと更新処理
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'closing_days' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            
        ]);
    
        $store->update($request->all());
    
        return redirect()->route('admin.admin.stores')->with('success', '店舗情報が更新されました。');
    }
    public function destroy(Store $store)
    {
        // 店舗を削除
        $store->delete();

        // 削除後、一覧ページなどにリダイレクト
        return redirect()->route('admin.admin.stores')->with('success', '店舗が削除されました。');
    }


}



