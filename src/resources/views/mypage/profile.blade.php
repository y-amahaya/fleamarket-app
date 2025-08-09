@extends('layouts.app')

@section('content')
@php
    $profileImg = $user->profile_image
        ? asset('storage/' . $user->profile_image)
        : asset('storage/default_profile.png');
@endphp

<div class="profile-container">

    <div class="profile-header">
        <div class="profile-header-left">
            <img src="{{ $profileImg }}" alt="profile" class="profile-image-preview">
            <div class="profile-username">{{ $user->name ?? 'ユーザー名' }}</div>
        </div>
        <a href="{{ route('profile.edit') }}" class="profile-edit-btn">
            プロフィールを編集
        </a>
    </div>

    <div class="profile-tabs">
        <a href="{{ route('mypage.index', ['page' => 'sell']) }}" class="{{ $tab === 'sell' ? 'active' : '' }}">
            出品した商品
        </a>
        <a href="{{ route('mypage.index', ['page' => 'buy']) }}" class="{{ $tab === 'buy' ? 'active' : '' }}">
            購入した商品
        </a>
    </div>

    @if($items->isNotEmpty())
        <div class="product-grid">
            @foreach ($items as $product)
                @php
                    // 画像パスがフルURLかストレージかで切替（最低限の保険）
                    $path = $product->image_path;
                    $img  = $path
                            ? (Str::startsWith($path, ['http://','https://']) ? $path : asset('storage/'.$path))
                            : 'https://placehold.co/400x300?text=No+Image';
                @endphp
                <a href="{{ route('items.show', ['id' => $product->id]) }}" class="product-card-link">
                    <div class="product-card {{ $product->is_sold ? 'sold' : '' }}">
                        <div class="product-image-wrapper">
                            <img src="{{ $img }}" alt="商品画像">
                        </div>
                        <div class="product-name">
                            {{ $product->name }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="no-products">表示できる商品がありません。</div>
    @endif

</div>
@endsection
