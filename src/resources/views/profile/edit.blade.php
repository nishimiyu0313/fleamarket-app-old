<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtech</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
</head>
<div class="profile-form__content">
    <div class="form-group__content">
        <div class="profile-form__heading">
            <h2>プロフィール設定</h2>
        </div>
        <form class="form" action="/mypage/profile/{{ auth()->user()->id }}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="profile__image">
                <img src=" {{ isset($profile['image']) ? asset('storage/' . $profile['image']) : asset('default.png') }}" alt="アイコン画像"
                    class="profile-icon">
                <label for="image" class="file-button">画像を選択する</label>
                <input type="file" id="image" name="image" class="file-input">
                <div class="form__error">
                    @error('image')
                    {{ $message }}
                    @enderror

                </div>


            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">ユーザー名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" value="{{ $profile->name }}" />
                    </div>
                    <div class=" form__error">
                        @error('name')
                        {{ $message }}
                        @enderror


                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">郵便番号</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="postal_code" value="{{ $profile->postal_code }}" />
                    </div>
                    <div class="form__error">
                        @error('postal_code')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" value="{{ $profile->address }}">
                    </div>
                    <div class="form__error">
                        @error('address')
                        {{ $message }}
                        @enderror


                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" value="{{ $profile->building }}" />
                    </div>
                    <div class="form__error">

                    </div>
                </div>
            </div>

            <input class="profile-form__btn" type="submit" value="更新する">
        </form>
    </div>
</div>

</html>