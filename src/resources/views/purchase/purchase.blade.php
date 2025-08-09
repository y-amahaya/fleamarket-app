@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">

<div class="purchase-wrapper">
    <section class="purchase-main">
        <div class="product-header">
            <img class="product-image" src="{{ $item['image_path'] }}" alt="商品画像">
            <div class="product-meta">
                <h2 class="product-name">{{ $item['name'] }}</h2>
                <p class="product-price">￥{{ number_format($item['price']) }}</p>
            </div>
        </div>

        <hr class="section-divider">

        <div class="payment-section">
            <h3 class="section-title">支払い方法</h3>

            <form action="{{ route('purchase.method', ['item_id' => $item['id']]) }}" method="POST" class="method-form">
                @csrf
                <select name="payment_method" class="select" aria-label="支払い方法を選択してください" onchange="this.form.submit()">
                    <option value="">選択してください</option>
                    @foreach($methodLabels as $value => $label)
                        <option value="{{ $value }}" {{ $value === $selectedMethod ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('payment_method')
                    <p class="error">{{ $message }}</p>
                @enderror
            </form>
        </div>

        <hr class="section-divider">

        <div class="address-section">
            <div class="address-header">
                <h3 class="section-title">配送先</h3>
                <a href="{{ route('purchase.address.edit') }}?item_id={{ $item['id'] }}" class="link-change">変更する</a>
            </div>
            <address class="address-box">
                <div>〒 {{ $userAddress['postal_code'] }}</div>
                <div>{{ $userAddress['prefecture'] ?? '' }} {{ $userAddress['city'] ?? '' }}</div>
                <div>{{ $userAddress['address'] ?? '' }}</div>
            </address>
        </div>
    </section>

    <aside class="purchase-summary">
        <div class="summary-row">
            <span>商品代金</span>
            <strong>￥{{ number_format($item['price']) }}</strong>
        </div>
        <div class="summary-row">
            <span>支払い方法</span>
            <strong>{{ $selectedMethodLabel }}</strong>
        </div>

        <form action="{{ route('purchase.store', ['item_id' => $item['id']]) }}" method="POST">
            @csrf
            <button type="submit" class="btn-primary" {{ $selectedMethod ? '' : 'disabled' }}>
                購入する
            </button>
        </form>

        @if (session('status'))
            <p class="notice">{{ session('status') }}</p>
        @endif
    </aside>
</div>
@endsection
