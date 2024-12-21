<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    // 商品一覧
    public function index(Request $request)
{
    $query = Product::query();

    // 検索機能
    if ($request->has('keyword') && !empty($request->keyword)) {
        $query->where('name', 'LIKE', '%' . $request->keyword . '%');
    }

    // 並び替え機能
    if ($request->has('sort') && in_array($request->sort, ['asc', 'desc'])) {
        $query->orderBy('price', $request->sort);
    }

    // ページネーション（1ページに6件表示）
    $products = $query->paginate(6);

    // ビューにデータを渡す
    return view('products.index', compact('products', 'request'));
}

    // 商品詳細
    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        return view('products.show', compact('product'));
    }

    // 商品登録画面
    public function create()
    {
        return view('products.create');
    }

    // 商品更新処理
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            // 古い画像を削除
            Storage::delete('public/' . $product->image);
            // 画像保存処理
            $imagePath = $request->file('image')->store('public/products');
            $data['image'] = str_replace('public/', '', $imagePath);
            }
        $product->update($data);
        return redirect('/products')->with('success', '商品情報が更新されました。');
    }

    // 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect('/products')->with('success', '商品が削除されました。');
    }
}
