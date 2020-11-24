@extends('layouts.main')

@section('content')
<div class="container">
  <h2>ข้อมูลเบื้องต้นร้านค้าของแม่ค้ามือใหม่</h2>
  <div class="py-2 bd-highlight">
    <div class="my-1">
      <img id="preImg" name="preImg" src="{{ asset('storage/pictures/icon/default_store.png') }}" width="150" height="150">
    </div>
  </div>

  <form class="col-8 mb-3" enctype="multipart/form-data" action="{{ route('stores.store') }}" method="POST">
    @csrf
    <div>
      <label class="btn btn-info" for="inpImg">เลือกรูปร้านค้าของคุณ</label>
      <input hidden type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
    </div>
    <div class="form-group">
      <div class="form-inline">
        <label for="name">ชื่อร้านค้า &nbsp</label>
        <small class="form-text text-warning">***</small>
      </div>
      <input id="storeName" type="text" class="form-control" name="storeName">
    </div>

    <div class="form-group">
      <div class="form-inline">
        <label for="name">เลขบัญชีธนาคาร &nbsp</label>
      </div>
      <input id="bankId" type="text" class="form-control" name="bankId">
    </div>

    <div class="form-group">
      <div class="form-inline">
        <label for="name">เบอร์โทรศัพท์ &nbsp</label>
      </div>
      <input id="storeTel" type="text" class="form-control" name="storeTel">
    </div>

    <div class="form-group">
      <div class="form-inline">
        <label for="name">คำอธิบายร้านค้า &nbsp</label>
        <small class="form-text text-warning">***</small>
      </div>
      <textarea id="storeDes" type="text" class="form-control" name="storeDes">{{old('storeDes')}}</textarea>
    </div>

    <div style="text-align: center">
      <button type="submit" class="btn btn-success" style="">สร้างร้านค้า</button>
    </div>
  </form>
</div>
@endsection

@section('script')
<script src="{{ asset('storage/js/previewInpImg.js') }}"></script>
@endsection
