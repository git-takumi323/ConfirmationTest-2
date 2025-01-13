@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <div class="breadcrumb">
        <a href="/products">商品一覧</a> > {{ $product->name }}
    </div>

    <form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="product-detail-card">
            <div class="product-image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            <div class="product-info">
                <label for="name">商品名</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="商品名を入力">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="price">値段</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="値段を入力">
                @error('price')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label>季節</label>
                @foreach (['春', '夏', '秋', '冬'] as $season)
                <label>
                    <input type="checkbox"
                        name="seasons[]"
                        value="{{ $season }}"
                        @if(in_array($season, old('seasons', $product->seasons->pluck('name')->toArray()))) checked @endif>
                    {{ $season }}
                </label>
                @endforeach
                @error('seasons')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="description">商品説明</label>
                <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="image">商品画像</label>
                <input type="file" id="image" name="image">
                @error('image')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-edit">変更を保存</button>
                <a href="/products" class="btn-back">戻る</a>
                <form action="/products/{{ $product->id }}/delete" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-delete">ゴミ箱</button>
                </form>
            </div>
        </div>
    </form>
</div>
@endsection
