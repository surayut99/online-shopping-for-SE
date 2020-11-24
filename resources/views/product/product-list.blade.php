@extends ('layouts.main')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div>
            <div class="media">
                <img src="storage/pictures/store.png" class="mr-3" width="150px">
                <div class="media-body mt-5">
                    <h5 class="mt-0">Store Name</h5>
                    <h6>รายละเอียดต่าง ๆ ของร้านค้า</h6>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mr-2"  class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">เพิ่มรายการสินค้า</button>
            <button class="btn btn-primary">ลบรายการสินค้า</button>
        </div>

        <div class="collapse" id="collapseExample">
            <hr>
            {{--            <div class="card card-body">--}}
            {{--                <div class="input-group mb-3">--}}
            {{--                    <div class="input-group-prepend">--}}
            {{--                        <span class="input-group-text" id="inputGroupFileAddon01">รูปสินค้า</span>--}}
            {{--                    </div>--}}
            {{--                    <div class="custom-file">--}}
            {{--                        <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">--}}
            {{--                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
            {{--                    </div>--}}
            {{--                    <br>--}}
            {{--                </div>--}}
            {{--                <div >--}}
            {{--                    <label>ชื่อสินค้า: </label>--}}
            {{--                    <input  class="form-control" id="prodName"></input>--}}
            {{--                </div>--}}
            {{--                <div >--}}
            {{--                    <label>ราคาสินค้า(บาท): </label>--}}
            {{--                    <input  class="form-control" id="prodPrice"></input>--}}
            {{--                </div>--}}
            {{--                <div >--}}
            {{--                    <label>รายละเอียดสินค้า: </label>--}}
            {{--                    <textarea class="form-control" id="ProdDisc"></textarea>--}}
            {{--                </div>--}}
            <form>
                <form action="/action_page.php">
                    <label style="font-weight: bold;" for="myfile">รูปสินค้า:</label>
                    <input type="file" id="myfile" name="myfile"><br><br>
{{--                    <input type="submit">--}}
                </form>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputEmail4">ชื่อสินค้า:</label>
                        <input class="form-control" id="prodName" placeholder="ราคาสินค้า">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputPassword4">ราคาสินค้า(บาท):</label>
                        <input  class="form-control" id="prodPrice" placeholder="ราคาสินค้า">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inputCity">หมวดหมวดหมู่สินค้า</label>
                        <select id="primeProdType" class="form-control">
                            <option selected>เสื้อผู้ชาย</option>
                            <option>เสื้อผู้หญิง</option>
                            <option>รองเท้าผู้ชาย</option>
                            <option>รองเท้าผู้หญิง</option>
                            <option>กระเป๋า</option>
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputState">หมวดหมู่สินค้าย่อย</label>
                        <select id="secondProdType" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    {{--                    <div class="form-group col-md-2">--}}
                    {{--                        <label for="inputZip">ราคา(บาท):</label>--}}
                    {{--                        <input type="text" class="form-control" id="inputZip">--}}
                    {{--                    </div>--}}
                </div>
                <div class="form-group">
                    <label for="inputAddress">รายละเอียดสินค้า: </label>
                    <textarea class="form-control" id="ProdDisc"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>




        </div>
        <hr>

        <div>
            <h4>รายการสินค้าทั้งหมด</h4>
            <div id="between-content" class="d-flex d-inline-flex p-1 bd-highlight">
                <p>what</p>
                @foreach($products as $product)
                    <div style="background-color: white;" class="p-3" >
                        <img src="{{asset($product->product_img_path)}}" width="150px">
                        <div style="color: black; padding-top: 20px">
                            <p style="text-align: center">{{$product->product_description}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <hr>

    </div>
@endsection
<script>
    import Input from "../../js/Jetstream/Input";
    export default {
        components: {Input}
    }
</script>
