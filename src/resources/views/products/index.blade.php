@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="product-list">
    <div class="product-list-container">
        <!-- 左側: 検索フォームと価格順 -->
        <aside class="product-list-sidebar">
            <h2>商品一覧</h2>
            <form action="/products" method="GET" class="search-form">
                <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <button type="submit" class="btn-search">検索</button>
            </form>

            <div class="sort-container">
                <label for="sort">価格順で表示</label>
                <select id="sort" name="sort" onchange="location.href='/products?keyword={{ request('keyword') }}&sort='+this.value">
                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>価格で並び替え</option>
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>低い順に表示</option>
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                </select>
            </div>

            <a href="/products/register" class="btn-add">+ 商品を追加</a>
        </aside>

        <!-- 右側: 商品グリッド -->
        <div class="product-list-content">
            @if (request('sort'))
            <div class="sort-tag">
                並び替え条件:
                <span class="tag">{{ request('sort') === 'asc' ? '低い順' : '高い順' }}</span>
                <a href="/products?keyword={{ request('keyword') }}" class="tag-remove">×</a>
            </div>
            @endif

            <div class="products-grid">
                @foreach ($products as $product)
                <div class="product-card">
                    <a href="/products/{{ $product->id }}">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <div class="product-info">
                            <h2>{{ $product->name }}</h2>
                            <p>¥{{ number_format($product->price) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="pagination">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
