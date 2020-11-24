@extends('layouts.main')


@section( 'content')
<div class='container' style="padding-top:100px">
    <h1>การจัดการสินค้า</h1>
    {{-- d-flex d-inline-flex p-1 bd-highlight sp-flex space-bottom --}}
    <div id="between-content" class="d-flex d-inline-flex p-1 bd-highlight sp-flex space-bottom">
        @foreach($products as $product)
        <div style="background-color: whitesmoke; border-radius:10px; width:25vw" class="p-3 text-center">
            <img src="{{asset($product->product_img_path)}}" style="object-fit: cover;width:200px;height:200px">
            <div style="padding-top: 20px;" class="shrink-text">
                <h4 class="rounded" style="color:black;">{{$product->product_name}}</h4>
            </div>
            <hr>
            <div style="color:black; min-height:100px">
                <h6 style="color:blue">ราคา {{$product->price}} บาท </h6>
                <label>จำนวน {{$product->qty}} ชิ้น</label>
                <label>สี{{$product->color}} ไซซ์ {{$product->size}}</label> <br>
                <label class="shrink-text">{{$product->product_description}}</label>
            </div>
            <div class="text-right">
                <div class="text-right d-flex justify-content-end space-left">
                    <a href="{{route('products.edit',['product'=>$product->product_id])}}" class="btn btn-outline-info">แก้ไข</a>
                    <button onclick="collapseDelOpt()" id="deleteOpt" class="btn btn-danger" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ลบสินค้านี้</button>
                    <form id="collapseExample" class="mt-3 collapse" action="{{ route('products.destroy', ['product' => $product->product_id]) }}" method="POST">
                        @method('delete')
                        @csrf
                    </form>
                </div>
                <div id="collapseExample">
                    <label class="mt-2" style='color:black'>คุณต้องการลบสินค้านี้ใช่หรือไม่</label> <br>
                    <button type="submit" class="btn btn-danger">ใช่</button>
                    <button onclick="collapseDelOpt()" class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">ไม่</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection
    @section('script')
    <script src="{{ asset('storage/js/confirmDeleteProduct.js') }}"></script>
    @endsection
