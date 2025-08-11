@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail-content">
    <div class="product-card">
        <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="product-image">
    </div>
    <div class="product-info">
        <p class="product-name">{{ $item->name }}</p>
        <p class="product-brand">{{ $item->brand_name }}</p>
        <p class="product-price">￥{{ $item->price }}（税込）</p>

        <div class="product-icon">
            @if (Auth::check() && $item->likedUsers->contains(Auth::user()))
            <form method="POST" action="/item/{{ $item['id'] }}/unlike" novalidate>
                @csrf
                @method('DELETE')
                <button type="submit" class="unlike-submit">★</button>
            </form>
            @else
            <form method="POST" action="/item/{{ $item['id'] }}/like" novalidate>
                @csrf
                <button type="submit" class="like-submit">☆</button>
            </form>
            @endif

            <div class="comment-box">
                <span class="comment-icon">💬</span>
                <span class="comment-number">{{ $item->comments_count }}</span>
            </div>
        </div>
        <form class="purchase-form" action="/purchase/{{ $item['id'] }}" method="post" novalidate>
            @csrf
            <input class="purchase_btn " type="submit" value="購入手続きへ">
        </form>
        <div class="product-description">
            <h3>商品説明</h3>
            <p>{{ $item->description }}</p>
        </div>
        <div class="product-details">
            <h3>商品の情報</h3>
            <dl>
                <p><strong>カテゴリー</strong></p>
                <p><strong>商品の状態</strong>{{ $item->condition->content }}</p>
            </dl>
        </div>
        <div class="comment-section">
            <h2 class="comment-heading">コメント({{ $item->comments_count }})</h2>
            @foreach($item->comments as $comment)

            <div class="comment-list">

                <div class="comment-item">
                    <div class="comment-user">
                        <img src="" class="user-icon">
                        <span class="user-name"></span>
                    </div>
                    <div class="comment-view">
                        <p class="comment-content">{{ $comment->content }}</p>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        <div class="comment-form-section">
            <h3>商品へのコメント</h3>
            @auth
            <form action="/item/{{ $item['id'] }}/comments" method="post" novalidate>
                @csrf
                <textarea class="form-control" name="content" rows="10" cols="70" required>
                    </textarea>
                <input class="purchase_btn" type="submit" value="コメントを送信する">
            </form>
            @endauth
        </div>




    </div>


</div>
@endsection