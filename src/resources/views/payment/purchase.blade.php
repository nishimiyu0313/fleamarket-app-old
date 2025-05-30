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
        <h3>配送先</h3>
        @endsection