@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="heading">
    <a href="/">おすすめ</a>
    <div class="item-list">
        @foreach ($items as $item)
        <div class="item-card">
            <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="item-image">
            <p>{{ $item->name }}</p>
        </div>
        @endforeach
    </div>
    <a href="/?page=mylist">マイリスト</a>
</div>
<div class="pagination">
    {{ $items->links('vendor.pagination.semantic-ui') }}
</div>
@endsection