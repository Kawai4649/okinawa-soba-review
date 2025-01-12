<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Store;

class ReviewsController extends Controller
{
    public function create($storeId)
    {
        // ストアの存在を確認
        $store = Store::findOrFail($storeId);
        return view('reviews.create', compact('store'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'star_rating' => 'required|integer|between:1,5',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // ログインしているか確認
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $userId = auth()->id(); // 現在のユーザーIDを取得

        Review::create([
            'user_id' => $userId,
            'store_id' => $request->input('store_id'),
            'star_rating' => $request->input('star_rating'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'date' => now()->format('Y-m-d'), 
        ]);

        return redirect()->route('stores.show', $request->input('store_id'))->with('success', 'Review added successfully.');
    }

    public function show($storeId)
    {
        dd($storeId);
        $store = Store::findOrFail($storeId);
        $averageRating = $store->reviews()->avg('star_rating'); 
        
        return view('stores.show', compact('store', 'averageRating'));
    }

}
