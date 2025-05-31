@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<div class="purchase">
    <div class="item-card">
        <img src="" alt=" 商品画像" class="item-image">
    </div>
    <div class="item-info">
        <h2></h2>
        <h3>（税込）</h3>

        <h3>支払い方法</h3>
        <div class="purchase-form__select-inner">
            <select class="contact-form__select">
                <option disabled selected>選択してください</option>
                <option value="convenience_store">コンビニ支払い</option>
                <option value="credit_card">カード支払い</option>
            </select>
            <div class="address">
            <h3>配送先</h3>
            <a class="change-address" href="/purchase/address/{item_id}">
                変更する
            </a>
            </div>
            <input class="purchase-form__btn" type="submit" value="購入する">
        </div>
    </div>
</div>
@endsection