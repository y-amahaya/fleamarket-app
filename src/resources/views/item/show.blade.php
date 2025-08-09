@extends('layouts.app')

@section('content')

<div class="product-detail-container">

    <div class="product-detail-wrapper">

        <div class="product-image">
            <img src="{{ $product->image_path }}" alt="{{ $product->name }}">
        </div>

        <div class="product-info">

            <h1 class="product-name">{{ $product->name }}</h1>

            <p class="product-brand">{{ $product->brand }}</p>

            <p class="product-price">¥{{ number_format($product->price) }}（税込）</p>

    <div class="product-stats">
        @if(auth()->check())
        <form action="{{ route('items.like', ['id' => $product->id]) }}" method="POST" class="stat-like">
            @csrf
            <button type="submit" class="star-like {{ ($isLiked ?? false) ? 'is-liked' : '' }}">★</button>
            <span class="likes-count">{{ $product->likes_count ?? 0 }}</span>
        </form>
        @else
            <a href="{{ route('login') }}" class="stat-like">
                <span class="star-like">★</span>
                <span class="likes-count">{{ $product->likes_count ?? 0 }}</span>
            </a>
        @endif

        <span class="stat-comment">
            <span class="comment-icon">💬</span>
            <span class="comments-count">{{ $product->comments_count ?? 0 }}</span>
        </span>
    </div>

            <a
                href="{{ auth()->check() ? route('purchase.show', ['item_id' => $product->id]) : route('login') }}"
                class="btn-purchase">
                購入手続きへ
            </a>

            <div class="product-description">
                <h2>商品説明</h2>
                <p>{{ $product->description }}</p>
            </div>

            <div class="product-meta">
                <h2>商品の情報</h2>
                <p>カテゴリー：
                    <span class="category-label">{{ $product->category->name }}</span>
                </p>
                <p>商品の状態：{{ $product->condition }}</p>
            </div>

        </div>
    </div>

    <div class="comments-section">

        <h3>コメント（{{ $product->comments_count }}）</h3>

        @foreach ($product->comments as $comment)
            <div class="product-comment">
                <div class="product-comment-icon"></div>
                <div class="product-comment-content">
                    <strong>{{ $comment->user->name }}</strong>
                    <p>{{ $comment->comment }}</p>
                </div>
            </div>
        @endforeach

        <form
            action="{{ auth()->check() ? route('items.comment', ['id' => $product->id]) : route('login') }}"
            method="{{ auth()->check() ? 'POST' : 'GET' }}"
            class="comment-form">
            @csrf
            <div>
                <label for="comment">商品へのコメント</label>
                <textarea name="comment" id="comment" rows="4">{{ old('comment') }}</textarea>
                @error('comment')
                    <div class="comment-error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">コメントを送信する</button>
        </form>
    </div>

</div>
@endsection
