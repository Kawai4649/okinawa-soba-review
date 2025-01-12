<?php


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
//店舗検索画面（トップページ）
Route::get('/search', [App\Http\Controllers\StoresController::class, 'search'])->name('home');
//店舗検索結果画面（店舗一覧）
Route::get('/results', [App\Http\Controllers\StoresController::class, 'results'])->name('stores.results');

// （店舗表示の下）お気に入り一覧
Route::get('/favorites', [App\Http\Controllers\ReviewsController::class, 'index'])->name('favorites.index');

//自分が登録したお気に入り一覧
Route::get('/favorites', [App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
Route::post('/favorites/destroy', [App\Http\Controllers\FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::post('/favorites', [App\Http\Controllers\FavoriteController::class, 'store'])->name('favorites.store');
// 新規登録フォームのルート
Route::get('register', [App\Http\Controllers\RegisterController::class, 'showRegistrationForm'])->name('register');

// ユーザー登録処理のルート
Route::post('register', [App\Http\Controllers\RegisterController::class, 'register']);

// ログインフォーム表示
Route::get('login', [App\Http\Controllers\LoginController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('login', [App\Http\Controllers\LoginController::class, 'login']);

//ログイン後の店舗検索画面表示
Route::get('/stores/search', [App\Http\Controllers\StoresController::class, 'search'])->name('stores.search');
Route::get('/stores/results', [App\Http\Controllers\StoresController::class, 'results'])->name('stores.results');
Route::get('/stores/{id}', [App\Http\Controllers\StoresController::class, 'show'])->name('stores.show');

// ログアウト
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// プロフィール表示
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
// プロフィール更新
Route::post('/profiles/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profiles.update');

// プロフィール編集
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profiles.update');

// レビュー作成画面
Route::get('/stores/{store}/reviews/create', [App\Http\Controllers\ReviewsController::class, 'create'])->name('reviews.create');
// レビューの保存
Route::post('/reviews', [App\Http\Controllers\ReviewsController::class, 'store'])->name('reviews.store');

// 一般ユーザー向けのルート
Route::middleware('auth')->group(function () {
    Route::get('/stores/search', [App\Http\Controllers\StoresController::class, 'search'])->name('stores.search');
});

// 管理者専用のルート
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

});
Route::prefix('admin')->name('admin.')->group(function () {
    // ダッシュボードからアクセスする各管理画面 
    Route::get('/reviews', [App\Http\Controllers\AdminDashboardController::class, 'reviews'])->name('admin.reviews');
    Route::get('/users', [App\Http\Controllers\AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/index', [App\Http\Controllers\AdminStoreController::class, 'index'])->name('admin.index');  
    Route::post('/index', [App\Http\Controllers\AdminStoreController::class, 'index'])->name('admin.index'); 
 
    // 店舗一覧表示
    Route::get('/stores', [App\Http\Controllers\AdminStoreController::class, 'index'])->name('admin.stores');
    // 店舗情報の保存
    Route::post('/stores', [App\Http\Controllers\AdminStoreController::class, 'store'])->name('admin.stores.store');
    // 新規登録フォーム
    Route::get('/stores/create', [App\Http\Controllers\AdminStoreController::class, 'create'])->name('admin.stores.create');
    // 店舗詳細表示
    Route::get('/stores/{store}', [App\Http\Controllers\AdminStoreController::class, 'show'])->name('admin.stores.show');
    // 編集フォーム
    Route::get('/stores/{store}/edit', [App\Http\Controllers\AdminStoreController::class, 'edit'])->name('admin.stores.edit');
    // 店舗情報の更新
    Route::put('/stores/{store}', [App\Http\Controllers\AdminStoreController::class, 'update'])->name('admin.stores.update');
    // 店舗情報の削除
    Route::delete('/stores/{store}', [App\Http\Controllers\AdminStoreController::class, 'destroy'])->name('admin.stores.destroy');
    // レビュー削除のルート設定
    Route::delete('/reviews/{review}', [App\Http\Controllers\AdminDashboardController::class, 'destroyReview'])->name('admin.reviews.destroy');
    //アカウント削除のルート設定
    Route::delete('/users/{id}', [App\Http\Controllers\AdminDashboardController::class, 'destroyUser'])->name('admin.users.destroy');
}); 


    


    




    