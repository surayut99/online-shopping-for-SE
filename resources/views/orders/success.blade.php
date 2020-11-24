@extends('layouts.main')

@section('content')
<div class="container mt-5">
  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h1 class="text-success font-weight-bold">บันทึกรายการสั่งซื้อสำเร็จ</h1>
  </div>

  @php
  $store_id = -1;
  $eachOrder = 0;
  $total = 0;
  @endphp

  <div class="bg-light py-md-3 px-md-5 mb-3">
    <h3 class="font-weight-bold">รานการสินค้า</h3>
    @foreach($orders as $order)

    @if($store_id != $order->store_id)
    @if($eachOrder)
    <br>
    <h5>ราคารวมทั้งหมด: {{$eachOrder}} บาท</h5>

    @php
    $eachOrder = 0;
    @endphp
    @endif
    <hr>
    <h5>{{$order->store_name}}</h5>

    @php
    $store_id = $order->store_id;
    @endphp

    @endif
    <div class="form row col space-checkout space-right">
      <h6 class="shrink-text">{{$order->product_name}}</h6>
      <h6>ราคาต่อชิ้น: {{$order->price}} บาท</h6>
      <h6>จำนวน: {{$order->qty}} ชิ้น</h6>
      <h6>รวม: {{$order->qty * $order->price}} บาท</h6>
      @php
      $eachOrder += $order->qty * $order->price;
      $total += $eachOrder;
      $prev = $order
      @endphp
    </div>
    @endforeach
    <br>
    <h5>ราคารวมทั้งหมด: {{$eachOrder}} บาท</h5>
  </div>

  <div class="text-right bg-light py-md-3 px-md-5 mb-3">
    <h5>ราคารวมทุกออร์เดอร์: {{$total}} บาท</h5>
  </div>
  <div class="text-center">
    <a class="btn btn-success" href="{{route('profile')}}">ดูรายการสั่งซื้อของฉัน</a>
  </div>
</div>

@endsection
