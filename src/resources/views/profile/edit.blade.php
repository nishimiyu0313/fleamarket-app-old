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
        <form class="form" action="/mypage/profile" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profile__image">
                <img src=" {{ isset($profile['image']) ? asset('storage/' . $profile['image']) : asset('default.png') }}" alt="アイコン画像"
                    class="profile-image">
                <label class="image" for="image">画像を選択する</label>
                <input type="file" name="image" id="image">

            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">ユーザー名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="name" value="{{ old('name') }}" />
                    </div>
                    <div class="form__error">

                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">郵便番号</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="postal_code" value="{{ old('postal_code', $user->profile->postal_code ?? '') }}" />
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
                        <input type="text" name="address" value="{{ old('address', $user->profile->address ?? '') }}" />
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
                        <input type="text" name="building" value="{{ old('building', $user->profile->building ?? '') }}" />
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