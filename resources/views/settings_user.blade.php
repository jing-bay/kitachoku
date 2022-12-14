@extends ('layouts.default')
@section ('content')
<div class="register">
  <p class="register__ttl">設定変更</p>
  <div class="register__content">
    <table class="register__inner">
      <form action="/user/update" method="post" id="update_{{ $user->id }}">
        @csrf
        <tr>
          <td class="register__content-ttl">名前</td>
          <td class="register__content-item">
            @error('name')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="name" value="{{ $user->name }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">ニックネーム</td>
          <td class="register__content-item">
            @error('nickname')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="nickname" value="{{ $user->nickname }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">メールアドレス</td>
          <td class="register__content-item">
            @error('email')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="email" value="{{ $user->email }}">
          </td>
        </tr>
      </form>
    </table>
  </div>
  <div class="settings__bottom">
    <div class="settings__btn">
      <button type="submit" form="update_{{ $user->id }}" class="settings__update">変更する</button>
    </div>
    <form action="/user/destroy" method="post" class="settings__btn">
      @csrf
      <button type="submit" class="settings__delete">退会する</button>
    </form>
  </div>
</div>
@endsection