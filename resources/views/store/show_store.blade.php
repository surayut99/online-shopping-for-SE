@extends ('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="media">
        <img src="{{asset('storage/pictures/icon/default_store.png')}}" class="mr-3" style="object-fit: cover;width:200px;height:200px">
        <div class=" media-body mt-5">
            <h5 class="mt-0">{{$stores[0]->store_name}}</h5>
            <h6>{{ $stores[0]->store_description }}</h6>
        </div>
    </div>
    <hr>
    <div>
        <h4>รายการสินค้าทั้งหมด</h4>
        <div id="between-content" class="d-flex d-inline-flex p-1 bd-highlight">
            @if($products->first()!=NULL)
            @foreach($products as $product)
            <div style="background-color: white;" class="p-3">
                <a href="{{ route('products.show',['product'=>$product->product_id]) }}">
                    <img src="{{asset($product->product_img_path)}}" width="150px" href>
                    <div style="color: black; padding-top: 20px">
                        <p style="text-align: center">{{$product->product_description}}</p>
                    </div>
                </a>
            </div>
            @endforeach
            @else ไม่มีรายการสินค้า
            @endif
        </div>
    </div>
</div>
@endsection
