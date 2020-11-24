@extends('layouts.main')
@section('content')
<div style="padding: 90px;">
    <div class="container" style="margin-top: 100px; font-family: 'Bai Jamjuree', sans-serif; ">
        <div>
            <form enctype="multipart/form-data" action="{{route('products.update',['product'=>$product->product_id])}}" METHOD="POST">
                @method('PUT')
                @csrf
                <div class="col-md-2 m-4 text-center">
                    <img id="preImg" name="preImg" src="{{ asset($product->product_img_path) }}" width="150" height="150">
                    <hr>
                    <div>
                        <h4 class="mt-4">แก้ไขรูปภาพสินค้า</h4>
                        <label for="inpImg" class="btn btn-outline-info mt-1 ml-2">เลือกไฟล์รูปภาพ</label>
                        <input hidden type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputEmail4">ชื่อสินค้า:</label>
                        <input value="{{old('productName', $product->product_name)}}" class="form-control @error('productName') is-invalid @enderror" id="productName" name="productName" placeholder="ชื่อสินค้า">
                        @error('productName')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">จำนวนสินค้า:</label>
                        <input value="{{old('qty', $product->qty)}}" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" placeholder="จำนวนสินค้า">
                        @error('qty')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">ราคาสินค้า(บาท/ชิ้น):</label>
                        <input value="{{old('price', $product->price)}}" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="ราคาสินค้า">
                        @error('price')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">ไซซ์:</label>
                        <input value="{{old('size', $product->size)}}" class="form-control @error('size') is-invalid @enderror" id="size" name="size" placeholder="ไซซ์">
                        @error('size')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputPassword4">สี:</label>
                        <input value="{{old('color', $product->color)}}" class="form-control @error('color') is-invalid @enderror" id="color" name="color" placeholder="สี">
                        @error('color')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCity">หมวดหมวดหมู่สินค้า</label>
                        <select id="primeProdType" name="primeProdType" class="form-control">
                            <option id="select" name="select">
                                @foreach($product_type as $type)
                                @if($type->product_primary_type != $product->product_primary_type)
                            <option value="{{$type->product_primary_type}}">{{ $type->product_primary_type }}</option>
                            @else
                            <option selected value="{{$type->product_primary_type}}">{{ $type->product_primary_type }}</option>
                            @endif
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputState">หมวดหมู่สินค้าย่อย</label>
                        <select id="secondProdType" name="secondProdType" class="form-control">
                            <option id="select" name="select">
                                @foreach($secondary_types as $type){
                                @if($type->product_secondary_type != $product->product_secondary_type)
                            <option value="{{$type->product_secondary_type}}">{{ $type->product_secondary_type }}</option>
                            @else
                            <option selected value="{{$type->product_secondary_type}}">{{ $type->product_secondary_type }}</option>
                            @endif
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="inputAddress">รายละเอียดสินค้า: </label>
                    <input value="{{old('productDes', $product->product_description)}}" class="form-control @error('productDes') is-invalid @enderror" id="productDes" name="productDes">
                    @error('productDes')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">ยืนยันการแก้ไข</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('storage/js/editProfile.js') }}"></script>
<script src="{{ asset('storage/js/previewInpImg.js') }}"></script>
<script src="{{ asset('storage/js/selectproducttype.js') }}"></script>
@endsection
