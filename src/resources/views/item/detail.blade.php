@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail">
    <div class="item-card">
        <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="item-image">
    </div>
    <div class="item-info">
        <h2>{{ $item->name }}</h2>
        <p>{{ $item->brand_name }}</p>
        <h3>￥{{ $item->price }}（税込）</h3>

        @if (Auth::check() && $item->likedUsers->contains(Auth::user()))
        <form method="POST" action="/item/{{ $item['id'] }}/unlike ">
            @csrf
            @method('DELETE')
            <button type="submit">★</button>
        </form>
        @else
        <form method="POST" action="/item/{{ $item['id'] }}/like ">
            @csrf
            <button type="submit">☆</button>
        @endif



            <form class="purchase-form" action="/purchase/{{ $item['id'] }}" method="post">
                @csrf
                <input class="purchase_btn " type="submit" value="購入手続きへ">
            </form>
            <h3>商品説明</h3>
            <p>{{ $item->description }}</p>
            <h3>商品の情報</h3>
            <h4>カテゴリー</h4>
            <h4>商品の状態</h4>


            <form method="post" action="{{ url('/items/' . $item->id . 'comments') }}">
                @csrf
                <label>商品へのコメント</label><br>
                <textarea name="content" rows="3" cols="50" required> {{ old('content') }}</textarea>
                <input class="purchase_btn" type="submit" value="コメントを送信する">
            </form>

    </div>
</div>



@endsection