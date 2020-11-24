@extends('layouts.main')
@section('content')
<div class="container">
  @if($store->user_id==Auth::user()->id)
  <h1>รายการสั่งซื้อสินค้า</h1>
  <hr>
  <div class="d-flex" id="between-content">
    <a id="verifying" class="btn btn-primary">รายการรอการตรวจสอบ</a>
    <a id="verified" class="btn btn-warning">รายการที่รอการอัพเดทข้อมูลการจัดส่ง</a>
    <a id="cancelled" class="btn btn-danger">รายการที่สิ้นสุดการชำระเงิน</a>
    <a id="total" class="btn btn-success">รายการสั่งซื้อทั้งหมด</a>
  </div>

  <div id="orders" class="border border-warning rounded p-2 my-2" style="min-height: 500px; max-height:60vh; overflow-y: auto">

  </div>

</div>
@endif
</div>
@endsection

@section('script')
<script src="{{asset('storage/js/store_order_get_html.js')}}"></script>
@endsection
