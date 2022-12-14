@extends ('layouts.admin-header')
@section ('admin-header')
<div class="register">
  <p class="register__ttl">会員登録</p>
  <form action="/admin/register" method="post">
    @csrf
    <div class="register__content">
      <table class="register__inner">
        <tr>
          <td class="register__content-ttl">名前</td>
          <td class="register__content-item">
            @error('name')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="name" value="{{ old('name') }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">メールアドレス</td>
          <td class="register__content-item">
            @error('email')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="text" name="email" value="{{ old('email') }}">
          </td>
        </tr>
        <tr>
          <td class="register__content-ttl">パスワード</td>
          <td class="register__content-item">
            @error('password')
            <p class="register__content-error">{{ $message }}</p>
            @enderror
            <input type="password" name="password">
          </td>
        </tr>
      </table>
    </div>
    <div class="register__btn">
      <button class="register__btn-form" type="submit">登録する</button>
    </div>
  </form>
</div>
@endsection
