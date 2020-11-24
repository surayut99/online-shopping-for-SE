@extends('layouts.main_profile')

@section('content')
<x-guest-layout>
  <div class="bg-lr" style="padding-top: 120px">
    <div class="container p-4" style="font-family: 'Bai Jamjuree', sans-serif; width: 50vw; background-color: rgba(0,0,0,.5); color: white; border-radius: 30px">
      <h1 style="text-align: center; padding-top: 30px">ลงทะเบียนเพื่อสมัครร้านค้า</h1>

      <x-jet-validation-errors class="mb-4" />

      <form action="{{ route('seller_register') }}" method="POST">
        @csrf

        <div class="form-group">
          <div class="form-inline">
            <label for="name">ชื่อผู้ใช้ &nbsp;</label>
            <small class="form-text text-warning">***</small>
          </div>
          <input required id="name" type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
          <div class="form-inline">
            <label for="name-shop">ชื่อร้านค้า &nbsp;</label>
            <small class="form-text text-warning">***</small>
          </div>
          <input required id="name" type="text" class="form-control" name="name-shop">
        </div>

        <div class="form-group">
          <div class="form-inline">
            <label for="email">อีเมล &nbsp;</label>
            <small class="form-text text-warning">***</small>
          </div>
          <input required type="email" class="form-control" name="email">
        </div>

        <div class="form-group" style="margin-top: 20px">
          <div class="form-inline">
            <label for="telephone">เบอร์โทรศัพท์ &nbsp;</label>
            <small class="form-text text-warning">***</small>
          </div>
          <input required id="telephone" type="text" class="form-control" name="telephone">
        </div>

        <div style="text-align: center">
          <button type="submit" class="btn btn-success">ลงทะเบียน</button>
        </div>

      </form>
    </div>
  </div>
</x-guest-layout>
@endsection
