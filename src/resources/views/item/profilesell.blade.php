@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profilesell.css') }}">
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
</div>
<div class="heading_name">
    <div class="listeditem">
        <h3>出品した商品</h3>
    </div>
    <a class="boughtitem" href="/mypage/buy">
        <h3>購入した商品</h3>
    </a>
</div>
<div>
    <div class="item-list">
        @foreach ($listedItems as $item)
        <div class="item-card">
            <a href="/item/{{ $item['id'] }}">
                <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="item-image">
            </a>
            <div class="item-name">{{ $item->name }}</div>

        </div>
        @endforeach
    </div>


    <div class="pagination">
        {{ $listedItems->links('vendor.pagination.semantic-ui') }}
    </div>



    @endsection