<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;

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

    // 商品登録処理
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        // 画像保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $data['image'] = str_replace('public/', '', $imagePath);
        }

        // 商品登録
        $product = Product::create($data);

        // 季節の関連付け
        if ($request->has('seasons')) {
            $seasonIds = Season::whereIn('name', $request->input('seasons'))->pluck('id')->toArray();
            $product->seasons()->sync($seasonIds);
        }

        return redirect('/products')->with('success', '商品が登録されました。');
    }

    // 商品更新処理
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $product->image);
            $imagePath = $request->file('image')->store('public/products');
            $data['image'] = str_replace('public/', '', $imagePath);
        }

        $product->update($data);

        if ($request->has('seasons')) {
            $seasonIds = Season::whereIn('name', $request->input('seasons'))->pluck('id')->toArray();
            $product->seasons()->sync($seasonIds);
        } else {
            $product->seasons()->sync([]);
        }

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
