@extends('layouts.main')
@section('content')
<div class="container mb-2">
  <div>
    <hr>
    <h1>เพิ่มรายการสินค้า</h1>
    <form action="{{ route('products.store')}}" METHOD="POST" enctype="multipart/form-data">
      @csrf
      <div class="my-1">
        <img id="preImg" name="preImg" src="" height="150">
      </div>
      <div class="my-1">
        <label>รูปสินค้า:</label>
        <br>
        <label class="btn btn-outline-info" for="inpImg">เลือกรูปภาพสินค้า</label>
        <input hidden type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
        @error('inpImg')
        <div class="mt-2">
          <p class="text-danger">กรุณาใส่รูปสินค้า</p>
        </div>
        @enderror
      </div>

      <div class="form-row">

        <div class="form-group col-md-8">
          <label for="inputEmail4">ชื่อสินค้า:</label>
          <input class="form-control" id="productName" name="productName" placeholder="ชื่อสินค้า" value="{{old('productName')}}">
          @error('productName')
          <p class="text-danger">กรุณาระบุชื่อสินค้า</p>
          @enderror
        </div>

        <br>

        <div class="form-group col-md-2">
          <label for="inputPassword4">จำนวนสินค้า:</label>
          <input class="form-control" id="qty" name="qty" placeholder="จำนวนสินค้า" value="{{old('qty')}}">
          @error('qty')
          <p class="text-danger">กรุณาระบุจำนวนสินค้า</p>
          @enderror
        </div>

        <div class="form-group col-md-2">
          <label for="inputPassword4">ราคาสินค้า(บาท/ชิ้น):</label>
          <input class="form-control" id="price" name="price" placeholder="ราคาสินค้า" value="{{old('price')}}">
          @error('price')
          <p class="text-danger">กรุณาระบุราคาสินค้า</p>
          @enderror
        </div>

        <div class="form-group col-md-2">
          <label for="inputPassword4">สี:</label>
          <input class="form-control" id="color" name="color" placeholder="สี" value="{{old('color')}}">
          @error('color')
          <p class="text-danger">กรุณาระบุสีสินค้า</p>
          @enderror
        </div>

        <div class="form-group col-md-2">
          <label for="inputPassword4">ไซซ์:</label>
          <input class="form-control" id="size" name="size" placeholder="ไซซ์" value="{{old('size')}}">
          @error('size')
          <p class="text-danger">กรุณาระบุขนาดของสินค้า</p>
          @enderror
        </div>

      </div>

      <div class="form-row">
        <div class="form-group col-md-5">
          <label for="inputCity">หมวดหมวดหมู่สินค้า</label>
          <select id="primeProdType" name="primeProdType" class="form-control">
            @foreach($product_type as $type){
            <option name="primeProdType" value="{{$type}}">{{ $type}}</option>
            @endforeach
          </select>

        </div>
        <div class="form-group col-md-5">
          <label for="inputState">หมวดหมู่สินค้าย่อย</label>
          <select id="secondProdType" name="secondProdType" class="form-control">
            @foreach($secondary_type as $type)
            <option name="secondProdType" value="{{$type}}">{{ $type}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="inputAddress">รายละเอียดสินค้า: </label>
        <textarea class="form-control" id="productDes" name="productDes">{{old('productDes')}}</textarea>
        @error('productDes')
        <p class="text-danger">กรุณาระบุรายละเอียดสินค้า</p>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary">เพิ่มรายการสินค้า</button>

    </form>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/selectproducttype.js')}}"></script>
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
@endsection
