<div class="sp-nav-font">
    <nav class="navbar navbar-expand-lg navbar-light shoppool-nav d-flex justify-content-between" style="min-height: 70px">
        {{-- Home LOGO --}}
        <div class="d-flex" style="max-width:14vw">
            <img src="{{asset('storage/pictures/icon/logo.png')}}" style="height: 50px; filter: drop-shadow(2px 2px 2px RGB(47,49,54));">
            <div class="pt-1 pl-3">
                <a id="home" class="navbar-brand logo-font p-2" href="/" style="font-size:25px;">SHOPPOOL</a>
                <br>
                <a id="home" class="navbar-brand logo-font1" href="/" style="font-size:15px; line-height: 1em">fabulous & gorgeous</a>
            </div>
        </div>

        {{--ค้นหาสินค้า--}}
        <div class="pl-2" id="main">
            <form action="{{ route("product.searchByName") }}" method="GET">
                <div class="row">
                    <div style="margin-right: 10px;">
                        <input required class="form-control" type="text" placeholder="พิมพ์ชื่อสินค้า..." name="product_name" aria-label="Search">

                    </div>
                    <div>
                        <div style="text-align: right">
                            <button type="submit" class="btn btn-outline-light">ค้นหา</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>



        {{-- Acccount Tool --}}
        <div class="d-flex" id="account-content">
            @if (Route::has('login'))
            <ul class="navbar-nav mr-auto sp-nav-icon sp-nav-right">
                @auth
                <li>
                    <a href="{{ route('products.index') }}"><img class="mr-3 ml-3 mt-1" src="{{asset('storage/pictures/icon/products.png')}}"></a></li>
                <li>
                <li>
                    <a href="{{ route('cart') }}"><img class="mr-2 mt-1" src="{{asset('storage/pictures/icon/cart.png')}}"></a></li>
                <li>

                <li>
                    <a href="{{ route('stores.index') }}"><img class="mr-3 ml-3 mt-1" src="{{asset('storage/pictures/icon/default_store2.png')}}"></a></li>
                <li>


                <li class="nav-item dropdown sp-nav-font">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="sp-nav-dropdown-menu dropdown-menu dropdown-menu-right sp-nav-font" aria-labelledby="navbarDropdown" style="background-color: #501719;">
                        <a href="{{ route('profile') }}" style="color: yellow;" class="dropdown-item">โปรไฟล์</a>

                        <div style="background-color: white; height: 1px"></div>

                        <a class="dropdown-item" style="color: yellow;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ออกจากระบบ
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @else
                <li class="nav-item sp-nav-font {{ \Route::currentRouteName() === 'pages.auth.register' ? 'sp-nav-font-active   ' : '' }}">
                    <a class="nav-link" href="{{ route('pages.auth.register') }}">ลงทะเบียน</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item sp-nav-font {{ \Route::currentRouteName() === 'login' ? 'sp-nav-font-active ' : '' }}">
                    <a class="nav-link" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                </li>
                @endif
                @endauth
            </ul>
            @endif
        </div>
    </nav>
</div>
