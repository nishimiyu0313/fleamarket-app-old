@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profilebuy.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="profile__info">
        <img src=" {{ isset($profile['image']) ? asset('storage/' . $profile['image']) : asset('default.png') }}" alt="アイコン画像"
            class="profile-icon">
        <p class="profile-name">{{ $profile->name }}</p>

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
    <div class="products-form">
        <div class="products-row">
            @foreach ($purchasedItems as $payment)
            @if ($payment->item)
            <div class="products-card">
                <a href="/item/{{ $payment->item->id }}">
                    <img src="{{ '/storage/' . $payment->item->image }}" alt=" 商品画像" class="products-image">
                </a>
                <div class="item-name">{{ $payment->item->name }}</div>

            </div>
            @endif
            @endforeach
        </div>
        <div class="pagination">
            {{ $purchasedItems->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
</div>
@endsection