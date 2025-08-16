@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profilebuy.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="profilebuy__image">
        <img src=" {{ isset($profile['image']) ? asset('storage/' . $profile['image']) : asset('default.png') }}" alt="アイコン画像"
            class="profile-icon">
        <label for="image" class="file-button">画像を選択する</label>
        <input type="file" id="image" name="image" class="file-input">

        <div class="product-card">
            <img src="{{ '/storage/' . $profile['image'] }}" alt=" 商品画像" class="product-image">
        </div>


    </div>
    <form class="profile-form" action="/mypage/profile/{{ auth()->user()->id }}" method="get" novalidate>
        @csrf
        <input class="profile-form__btn" type="submit" value="プロフィールを編集">
    </form>
    <div class="toppage-list">
        <a class="listeditem" href="/mypage/sell">
            <h3>出品した商品</h3>
        </a>
        <div class="boughtitem">
            <h3>購入した商品</h3>
        </div>
    </div>
</div>
@endsection