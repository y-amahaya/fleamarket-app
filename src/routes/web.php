<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

// 商品一覧ページ（トップ画面）
Route::get('/', [ProductController::class, 'index'])->name('products.index');;
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage.index');
});

// 商品詳細ページ
Route::get('/item/{id}', [ItemController::class, 'show'])->name('items.show');

Route::middleware('auth')->group(function () {
    // コメント投稿
    Route::post('/item/{id}/comment', [ItemController::class, 'comment'])
        ->whereNumber('id')
        ->name('items.comment');

    // いいね
    Route::post('/item/{id}/like', [ItemController::class, 'toggleLike'])
        ->whereNumber('id')
        ->name('items.like');
});

// 認証が必要なルート
Route::middleware(['auth','verified'])->group(function () {
    // 商品出品ページ
    Route::get('/sell', [SellController::class, 'create'])->name('product.create');
    Route::post('/sell', [SellController::class, 'store'])->name('product.store');

    // プロフィール画面（マイページ・編集）
    Route::get('/mypage', [ProfileController::class, 'index'])->name('mypage.index');
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // プロフィール画面（購入一覧・出品一覧）
    Route::get('/mypage?page=buy', [ProfileController::class, 'buyList'])->name('profile.buyList');
    Route::get('/mypage?page=sell', [ProfileController::class, 'sellList'])->name('profile.sellList');
});

// 会員登録ページ
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// ログインページ
Route::post('/login', [RegisterController::class, 'login'])->name('login');

// 商品購入ページ
Route::middleware('auth')->group(function () {
    // 購入画面（表示）
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase'])
        ->whereNumber('item_id')->name('purchase.show');

    // 支払い方法を反映
    Route::post('/purchase/{item_id}/method', [PurchaseController::class, 'selectMethod'])
        ->whereNumber('item_id')->name('purchase.method');

    // 購入確定
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])
        ->whereNumber('item_id')->name('purchase.store');

    // 住所変更
    Route::get('/purchase/address', [PurchaseController::class, 'addressEdit'])
        ->name('purchase.address.edit');
    Route::post('/purchase/address', [PurchaseController::class, 'addressUpdate'])
        ->name('purchase.address.update');
});

// 認証案内画面
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// 認証メールの再送
Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth','throttle:6,1'])->name('verification.send');

// 認証リンク検証
Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('profile.edit');
})->middleware(['auth','signed','throttle:6,1'])->name('verification.verify');
