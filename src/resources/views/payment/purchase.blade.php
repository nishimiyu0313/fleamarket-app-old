@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="purchase">
    <div class="product-content">
        <div class="product-info">
            <div class="product-card">
                <img src="{{ '/storage/' . ($item['image'] ?? 'noimage.png') }}" alt="商品画像" class="product-image">
            </div>

            <div class="productc-detail">
                <p class="product-name">{{ $item->name }}</p>
                <p class="product-price">￥{{ $item->price }}</p>
            </div>
        </div>

        <div class="product-pay">
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
            <form class="purchase-form" action="/purchase/address/{{ $item['id'] }}" method="get" novalidate>
                @csrf
                <input class="purchase_btn " type="submit" value="変更する">
            </form>
        </div>
    </div>
    <div class="product-confirm">
        <div class="product-edit">
            <p class="charge"><strong>商品代金</strong></p>
            <p class="pay"><strong>支払い方法</strong></p>
        </div>
        <input class="purchase-form__btn" type="submit" value="購入する">
    </div>
</div>


</div>
@endsection