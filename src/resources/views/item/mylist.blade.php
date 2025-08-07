@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mylist.css') }}">
@endsection

@section('content')
<div class="mylist-content">
    <div class="toppage-list">
        <a class="recommend" href="/">
            <h3>おすすめ</h3>
        </a>
        <div class="mylist">
            <h3>マイリスト</h3>
        </div>
    </div>
    <div class="products-form">
        <div class="products-row">
            @foreach ($favoriteItems as $item)
            <div class="products-card">
                <a href="/item/{{ $item['id'] }}">
                    <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="products-image">
                </a>
                <div class="item-name">{{ $item->name }}</div>

            </div>
            @endforeach

        </div>
        <div class="pagination">
            {{ $favoriteItems->links('vendor.pagination.semantic-ui') }}
        </div>
    </div>
</div>
@endsection