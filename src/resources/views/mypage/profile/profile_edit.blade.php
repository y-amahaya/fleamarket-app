@extends('layouts.app')

@section('content')
@php
    $isEdit = request()->routeIs('profile.edit');
    $user = Auth::user();
@endphp
    <div class="form-container">
        <h2 class="form-title">プロフィール設定</h2>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            @method('PUT')

            <div class="profile-image-wrapper">
                <img
                    src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('storage/default_profile.png') }}"
                    class="profile-image-preview">
                <label for="image" class="image-upload-button">画像を選択する</label>
                <input id="image" type="file" name="image" accept="image/*">
                @error('image') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="name">ユーザー名</label>
                <input id="name" type="text" name="name"
                    value="{{ old('name', $isEdit ? ($user->name ?? '') : '') }}"
                    autocomplete="off" class="form-input">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="postal_code">郵便番号</label>
                <input id="postal_code" type="text" name="postal_code"
                    value="{{ old('postal_code', $isEdit ? ($user->postal_code ?? '') : '') }}"
                    class="form-input @error('postal_code') is-invalid @enderror"
                    inputmode="numeric">
                @error('postal_code') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="address">住所</label>
                <input id="address" type="text" name="address"
                    value="{{ old('address', $isEdit ? ($user->address ?? '') : '') }}"
                    class="form-input">
                @error('address') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="building">建物名</label>
                <input id="building" type="text" name="building"
                    value="{{ old('building', $isEdit ? ($user->building ?? '') : '') }}"
                    class="form-input">
                @error('building') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="submit-button">更新する</button>
        </form>
    </div>
@endsection
