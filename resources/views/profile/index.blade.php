@extends('layouts.main')

@section('content')
<div>

  <div class="container pt-5 d-flex justify-content-between">
    <div class="d-flex">
      @if(!$store)
      <a href="{{ route('stores.create') }}" class="btn" style="background-color:RGB(242,137,108)">เปิดร้านค้า!</a>
      @else
      <h5 class="mr-3 mt-2">ร้านค้าของคุณ: </h5>
      <a href="{{ route('stores.show',['store'=>$store->store_id]) }}" class="btn btn-info" style="">{{ $store->store_name }}</a>
      @endif
    </div>
  </div>

  <hr class="container">

  <div class="container">
    <h1 style="border: 2px ">ข้อมูลส่วนตัว</h1>

    <div class="d-flex bd-highlight">
      <div class="p-2 bd-highlight mx-3">
        <img src="{{ asset('storage/pictures/avatars/'.Auth::user()->id.'.jpg') }}" width="100px">
      </div>
      <div class="p-2 bd-highlight mx-3">
        <h4>ชื่อ: {{Auth::user()->name}}</h4>
        <h4>อีเมล: {{Auth::user()->email}}</h4>
      </div>
    </div>

    <a href="{{route('edit-profile')}}" class="btn btn-warning" type="button">แก้ไขข้อมูลส่วนตัว</a>

    <hr>

    <h1 style="border: 2px ">ที่อยู่</h1>

    <div class="my-2 d-flex">
      @foreach($addrs as $addr)
      <div class="card mr-3 my-1 p-2 bordered-rounded" style="width: 20vw; background-color: whitesmoke">
        <p class="text-bold"><span>ชื่อ: </span> {{$addr->receiver}} </p>
        <p><span>เบอร์โทร: </span>{{$addr->telephone}}</p>
        <p><span>ที่อยู่: </span>{{$addr->address}}</p>
        <div class="d-flex">


          @if(!$addr->default)
          <form action="{{route('changeDefaultAddress', ['address' => $addr->no])}}" method="post">
            @method('put')
            @csrf
            <button style="width: 135px" class="btn btn-success">ตั้งเป็นที่อยู่หลัก</button>
          </form>
          @else
          <button style="width: 135px" disabled class="btn btn-outline-primary">ที่อยู่ปัจจุบัน</button>
          @endif


          <form class="ml-1" action="{{ route('address.update', ['address'=> $addr->no])}}" method="post">
            @method('put')
            @csrf
            <a href="{{ route('address.edit', ['address' => $addr->no]) }}" class="btn btn-warning">แก้ไขที่อยู่</a>
          </form>
        </div>
      </div>
      @endforeach
    </div>


    @if(sizeof($addrs) != 3)
    <a href="{{ route('address.create') }}" class="btn btn-primary">เพิ่มที่อยู่สำหรับจัดส่ง</a>
    @else
    <h6>คุณสามารเพิ่มที่อยู่สำหรับจัดส่งได้สูงสุดเพียง 3 ที่อยู่เท่านั้น</h6>
    @endif
    <hr>

    <div class="d-flex" id="between-content">
      <a id="purchasing" class="btn btn-primary">รายการที่ต้องชำระ</a>
      <a id="verifying" class="btn btn-info">รายการรอการตรวจสอบ</a>
      <a id="verified" class="btn btn-info">รายการรอจัดส่ง</a>
      <a id="deliveried" class="btn btn-info">รายการที่ต้องได้รับ</a>
      <a id="completed" class="btn btn-success">รายการที่ได้รับสำเร็จ</a>
      <a id="cancelled" class="btn btn-danger">รายการที่ถูกยกเลิก</a>
    </div>

    <div id="products" class="border border-warning rounded p-2 my-2" style="min-height: 500px; max-height:80vh; overflow-y: auto">
    </div>


  </div>
</div>
@endsection

@section('script')
<script src=" {{ asset('storage/js/user_product.js') }} "></script>
@endsection
