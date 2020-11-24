<div class="collapse" id="collapseExample">
    <hr>
    <h6>เพิ่มรายการสินค้า</h6>
    <form action="{{ route('products.store')}}" METHOD="POST">
        @csrf
        {{-- <form action="/action_page.php">--}}
        <label style="font-weight: bold;" for="myfile">รูปสินค้า:</label>
        <input type="file" id="myfile" name="myfile"><br><br>
        {{-- </form>--}}
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="inputEmail4">ชื่อสินค้า:</label>
                <input class="form-control" id="productName" name="productName" placeholder="ชื่อสินค้า" value="เสื้อ">
            </div>
            <br>
            <div class="form-group col-md-2">
                <label for="inputPassword4">จำนวนสินค้า:</label>
                <input class="form-control" id="qty" name="qty" placeholder="จำนวนสินค้า" value="10">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">ราคาสินค้า(บาท/ชิ้น):</label>
                <input class="form-control" id="price" name="price" placeholder="ราคาสินค้า" value="10">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">ไซซ์:</label>
                <input class="form-control" id="size" name="size" placeholder="ไซซ์" value="M">
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">สี:</label>
                <input class="form-control" id="color" name="color" placeholder="สี" value="สีเหลือง">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="inputCity">หมวดหมวดหมู่สินค้า</label>
                <select id="primeProdType" name="primeProdType" class="form-control">
                    @foreach($product_type as $type){
                    <option name="primeProdType" value="{{$type->product_primary_type}}">{{ $type->product_primary_type }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group col-md-5">
                <label for="inputState">หมวดหมู่สินค้าย่อย</label>
                <select id="secondProdType" name="secondProdType" class="form-control">
                    {{-- @foreach($secondary_types as $secondary)
                            <option selected>{{ $secondary->product_secondary_type }}</option>
                    @endforeach --}}
                </select>

            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">รายละเอียดสินค้า: </label>
            <input class="form-control" id="productDes" name="productDes" value="เสื้อาสวย">
        </div>
        <button type="submit" class="btn btn-primary">เพิ่มรายการสินค้าเลย</button>
    </form>
</div>
