@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profilesell.css') }}">
@endsection

@section('content')
<div class="content">
    <form class="profile-form" action="/mypage/profile/{{ auth()->user()->id }}" method="get">
        @csrf
        <input class="profile-form__btn" type="submit" value="プロフィールを編集">
    </form>
    <div class="toppage-list">
        <div class="listeditem">
            <h3>出品した商品</h3>
        </div>
        <a class="boughtitem" href="/mypage/buy">
            <h3>購入した商品</h3>
        </a>
    </div>
    <div class="products-form">
        <div class="products-row">
            @foreach ($listedItems as $item)
            <div class="products-card">
                <a href="/item/{{ $item['id'] }}">
                    <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="products-image">
                </a>
                <div class="item-name">{{ $item->name }}</div>

            </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $listedItems->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
</div>
@endsection