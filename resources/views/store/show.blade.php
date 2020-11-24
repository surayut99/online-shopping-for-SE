@extends ('layouts.main')

@section('content')
<div class="container mt-5">
  <div class="media">
    <img src="{{asset($store->store_img_path)}}" class="mr-3" width="150px">
    <div class="media-body mt-5">
      <h3 class="mt-0">{{$store->store_name}}</h3>
      <h5>{{ $store->store_description }}</h5>
      <h6>{{$store->store_tel}}</h6>
      @if(Auth::check() && $store->user_id==Auth::user()->id)
      <div class="d-flex justify-content-end">
        <a href="{{route('stores.edit',['store'=>$store->store_id])}}" class="btn btn-warning mr-2">แก้ไขร้านค้า</a>
        <a href="{{route('products.create')}}" class="btn btn-primary mr-2" id="addProduct">เพิ่มรายการสินค้า</a>
        <a href="{{route('product_management',['store'=>$store->store_id])}}" class="btn btn-primary mr-2" id="addProduct">การจัดการสินค้า</a>
        <a href="{{route('orders.index')}}" class="btn btn-info mr-2">รายการสั่งซื้อ</a>
      </div>
      @endif
    </div>
  </div>
  <hr>
  <div>
    <h4>รายการสินค้าในร้านค้า</h4>
    <div id="between-content" class="d-flex bd-highlight sp-flex space-bottom">
      @if(sizeof($products))
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
          <label class="text-wrap overflow-hidden">{{$product->product_description}}</label>
        </div>
      </div>
      @endforeach
      @else
      <h3>
        ไม่มีรายการสินค้า
      </h3>
      @endif
    </div>
  </div>
</div>
@endsection
