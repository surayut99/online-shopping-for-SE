@extends('layouts.main')
@section('content')

<div class="container mt-5">
  <div class="d-flex">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <h2>รถเข็นของคุณ</h2>
    <a class="btn btn-success ml-3" style="height:40px" href="{{route('products.index')}}">เลือกสินค้าต่อ</a>
  </div>

  <div class="d-flex">
    <div style="width:800px;" style="overflow-y: auto; height: 80vh">
      <hr>
      @if($carts->first())
      @foreach($carts as $cart)
      <div class="d-flex" style="height:120px;top: 50%;">
        <div style="width:80px;">
          <img class="btn" src="{{$cart->product_img_path}}" style="width:80px;">
        </div>
        <div style="width:300px;">
          <h4 style="font-weight: bold;white-space: nowrap;width: 300px;overflow: hidden;text-overflow: ellipsis;padding-top:5px;" class="ml-3 pb-2">
            {{$cart->product_name}}
          </h4>
          <p class="ml-3 mb-1" style="font-size:16px;color:blue;font-weight: bold;">
            ประเภท: {{$cart->product_primary_type}} สี: {{$cart->color}}
          </p>
          <p class="ml-3 mb-1" style="font-size:14px;color:red;font-weight: bold;">
            @if($cart->amount==0) สินค้าหมด
            @else คงเหลือ: {{$cart->qty}} ชิ้น
            @endif
          </p>
        </div>
        <div style="width:150px;padding-left:10px">
          <h2 id='price{{$cart->product_id}}' style="color:#ff1e00;" class="pt-3">฿{{$cart->price}}</h2>
        </div>
        <div style="width:150px;">
          <div class="input-group number-spinner pt-3">
            <div class="d-flex pt-2">
              <button type="submit" name="{{$cart->product_id}}" style="font-size: 10px;" class="btn btn-default btn-outline-success" onclick="onClickMinus(event)">-</button>
              <input disabled type="disabled" onkeyup="onKeyUp(event, {{$cart->qty}},{{$cart->product_id}})" name='update' id='{{$cart->product_id}}' max="{{$cart->qty}}" min="1" style="font-size: 20px; width:50%; height:30px" type="text" class="form-control text-center" value="{{$cart->amount}}">
              <button type="submit" name="{{$cart->product_id}}" style="font-size: 10px;" class=" btn btn-default btn-outline-success" onclick="onClickPlus(event,{{$cart->qty}})">+</button>
            </div>
          </div>

        </div>
        <div style="width:200px;padding-top:22px" class="pl-4">
          <form action="{{route("cart.destroy",['id'=>$cart->product_id])}}" method="POST">
            @method('delete')
            @csrf
            <div class="pl-4">
              <button type="submit" class="btn btn-danger" type="button" data-toggle="collapse" data-target="#{{$cart->product_id}}collapseExample" aria-expanded="false" aria-controls="{{$cart->product_id}}collapseExample">ลบ</button>
            </div>
          </form>
        </div>

      </div>
      <hr>
      @endforeach
      @else <p style="padding-left:50px;color:red;"> ไม่มีสินค้าในตระกร้า </p>
      <hr>
      @endif
    </div>

    <div class="d-flex pl-4 ">
      <div class="p-3 pl-2 border border rounded" style="width:300px;">
        <h4>ที่อยู่จัดส่ง</h4>
        @if($address)
        <p style="font-weight: bold;color:blue;" class="mb-0">ชื่อ:</p>
        <p class="mb-1">{{$address->receiver}}</p>
        <p style="font-weight: bold;color:blue;" class="mb-0">เบอร์โทรศัพท์:</p>
        <p class="mb-1">{{$address->telephone}}</p>
        <p style="font-weight: bold;color:blue;" class="mb-0">ที่อยู่:</p>
        <p class="mb-1">{{$address->address}}</p>
        <div class="text-right">
          <a class="mb-1 btn btn-warning" href="{{ route('address.edit', ['address' => $address->no]) }}">แก้ไขที่อยู่ปัจจุบัน</a>
        </div>
        <hr>
        @else
        <div class="text-right">
          <a style="color:red" class="mb-1" href="{{ route('profile') }}">กรุณาเพิ่มที่อยู่จัดส่ง</a>
        </div>
        @endif

        @if(sizeof($carts))
        <div class="text-right">
          <h4 class="pr-1">ราคารวม: {{$sum}} บาท</h4>
          <a href="{{route('orders.create')}}" class="btn btn-primary" style="width:120px">ดำเนินการต่อ</a>
        </div>
        @endif
      </div>
    </div>

  </div>
</div>

@endsection
@section('script')
<script src="{{asset('storage/js/cart.js')}}"></script>
@endsection
