@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profilebuy.css') }}">
@endsection

@section('content')
<div class="heading">
    <div class="heading__inner">
        <div class="user_image">
            <a href="">

            </a>
        </div>
        <div class="user_name">

        </div>
    </div>
    <form class="profile-form">
        <input class="profile-form__btn" type="submit" value="プロフィールを編集">
    </form>
    <div class="item__list">
        <div class="heading">
            <h3>購入した商品</h3>
            <h3>出品した商品</h3>
            @endsection