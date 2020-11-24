@extends('layouts.main')

@section('content')
<div class="bg-light" style="min-height: 100vh;font-family: 'Bai Jamjuree', sans-serif; padding-top:100px">
  <div class="container">
    <h1 style="border: 2px ">เพิ่มที่อยู่สำหรับจัดส่ง</h1>

    <div class="bd-highlight">
      <form action="{{ route('address.store') }}" style="width: 30vw" method="POST">
        @csrf
        <div class="form-group">
          <label>ชื่อผู้รับ</label>
          <input class="form-control" @error('new_receiver') is-invalid @enderror type="text" name="new_receiver" id="new_receiver" value="{{ old('new_receiver') }}">

          @error('new_receiver')
          <div class="mt-2 alert alert-danger">{{ $message }}</div>
          @enderror

        </div>

        <div class="form-group">
          <label>เบอร์โทร</label>
          <input class="form-control" @error('new_tel') is-invalid @enderror type="text" name="new_tel" id="new_tel" onkeyup="validateTelNumber(this)" value="{{ old('new_tel') }}">

          @error('new_tel')
          <div class="mt-2 alert alert-danger">{{ $message }}</div>
          @enderror

        </div>

        <div class="form-group">
          <label>ที่อยู่</label>
          <textarea class="form-control" @error('new_address') is-invalid @enderror name="new_address" id="new_address">{{ old('new_address') }}</textarea>

          @error('new_address')
          <div class="mt-2 alert alert-danger">{{ $message }}</div>
          @enderror
        </div>

        <br>
        <button type=submit class="btn btn-primary">บันทึก</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{ asset('storage/js/editProfile.js') }}"></script>
@endsection
