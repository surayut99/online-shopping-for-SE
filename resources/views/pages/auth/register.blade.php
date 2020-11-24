  @extends('layouts.main')

  @section('content')
  <div class="bg-lr" style="">

      <div class=" container p-4 form-auth">
          <h1 style="text-align: center; padding-top: 30px">ลงทะเบียน</h1>

          <form action="{{route("pages.auth.register")}}" method="POST">
              @csrf

              <div class="form-group">
                  <div class="form-inline">
                      <label for="name">ชื่อผู้ใช้ &nbsp;</label>
                      <small class="form-text text-warning">***</small>
                  </div>
                  <input required id="name" type="text" class="form-control" name="name">
                  {{-- @error('name')
                  <label for="">{{$message}}</label>
                  @enderror --}}
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
  @endsection
