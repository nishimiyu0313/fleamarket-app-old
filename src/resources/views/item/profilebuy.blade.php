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

    <form class="profile-form" action="/mypage/profile/{{ auth()->user()->id }}" method="get">
        @csrf
        <input class="profile-form__btn" type="submit" value="プロフィールを編集">

    </form>
</div>
<div class="heading_name">
    <a class="listeditem" href="/mypage/sell">
        <h3>出品した商品</h3>
    </a>
    <div class="boughtitem">
        <h3>購入した商品</h3>
    </div>
</div>
<div class="item-list">

    @if(isset($boughtItems) && count($boughtItems) > 0)
    @foreach ($boughtItems as $item)
    <div class="item-card">
        <a href="/item/{{ $item['id'] }}">
        <img src="{{ '/storage/' . $item['image'] }}" alt=" 商品画像" class="item-image">
        </a>
        <div class="item-name">{{ $item->name }}</div>
</div>
@endforeach
</div>

<div class="pagination">
    {{ $boughtItems->links('vendor.pagination.semantic-ui') }}
</div>
</div>
@else
<p>購入済み商品はありません。</p>
@endif

@endsection