@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="purchase">
    <div class="item-info">
        <div class="item-card">
            <img src="{{ '/storage/' . ($item['image'] ?? 'noimage.png') }}" alt="商品画像" class="item-image">
        </div>

        <div class="item-detail">
            <h2>{{ $item->name }}</h2>
            <h3>￥{{ $item->price }}</h3>
        </div>
    </div>

    <div class="item-pay">
        <h3>支払い方法</h3>
        <div class="purchase-form__select-inner">
            <select class="contact-form__select">
                <option disabled selected>選択してください ▼</option>
                <option value="convenience_store">コンビニ支払い</option>
                <option value="credit_card">カード支払い</option>
            </select>
        </div>
    </div>
    <div class="address">
        <h3>配送先</h3>
        <a class="change-address" href="/purchase/address/{{ $item['id'] }}">
            変更する
        </a>
        <form class="purchase-form" action="/purchase/address/{{ $item['id'] }}" method="get">
            @csrf
            <input class="purchase_btn " type="submit" value="変更する">
        </form>
    </div>
    <input class="purchase-form__btn" type="submit" value="購入する">
</div>

</div>
@endsection