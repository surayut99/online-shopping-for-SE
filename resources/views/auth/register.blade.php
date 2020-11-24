<x-guest-layout>
    @include('layouts.menu')
    <div class="bg-lr" style="padding-top: 120px">
        <div class="container p-4" style="font-family: 'Bai Jamjuree', sans-serif; width: 50vw; background-color: rgba(0,0,0,.5); color: white; border-radius: 30px">
            <h1 style="text-align: center; padding-top: 30px">ลงทะเบียน</h1>

            <x-jet-validation-errors class="mb-4" />

            <form action="{{route("register")}}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="form-inline">
                        <label for="name">ชื่อผู้ใช้ &nbsp;</label>
                        <small class="form-text text-warning">***</small>
                    </div>
                    <input required id="name" type="text" class="form-control" name="name">
                </div>

                <div class="form-group">
                    <div class="form-inline">
                        <label for="email">อีเมล &nbsp;</label>
                        <small class="form-text text-warning">***</small>
                    </div>
                    <input required type="email" class="form-control" name="email">
                </div>

                <div class="form-group" style="margin-top: 20px">
                    <div class="form-inline">
                        <label for="password">รหัสผ่าน &nbsp;</label>
                        <small class="form-text text-warning">***</small>
                    </div>
                    <input required id="password" type="password" class="form-control" name="password">
                </div>

                <div class="form-group" style="margin-top: 20px">
                    <div class="form-inline">
                        <label for="pasword_confirmation">ยืนยันรหัสผ่าน &nbsp;</label>
                        <small class="form-text text-warning">***</small>
                    </div>
                    <input required id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                </div>

                <div style="text-align: center">
                    <button type="submit" class="btn" style="background-color: cornflowerblue;">ลงทะเบียน</button>
                </div>

            </form>
        </div>
    </div>
</x-guest-layout>
