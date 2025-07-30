@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-form__content">
    <div class="form-group__content">
        <div class="sell-form__heading">
            <h1>商品の出品</h1>
        </div>
        <form class="form" action="/sell" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="contact-form__group">
                <div class="form__group-title">
                    <span class="form__label--item">商品画像</span>
                </div>
                <input type="file" name="image" id="image" required>

                <div class="item-info">
                 
                    <h3>カテゴリー</h3>

                   
                    <div class="contact-form__group">
                        <div class="form__group-title">
                            <span class="form__label--item">商品の状態</span>
                        </div>
                        <div class="contact-form__select-inner">
                            <select class="contact-form__select" name="condition_id" id="condition" required>
                                <option disabled selected>選択してください</option>
                                @foreach($conditions as $condition)
                                <option value="{{ $condition->id }}">{{ $condition->content }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h2>商品名と説明</h2>

                        <div class="form__group">
                            <div class="form__group-title">
                                <span class="form__label--item">商品名</span>
                            </div>
                            <div class="sell-form__name-inputs">
                                <input class="sell-form__input contact-form__name-input" type="text" name="name" id="name"
                                    value="{{ old('name') }}">

                            </div>
                            <div class="register-form__error-message">

                            </div>
                        </div>

                        <div class="form__group">
                            <div class="form__group-title">
                                <span class="form__label--item">ブランド名</span>
                            </div>
                            <div class="sell-form__name-inputs">
                                <input class="sell-form__input contact-form__name-input" type="text" name="brand_name" id="brand_name"
                                    value="{{ old('brand_name') }}">

                            </div>
                            <div class="register-form__error-message">

                            </div>
                        </div>

                        <div class="form__group">
                            <div class="form__group-title">
                                <span class="form__label--item">商品の説明</span>
                            </div>
                            <div class="sell-form__name-inputs">
                                <textarea class="sell-form__input contact-form__name-input" type="textarea" name="description" id="description"
                                    value="{{ old('description') }}"></textarea>

                            </div>
                            <div class="register-form__error-message">

                            </div>
                        </div>


                        <div class="form__group">
                            <div class="form__group-title">
                                <span class="form__label--item">販売価格</span>
                            </div>
                            <div class="sell-form__name-inputs">
                                <input class="sell-form__input contact-form__name-input" type="text" name="price" id="price"
                                    value="{{ old('price') }}">

                            </div>
                            <div class="register-form__error-message">

                            </div>

                        </div>

                        <input class="sell-form__btn" type="submit" value="出品する">
                    </div>
                </div>
            </div>
        </form>

    </div>
    @endsection










</div>
</div>