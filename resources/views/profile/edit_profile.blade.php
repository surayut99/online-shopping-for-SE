@extends('layouts.main')

@section('content')
<div class="bg-light">
    <div class=" container pt-4">
        <h1 style="border: 2px ">แก้ไขข้อมูลส่วนตัว</h1>

        <div class="bd-highlight">
            <div class="py-2 bd-highlight">
                <div class="my-1">
                    <img id="preImg" name="preImg" src="{{ asset('storage/pictures/avatars/'.Auth::user()->id.'.jpg') }}" width="150" height="150">
                </div>
            </div>

            <form enctype="multipart/form-data" style="width: 15vw" id="profile-form" action="{{ route('update-profile') }}" method=POST>
                @csrf

                <div class="my-1">
                    <label for="inpImg" class="btn btn-outline-info mt-1 ml-2">เลือกไฟล์รูปภาพ</label>
                    <br>
                    <input hidden type="file" id="inpImg" name="inpImg" accept="image/png, image/jpeg" onchange="previewAvatar()">
                </div>

                <div class="my-1">
                    <h4>ชื่อ: </h4>
                    <input value="{{Auth::user()->name}}" name="new_name" class="form-control" id="changeName">
                </div>

                <button type="submit" class="btn btn-success my-3" href="">บันทึก</button>
            </form>
        </div>
    </div>
    @endsection

    @section('script')
    <script src="{{ asset('storage/js/editProfile.js') }}"></script>
    <script src="{{ asset('storage/js/previewInpImg.js') }}"></script>
    @endsection
