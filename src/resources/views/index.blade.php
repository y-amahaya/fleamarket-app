@extends('layouts.app')

@section('content')
<div class="product-container">

    <div class="tab-menu">
        <a href="{{ url('/?tab=all') }}" class="{{ $type === 'all' ? 'active' : '' }}">おすすめ</a>

    @auth
        <a href="{{ url('/?tab=mylist') }}" class="{{ $type === 'mylist' ? 'active' : '' }}">マイリスト</a>
    @endauth
    </div>

    <div class="product-list">
        @forelse ($products as $product)
            <div class="product-card {{ $product->is_sold ? 'sold' : '' }}">
                <a href="{{ route('items.show', ['id' => $product->id]) }}">
                    <img src="{{ $product->image_path ?? asset('images/no-image.png') }}" alt="商品画像">
                </a>

                <div class="product-name">
                    <a href="{{ route('items.show', ['id' => $product->id]) }}">
                    </a>
                </div>
            </div>
        @empty
            <p>商品がありません。</p>
        @endforelse
    </div>

</div>
@endsection
