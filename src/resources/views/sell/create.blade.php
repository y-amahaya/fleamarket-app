@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">

<div class="sell-container">
    <h1 class="sell-title">商品の出品</h1>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" class="sell-form">
        @csrf

        <section class="sell-section">
            <h2 class="sell-subtitle">商品画像</h2>
            <div class="image-drop">
                <label class="image-drop-inner">
                    画像を選択する
                    <input type="file" name="images[]" multiple accept="image/*">
                </label>
                @error('images')   <p class="error">{{ $message }}</p> @enderror
                @error('images.*') <p class="error">{{ $message }}</p> @enderror
            </div>
        </section>

        <section class="sell-section">
            <h2 class="sell-subtitle">商品の詳細</h2>

            <div class="form-row">
                <label class="form-label">カテゴリー</label>
                <div class="category-chips">
                    @foreach($categories as $c)
                        <input type="radio" id="cat-{{ $c->id }}" name="category_id" value="{{ $c->id }}" class="chip-input" {{ old('category_id') == $c->id ? 'checked' : '' }}>
                        <label for="cat-{{ $c->id }}" class="chip">{{ $c->name }}</label>
                    @endforeach
                </div>
                @error('category_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <label class="form-label">商品の状態</label>
                <select name="condition" class="form-select">
                    <option value="">選択してください</option>
                    @foreach($conditions as $value => $label)
                        <option value="{{ $value }}" {{ old('condition') === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('condition') <p class="error">{{ $message }}</p> @enderror
            </div>
        </section>

        <section class="sell-section">
            <h2 class="sell-subtitle">商品名と説明</h2>

            <div class="form-row">
                <label for="name" class="form-label">商品名</label>
                <input id="name" name="name" type="text" class="form-input" value="{{ old('name') }}">
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <label for="brand" class="form-label">ブランド名</label>
                <input id="brand" name="brand" type="text" class="form-input" value="{{ old('brand') }}">
            </div>

            <div class="form-row">
                <label for="description" class="form-label">商品説明</label>
                <textarea id="description" name="description" rows="4" class="form-textarea">{{ old('description') }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <label for="price" class="form-label">販売価格</label>
                <div class="price-input">
                    <span class="yen">¥</span>
                    <input id="price" name="price" type="number" min="0" step="1" class="form-input" value="{{ old('price') }}">
                </div>
                @error('price') <p class="error">{{ $message }}</p> @enderror
            </div>
        </section>

        <div class="form-actions">
            <button type="submit" class="btn-primary">出品する</button>
        </div>
    </form>
</div>
@endsection
