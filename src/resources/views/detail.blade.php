@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail">
    <div class="item-card">
        
    </div>
    <h2>

    <form class="purchase-form" action="" >
        @csrf
        <input class="purchase_btn " type="submit" value="購入手続きへ">
    </form>


@endsection