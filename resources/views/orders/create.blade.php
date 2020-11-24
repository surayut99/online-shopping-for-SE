@extends('layouts.main')
@section('content')
<div class="container mt-5">
  <div class="container">
    <div class="bg-light py-md-3 px-md-5 mb-3">
      <h1 class="font-weight-bold">ยืนยันการสั่งซื้อสินค้า</h1>
    </div>

    <div class="bg-light py-md-3 px-md-5 mb-3">
      <h3 class="font-weight-bold">ที่อยู่การจัดส่ง</h3>
      <div>
        <div>
          <label class="font-weight-bold">ชื่อ: <span class="font-weight-light"> {{$address->receiver}}</span></label>
        </div>
        <div>
          <label class="font-weight-bold">เบอร์โทร: <span class="font-weight-light"> {{$address->telephone}}</span></label>
        </div>
        <div>
          <label class="font-weight-bold">ที่อยู่: <span class="font-weight-light"> {{$address->address}}</span></label>
        </div>
      </div>
    </div>

    @php
    $store_id = -1;
    $total = 0;
    $eachOrder = 0;
    $prev = null;
    $end = end($products);
    @endphp

    <form action="{{route('orders.store')}}" method="POST">
      @csrf

      <div class="bg-light py-md-3 px-md-5 mb-3">
        <h3 class="font-weight-bold">รานการสินค้า</h3>
        @foreach($products as $product)

        @if($store_id != $product->store_id)
        @if($eachOrder)
        <br>
        <h5>ราคารวมทั้งหมด: {{$eachOrder}} บาท</h5>

        <div class="d-flex space-right">
          <div>
            วิธีการชำระเงินที่ต้องการ
            <div>
              <select name="{{$prev->store_id}}payment_type" id="payment_type" class="form-control">
                @foreach($payment_types as $payment_type)
                <option name="{{$prev->store_id}}payment_type" value="{{$payment_type}}">{{$payment_type}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div>
            วิธีการจัดส่งสินค้าที่ต้องการ
            <div>
              <select name="{{$prev->store_id}}shipment_type" id="shipment_type" class="form-control">
                @foreach($shipment_types as $shipment_type)
                <option name="{{$prev->store_id}}shipment_type" value="{{$shipment_type}}">{{$shipment_type}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <strong class="text-info">ธนาคาร: {{$prev->store_bank_name}}</strong>
        <br>
        <strong class="text-warning">เลขบัญชี: {{$prev->store_bank_number}}</strong>

        @php
        $eachOrder = 0;
        @endphp
        @endif
        <hr>
        <h5>{{$product->store_name}}</h5>

        @php
        $store_id = $product->store_id;
        @endphp

        @endif
        <div class="form row col space-checkout space-right">
          <h6 class="shrink-text">{{$product->product_name}}</h6>
          <h6>ราคาต่อชิ้น: {{$product->price}} บาท</h6>
          <h6>จำนวน: {{$product->amount}} ชิ้น</h6>
          <h6>รวม: {{$product->amount * $product->price}} บาท</h6>
          @php
          $eachOrder += $product->amount * $product->price;
          $total += $eachOrder;
          $prev = $product
          @endphp
        </div>
        @endforeach
        <br>
        <h5>ราคารวมทั้งหมด: {{$eachOrder}} บาท</h5>
        <div class="d-flex space-right">
          <div>
            วิธีการชำระเงินที่ต้องการ
            <div>
              <select name="{{$product->store_id}}payment_type" id="payment_type" class="form-control">
                @foreach($payment_types as $payment_type)
                <option name="{{$product->store_id}}payment_type" value="{{$payment_type}}">{{$payment_type}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div>
            วิธีการจัดส่งสินค้าที่ต้องการ
            <div>
              <select name="{{$product->store_id}}shipment_type" id="shipment_type" class="form-control">
                @foreach($shipment_types as $shipment_type)
                <option name="{{$product->store_id}}shipment_type" value="{{$shipment_type}}">{{$shipment_type}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <strong class="text-info">ธนาคาร: {{$product->store_bank_name}}</strong>
        <br>
        <strong class="text-warning">เลขบัญชี: {{$product->store_bank_number}}</strong>
      </div>

      <div class="text-right bg-light py-md-3 px-md-5 mb-3">
        <h5>ราคารวมทุกออร์เดอร์: {{$total}} บาท</h5>
      </div>
      <div class="text-right">
        <button type="submit" class="btn btn-success mb-3">ยืนยันการสั่งซื้อสินค้า</button>
      </div>
    </form>
  </div>
</div>

@endsection
