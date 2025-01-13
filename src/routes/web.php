<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// 商品一覧
Route::get('/products', [ProductController::class, 'index']);

// 商品登録（画面表示）
Route::get('/products/register', [ProductController::class, 'create']);

// 商品登録（処理）
Route::post('/products/register', [ProductController::class, 'store']);

// 商品詳細
Route::get('/products/{productId}', [ProductController::class, 'show']);

// 商品更新
Route::post('/products/{productId}/update', [ProductController::class, 'update']);

// 商品検索　分けるとバグが発生して、原因もわからなかったので、商品一覧に統合
Route::get('/products/search', [ProductController::class, 'search']);

// 商品削除
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy']);

Route::fallback(function () {
    \Log::info('Fallback route reached: ' . request()->fullUrl());
    abort(404, 'Fallback route: Not Found');
});
