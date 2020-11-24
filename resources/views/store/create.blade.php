@extends('layouts.main')

@section('content')
<div class="container">
    <h1>ข้อมูลเบื้องต้นร้านค้าของแม่ค้ามือใหม่</h1>

    <div class="d-flex space-left space-right">

        <div class="py-2 bd-highlight">
            <div class="my-1">
                <img id="preImg" name="preImg" src="{{ asset('storage/pictures/icon/default_store.png') }}" width="150" height="150">
            </div>
        </div>

        <form class="col-5 mb-3" enctype="multipart/form-data" action="{{ route('stores.store') }}" method="POST">
            @csrf
            <div>
                <label class="btn btn-info" for="inpImg">เลือกรูปร้านค้าของคุณ</label>
                <input hidden type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
            </div>
            <div class="form-group">
                <div class="form-inline">
                    <label for="name">ชื่อร้านค้า &nbsp</label>
                    <small class="form-text text-warning">***</small>
                </div>
                <input id="storeName" type="text" class="form-control @error('storeName') is-invalid @enderror" name="storeName">
                @error('storeName')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-inline">
                    <label for="name">ธนาคาร &nbsp</label>
                    <small class="form-text text-warning">***</small>

                </div>
                <select name="store_bank_name" id="" class="form-control">
                    @foreach($banks as $bank)
                    <option value="{{$bank}}" selected="selected">{{$bank}}</option>
                    @endforeach
                </select>
                {{-- <input id="bankName" type="text" class="form-control @error('bankName') is-invalid @enderror" name="bankName"> --}}
                {{-- @error('bankName')
                <strong class="text-danger">{{$message}}</strong>
                @enderror --}}
            </div>

            <div class="form-group">
                <div class="form-inline">
                    <label for="name">เลขบัญชีธนาคาร &nbsp</label>
                    <small class="form-text text-warning">***</small>
                </div>
                <input id="bankId" type="text" class="form-control @error('bankId') is-invalid @enderror" name="bankId">
                @error('bankId')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-inline">
                    <label for="name">เบอร์โทรศัพท์ &nbsp</label>
                    <small class="form-text text-warning">***</small>
                </div>
                <input id="storeTel" type="text" class="form-control @error('storeTel') is-invalid @enderror" name="storeTel">
                @error('storeTel')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-inline">
                    <label for="name">คำอธิบายร้านค้า &nbsp</label>
                    <small class="form-text text-warning">***</small>
                </div>
                <textarea id="storeDes" type="text" class="form-control @error('storeDes') is-invalid @enderror" name="storeDes">{{old('storeDes')}}</textarea>
                @error('storeDes')
                <strong class="text-danger">{{$message}}</strong>
                @enderror
            </div>

            <div style="text-align: right">
                <button type="submit" class="btn btn-success" style="">สร้างร้านค้า</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('storage/js/previewInpImg.js') }}"></script>
@endsection
