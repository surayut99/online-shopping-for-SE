@extends('layouts.main')
@section('content')
<div class="container">
  <h1 class="pt-3">แสดงรายการสินค้า</h1>
  @if(count($products) > 0)
  <div id="between-content" class="d-flex p-1 bd-highlight sp-flex space-bottom">

    @foreach($products as $product)
    <div style="background-color: whitesmoke; border-radius:10px; width:15vw; height: 50vh" class="p-3">
      <div class="text-center">
        <a href="{{ route('products.show',['product'=>$product->product_id]) }}" style="color:maroon">
          <img src="{{asset($product->product_img_path)}}" style="object-fit: cover;width:200px;height:200px">
        </a>
      </div>
      <div class="mt-3" style="color:black">
        <h4 class="shrink-text" style="color:black;">{{$product->product_name}}</h4>
        <label>ราคา {{$product->price}} บาท </label>
      </div>
      <hr class="my-0">
      <div style="color:black">
        <p class="text-wrap overflow-hidden">{{$product->product_description}}</p>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <h3 style="text-align: center">ขออภัย ไม่พบรายการสินค้าที่คุณต้องการ</h3>
  @endif
</div>
@endsection
