@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="heading">
    <h3>おすすめ</h3>
    <h3>マイリスト</h3>
    <div class="item-list">
        @foreach ($items as $item)
        <div class="item-card">
            <a href="/item/{{ $item['id'] }}">
                <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="item-image">
            </a>
            <div class="item-name">{{ $item->name }}</div>

        </div>
        @endforeach
    </div>
</div>
<div class="pagination">
    {{ $items->links('vendor.pagination.semantic-ui') }}
</div>
@endsection