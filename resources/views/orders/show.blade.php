@extends('layouts.main')

@section( 'content')
<div class="container my-5">
  <h1>รายละเอียดรายการสั่งซื้อสินค้า</h1>

  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h3 class="font-weight-bold">หมายเลขสั่งซื้อที่: {{$order->order_id}}</h3>
    <div>
      <div>
        <label class="font-weight-bold">สั่งซื้อเมื่อ: <span class="font-weight-light"> {{$order->created_at}}</span></label>
      </div>
      <div>
        <label class="font-weight-bold">หมดอายุเมื่อ: <span class="font-weight-light"> {{$order->expired_at}}</span></label>
      </div>
    </div>
  </div>

  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h3 class="font-weight-bold">รายการสินค้า</h3>

    @php
    $total = 0;
    @endphp

    @foreach($products as $product)
    <div class="form row col space-checkout space-right">
      <h6 class="shrink-text">{{$product->product_name}}</h6>
      <h6>ราคาต่อชิ้น: {{$product->price}} บาท</h6>
      <h6>จำนวน: {{$product->qty}} ชิ้น</h6>
      <h6>รวม: {{$product->price * $product->qty}} บาท</h6>
      @php
      $total += $product->price * $product->qty;
      @endphp
    </div>
    <hr>
    @endforeach
    <h5>ราคารวมทั้งหมด: {{$total}} บาท</h5>
  </div>

  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h3 class="font-weight-bold">ที่อยู่สำหรับจัดส่ง</h3>
    <div>
      <div>
        <label class="font-weight-bold">ชื่อผู้รับ: <span class="font-weight-light"> {{$order->recv_name}}</span></label>
      </div>
      <div>
        <label class="font-weight-bold">เบอร์โทร: <span class="font-weight-light"> {{$order->recv_tel}}</span></label>
      </div>
      <div>
        <label class="font-weight-bold">ที่อยู่: <span class="font-weight-light"> {{$order->recv_address}}</span></label>
      </div>
    </div>
  </div>

  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h3 class="font-weight-bold">การจัดส่งและการชำระเงิน</h3>
    <div>
      <div>
        <label class="font-weight-bold">รูปแบบการชำระเงิน: <span class="font-weight-light"> {{$order->payment_type}}</span></label>
      </div>
      <div>
        <label class="font-weight-bold">รูปแยยการจัดส่ง: <span class="font-weight-light"> {{$order->shipment_type}}</span></label>
      </div>
      @if($order->status == "deliveried")
      <div>
        <label class="font-weight-bold">หมายเลขพัสดุ: <span class="font-weight-light"> {{$order->track_id}}</span></label>
      </div>
      @endif
    </div>
  </div>

  @if($order->payment_type != "COD" && $payment)
  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h3 class="font-weight-bold">หลักฐานการชำระเงิน</h3>
    <div class="d-flex">
      <div>
        <label class="font-weight-bold">จากธนาคาร: <span class="font-weight-light"> {{$payment->bank_name}}</span></label>
        <br>
        <img src="{{asset($payment->img_path)}}" alt="" style="height:300px">
      </div>

      @if($order->status=='verifying' && $owner->user_id==Auth::user()->id)
      <div class="mt-3">
        <form action="{{route('orders.accept',['order'=>$order->order_id])}}" class="my-3 space-left" method="post">
          @method('put')
          @csrf
          <button class="btn btn-success">ยืนยัน</button>
        </form>

        <form action="{{route('orders.update',['order'=>$order->order_id])}}" class="my-3  space-left" method="post">
          @method('put')
          @csrf
          <div class="mb-2">
            <button class="btn btn-danger">ปฏิเสธ</button>
          </div>
          <textarea name="store_comment" class="@error('store_comment') is-invalid @enderror" id="" cols="30" rows="3" placeholder="ความคิดเห็นในการปฏิเสธการชำระเงิน"></textarea>
          @error('store_comment')
          <br>
          <strong class="text-danger">{{$message}}</strong>
          @enderror
        </form>
      </div>

      @elseif($order->status=='verified' && $owner->user_id==Auth::user()->id)

      <h4 class='text-success mt-2'>ยืนยันการชำระเงินแล้ว</h4>
      <form style="width: 20vw" action="{{route('orders.trackId',['order'=>$order->order_id])}}" class='text-right' method='post'>
        @method('put')
        @csrf
        <input type="text" name="track_id" id="" placeholder="เลขพัสดุ" class="form-control @error('track_id') is-invalid @enderror">
        <button class=" my-2 btn btn-success">บันทึกข้อมูล</button>
        @error('track_id')
        <strong class="text-danger">{{$message}}</strong>
        @enderror
      </form>

      @elseif($order->status=='cancelled')
      <div class="bg-light py-md-3 px-md-5 mb-3">
        <h3 class="font-weight-bold text-danger">รายสั่งซื้อนี้ถูกปฎิเสธ</h3>
        <div>
          <label class="font-weight-bold">เนื่องจาก: <span class="font-weight-light text-wrap"> {{$order->store_comment}}</span></label>
        </div>
        @endif
      </div>
    </div>
    @elseif($order->payment_type == "COD" && $order->status=='verified' && $owner->user_id==Auth::user()->id)
    <div class="bg-light py-md-3 px-md-5 mb-3">
      <h3>กรอกข้อมูลการจัดส่ง</h3>
      <form action="{{route('orders.trackId',['order'=>$order->order_id])}}" class='form-inline space-right' method='post'>
        @method('put')
        @csrf
        <input type="text" name="track_id" id="" placeholder="เลขพัสดุ" class="form-control @error('track_id') is-invalid @enderror">
        <button class=" my-2 btn btn-success">บันทึกข้อมูล</button>
        @error('track_id')
        <strong class="text-danger">{{$message}}</strong>
        @enderror
      </form>
    </div>
    @endif

    @if($order->user_id == Auth::id())
    <form action="{{route('orders.complete', ['order' => $order->order_id])}}" method="POST">
      <button type="submit" class="btn btn-success">ยินยันการได้รับสินค้า</button>
    </form>
    @endif

  </div>
  @endsection
