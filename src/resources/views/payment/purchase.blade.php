@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css')}}">
@endsection

@section('content')
<form class="purchase-form" action="{{ '/purchase/' . $item->id }}" method="post" novalidate>
    @csrf
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
                    <select class="purchase-form__select" name="content" id="content" required>
                        <option value="" disabled selected>選択してください</option>
                        @foreach($payments as $payment)
                        <option value="{{ $payment->content }}">{{ $payment->content }}</option>
                        @endforeach
                    </select>
                </div>

                @error('content')
                <p class="error-message" style="color:red">{{ $message }}</p>
                @enderror


            </div>


            <div class="address">
                <h3>配送先</h3>
                <div class="address-display">
                    @if ($profile)
                    <p>郵便番号：{{ $profile->postal_code }}</p>
                    <p>住所：{{ $profile->address }}</p>
                    <p>建物名：{{ $profile->building }}</p>

                    <input type="hidden" name="postal_code" value="{{ $profile->postal_code }}">
                    <input type="hidden" name="address" value="{{ $profile->address }}">
                    <input type="hidden" name="building" value="{{ $profile->building }}">
                    @else
                    <p>プロフィール情報がありません。</p>
                    @endif


                </div>
                <a href="/purchase/address/{{ $item['id'] }}" class="btn-address">変更する</a>
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
</form>

@endsection