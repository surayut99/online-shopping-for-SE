@extends('layouts.main')

@section('content')
<div class="bg-lr form-auth">
  <div class="container p-4" style="font-family: 'Bai Jamjuree', sans-serif; width: 50vw; background-color: rgba(0,0,0,.5); color: white; border-radius: 30px">
    <h1 style="text-align: center; padding-top: 30px">เข้าสู่ระบบ</h1>

    {{-- @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
      {{ session('status') }}
  </div>
  @endif --}}

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group" style="margin-top: 10px">
      <label for="email">อีเมล</label>
      <input id="email" name="email" type="email" class="form-control" placeholder="อีเมล" :value="old('email')" required autofocus>
      <small class="form-text text-muted"></small>
    </div>

    <div class="form-group" style="margin-top: 20px">
      <label for="password">รหัสผ่าน</label>
      <input id="password" name="password" type="password" class="form-control" placeholder="รหัสผ่าน" required>
    </div>

    <div class="block mt-4">
      <label for="remember_me" class="flex items-center">
        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
        <span class="ml-2 text-sm text-warning">จดจำฉันในครั้งต่อไป</span>
      </label>
    </div>

    <div>
      <button class="btn btn-primary">เข้าสู่ระบบ</button>
    </div>

    <hr style="background-color: white">

    <div style="text-align: right">
      @if (Route::has('password.request'))
      <div style="margin-top: 10px">
        <a href="{{ route('password.request') }}">ลืมรหัสผ่าน</a>
      </div>
      @endif
    </div>

  </form>
</div>
@endsection
