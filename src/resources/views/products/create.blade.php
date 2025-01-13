@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="product-register">
    <h1>商品登録</h1>
    <form action="/products/register" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <label for="name">商品名 <span class="required">必須</span></label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- 値段 -->
        <label for="price">値段 <span class="required">必須</span></label>
        <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="値段を入力">
        @error('price')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- 商品画像 -->
        <label for="image">商品画像 <span class="required">必須</span></label>
        <input type="file" id="image" name="image" accept="image/png,image/jpeg">
        @error('image')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- 季節 -->
        <label>季節 <span class="required">必須</span> <small>複数選択可</small></label>
        @foreach (['春', '夏', '秋', '冬'] as $season)
            <label>
                <input type="checkbox" name="seasons[]" value="{{ $season }}" {{ in_array($season, old('seasons', [])) ? 'checked' : '' }}>
                {{ $season }}
            </label>
        @endforeach
        @error('seasons')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- 商品説明 -->
        <label for="description">商品説明 <span class="required">必須</span></label>
        <textarea id="description" name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- ボタン -->
        <div class="form-actions">
            <a href="/products" class="btn-back">戻る</a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection
