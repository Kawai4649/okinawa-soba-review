<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    // 検索画面
    public function search(Request $request)
    {
        return view('stores.search');
    }

    // 検索結果画面
    public function results(Request $request)
    {
        DB::enableQueryLog();
        
        $query = $request->input('query');
        $category = $request->input('category');
        $area = $request->input('area');
        $stores = Store::query()
            ->when(isset($query), function ($queryBuilder)use($query) {
                $queryBuilder->where('name', 'like', "%{$query}%")
                             ->orWhere('address', 'like', "%{$query}%");
            })
            ->when(isset($category), function ($queryBuilder, $category) {
                $queryBuilder->where('category', $category);
            })
            ->when(isset($area), function ($queryBuilder, $area) {
                $queryBuilder->where('area', $area);
            })
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view('stores.results', compact('stores'));
    }

    public function show($id)
    {
        $store = Store::with('reviews.user')->findOrFail($id);

        $averageRating = $store->reviews->avg('star_rating');

        return view('stores.show', compact('store', 'averageRating'));
    }
}
