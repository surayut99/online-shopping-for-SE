@extends('layouts.main')

@section('content')
<div class="bg-home">
    <div class="container pt-5">
        {{-- <div style="text-align: center">
            <h1 style="color: white">โปรโมชั่น</h1>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="margin-bottom: 50px">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('storage/pictures/promotions/promo1.png')}}" style="height: 400px; width=900" alt="First slide">
    </div>
    <div class="carousel-item ">
        <img class="d-block w-100" src="{{asset('storage/pictures/promotions/promo2.png')}}" style="height: 400px; width=900" alt="Second slide">
    </div>
    <div class="carousel-item ">
        <img class="d-block w-100" src="{{asset('storage/pictures/promotions/promo3.png')}}" style="height: 400px; width=900" alt="Third slide">
    </div>
</div>
<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>
</div> --}}

<div style="margin-bottom: 20px;">
    <h2 style="margin-bottom: 10px; text-align: center; color: white">หมวดหมู่สินค้า</h2>
    <div id="between-content" class="d-flex d-flex justify-content-center">
        @foreach($rec_images as $key=>$image)
        <div style="background-color: white;" class="p-3">
            <a href="{{ route('products.showByPrimaryType',  ['type'=>$key]) }}">
                <img src="{{asset($image)}}">
            </a>
            <div style="color: black; padding-top: 20px">
                <p style="text-align: center">{{$key}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div style="padding-bottom: 20px">
    <h2 style="margin-bottom: 10px; text-align: center; color: white">ร้านค้า</h2>
    <div class="d-flex justify-content-center">
        @foreach($stores as $store)
        @if($store->store_id <= 3) <div style="background-color: white; margin: 15px" class="p-3">
            <a href="{{route('stores.show', ['store'=>$store->store_id])}}">
                <div>
                    <img src="{{$store->store_img_path}}" style="object-fit: cover;width:250px;height:250px">
                    <div style="color: black; padding-top: 20px">
                        <p style="text-align: center; font-weight: bold; font-size: 20px">{{$store->store_name}}</p>
                        <p style="text-align: center">{{$store->store_description}}</p>
                    </div>
                </div>
            </a>
    </div>

    @endif
    @endforeach
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
