@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css')}}">
@endsection

@section('content')
<div class="address-form__content">
    <div class="form-group__content">
        <div class="address-form__heading">
            <h2>住所の変更</h2>
        </div>
        <form class="form" action="/purchase/address/{{ $item['id'] }}" method=" post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">郵便番号</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="postal_code" value="{{ old('postal_code') }}" />
                        
                    </div>
                    <div class="form__error">

                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" value="{{ old('address') }}" />
                        
                    </div>
                    <div class="form__error">

                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" value="{{ old('building') }}" />
                        

                    </div>
                    <div class="form__error">

                    </div>
                </div>
            </div>

            <input class="profile-form__btn" type="submit" value="更新する">
        </form>
    </div>
</div>
@endsection