@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profilebuy.css') }}">
@endsection

@section('content')
<div class="content">
    <form class="profile-form" action="/mypage/profile/{{ auth()->user()->id }}" method="get">
        @csrf
        <input class="profile-form__btn" type="submit" value="プロフィールを編集">
    </form>
    <div class="toppage-list">
        <a class="listeditem" href="/mypage/sell">
            <h3>出品した商品</h3>
        </a>
        <div class="boughtitem">
            <h3>購入した商品</h3>
        </div>
    </div>
</div>
@endsection