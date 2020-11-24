@extends('layouts.main')

@section('content')
<div class="container mt-5">
  <h1>แก้ไขร้านค้า</h1>
  <div>
    <form enctype="multipart/form-data" action="{{route('stores.update',['store'=>$store->store_id])}}" method="post">
      @method('put')
      @csrf
      <div class="card ">
        <div class="row no-gutters">
          <div class="col-md-2 m-4 text-center">
            <img id="preImg" name="preImg" src="{{ asset($store->store_img_path) }}" width="150" height="150">
            <hr>
            <div>
              <h4 class="mt-4">เลือกรูปร้านค้า</h4>
              <label for="inpImg" class="btn btn-outline-info mt-1 ml-2">เลือกไฟล์รูปภาพ</label>
              <input hidden type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
            </div>
          </div>
          <div class="col-md-9">
            <div class="card-body">
              <div class="form-row">
                <div class="form-group">
                  <h4>ชื่อร้านค้า:</h4>
                  <input value="{{old('store_name',$store->store_name)}}" name="store_name" class="form-control col mr-4  @error('store_name') is-invalid @enderror" style="width:395px">
                  @error('store_name')
                  <p class="text-danger mt-2">{{$message}}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <h4>เบอร์โทรติดต่อ: </h4>
                  <input value="{{old('store_tel',$store->store_tel)}}" name="store_tel" class="form-control col  @error('store_tel') is-invalid @enderror" style="width:380px">
                  @error('store_tel')
                  <p class="text-danger mt-2">{{$message}}</p>
                  @enderror
                </div>
                <div class="form-row">
                  <div class="form-group mr-4">
                    <h4>ธนาคาร:</h4>
                    <select name="store_bank_name" id="" class="form-control">
                      @foreach($banks as $bank)
                      @if($bank==$store->store_bank_name)
                      <option value="{{$bank}}" selected='selected'>{{$bank}}</option>
                      @endif
                      <option value="{{$bank}}">{{$bank}}</option>
                      @endforeach
                    </select>
                    @error('store_bank_name')
                    <p class="text-danger mt-2">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <h4>หมายเลขบัญชีธนาคาร:</h4>
                    <input value="{{old('store_bank',$store->store_bank_number)}}" name="store_bank_number" class="form-control col @error('store_bank_number') is-invalid @enderror" style="width:380px">
                    @error('store_bank_number')
                    <p class="text-danger mt-2">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group">
                    <h4>คำอธิบายร้านค้า: </h4>
                    <textarea name="store_description" class="form-control col-md-8  @error('store_description') is-invalid @enderror" style="width:1210px">{{old('store_description',$store->store_description)}}</textarea>
                    @error('store_description')
                    <p class="text-danger mt-2">{{$message}}</p>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-right">
        <button style="" class="btn btn-success mt-2 mb-2" type="submit">ยืนยันการแก้ไข</button>
      </div>
  </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('storage/js/editProfile.js') }}"></script>
<script src="{{ asset('storage/js/previewInpImg.js') }}"></script>
@endsection
