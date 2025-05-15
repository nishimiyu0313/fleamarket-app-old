@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="heading">
    <a href="/">おすすめ</a>
    @foreach ($items as $item)
    <div class="item-card">
        <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="item-image">
        <p>{{ $item->name }}</p>
    </div>
    @endforeach
    <a href="/?page=mylist">マイリスト</a>
</div>
@endsection