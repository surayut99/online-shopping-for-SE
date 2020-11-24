@extends('layouts.main')

@section('content')
<div class="mt-5 container">
  <h1>ยืนยันการชำระเงิน</h1>
  <div class="card py-3 bg-light">
    <div class="d-flex justify-content-around">
      <form action="{{route('orders.store_payment', ["order" => $order->order_id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-0" style="width: 300px">
          <label class="btn btn-info" for="inpImg">อัพโหลดหลักฐานการชำระเงิน</label>
          <input onchange="previewAvatar()" type="file" accept="image/png, image/jpeg" name="inpImg" id="inpImg" hidden>
          <div>
            @error('inpImg')
            <strong class="text-danger">{{$message}}</strong>
            @enderror
          </div>
        </div>
        <div class="form-group">
          <label>ธนาคาร: </label>
          <input value="{{old('bank_name')}}" placeholder="ชื่อธนาคาร" type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror @if(Session::has('oldImgpath')) is-invalid @endif">
          @error('bank_name')
          <strong class="text-danger">{{$message}}</strong>
          @enderror
          @if(Session::has('oldImgpath'))
          <strong class="text-danger">กรุณากรอกชื่อธนาคารที่ใช้ในการชำระเงิน</strong>
          @endif
        </div>
        <div class="form-group">
          <img src="@if(Session::has('oldImgpath')) {{request()->getSchemeAndHttpHost()}}/{{Session::get('oldImgpath')}} @endif" id="preImg" style="max-height: 300px" alt="">
        </div>

        @php
        $oldImgPath = null
        @endphp

        @if($oldImgPath)
        <h1>HELLO</h1>
        @endif

        <button type="submit" class="btn btn-success">อัพโหลด</button>
      </form>

      <div class="py-1">

        <table>
          <tbody>
            <tr>
              <td>หมายดลขคำสั่งซื้อ </td>
              <td>{{$order->order_id}}</td>
            </tr>
            <tr>
              <td>สั่งซื้อเมื่อ </td>
              <td>{{$order->created_at}}</td>
            </tr>
            <tr>
              <td>สิ้นสุดการชำระเมื่อ </td>
              <td>{{$order->expired_at}}</td>
            </tr>
          </tbody>
        </table>

        <hr>

        <div class="space-bottom overflow-v">
          @foreach($products as $product)
          <div class="d-flex space-right" style="height: 100px">
            <img src="{{asset($product->product_img_path)}}" alt="" style="width: 100px">
            <div class="space-left">
              <h6 class="shrink-text">{{$product->product_name}}</h6>
              <h6>จำนวน {{$product->qty}} ชิ้น</h6>
              <h6>ราคาต่อหน่วย {{$product->price}} บาท</h6>
              <h6>รวม {{$product->price * $product->qty}} บาท</h6>

              @php
              $total += $product->price * $product->qty
              @endphp

            </div>

          </div>
          @endforeach
        </div>
        <hr>
        <h3>รวมทั้งหมด {{$total}} บาท</h3>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/previewInpImg.js')}}"></script>
@endsection
