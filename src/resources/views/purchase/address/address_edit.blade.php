@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">

<div class="address-edit-container">
    <h1 class="purchase-title">住所の変更</h1>

    <form action="{{ route('purchase.address.update') }}" method="POST" class="address-form">
        @csrf

        <label for="postal_code">郵便番号</label>
        <input id="postal_code" type="text" name="postal_code" value="{{ old('postal_code') }}">
        @error('postal_code') <p class="error">{{ $message }}</p> @enderror

        <label for="prefecture">都道府県</label>
        <input id="prefecture" type="text" name="prefecture" value="{{ old('prefecture') }}">
        @error('prefecture') <p class="error">{{ $message }}</p> @enderror

        <label for="city">市区町村</label>
        <input id="city" type="text" name="city" value="{{ old('city') }}">
        @error('city') <p class="error">{{ $message }}</p> @enderror

        <label for="address">番地・建物名</label>
        <input id="address" type="text" name="address" value="{{ old('address') }}">
        @error('address') <p class="error">{{ $message }}</p> @enderror

        <button type="submit" class="btn-primary">更新する</button>

        @if (session('status'))
            <p class="notice">{{ session('status') }}</p>
        @endif
    </form>
</div>
@endsection
