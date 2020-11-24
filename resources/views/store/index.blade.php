@extends('layouts.main')



@section('content')
<div class="container mt-5 ">
  <h1>ร้านค้าทั้งหมด</h1>
  <div class="d-flex overflow-h">
    @foreach($stores as $store)
    <div class="item card mr-3 my-1 p-2 bordered-rounded text-center" style="background-color: whitesmoke; width:350px;">
      <a href="{{ route('stores.show',['store'=>$store->store_id]) }}" class="mx-auto pt-2" style='color:red'>
        <img src="{{asset($store->store_img_path)}}" style="object-fit: cover;width:150px;height:150px">
        <div style="color: black; padding-top: 20px">
          <h3 style="text-align: center">{{$store->store_name}}</h3>
          <p>{{$store->store_description}}</p>
          {{-- <hr> --}}
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>

@endsection
