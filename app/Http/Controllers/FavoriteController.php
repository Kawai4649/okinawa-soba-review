<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Store;

class FavoriteController extends Controller
{
    // ユーザーのお気に入り店舗一覧を表示
    public function index()
    {
        $user = Auth::user();
        $favorites = Favorite::where('user_id', $user->id)
            ->with('store')  // storeリレーションをロード
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    // お気に入りに追加
    public function store(Request $request)
    {
        $userId = Auth::id();
        $storeId = $request->input('store_id');
        
        $favorite = Favorite::updateOrCreate(
            ['user_id' => $userId, 'store_id' => $storeId]
        );

        return response()->json([
            'success' => true,
            'message' => '店舗をお気に入りに追加しました。',
            'favorite' => $favorite
        ]);
    }

    // お気に入りから削除
    public function destroy(Request $request)
    {
        $userId = Auth::id();
        $storeId = $request->input('store_id');

        $favorite = Favorite::where('user_id', $userId)
            ->where('store_id', $storeId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json([
                'success' => true,
                'message' => 'お気に入りから削除しました。'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'お気に入りが見つかりませんでした。'
        ], 404);
    }
}


