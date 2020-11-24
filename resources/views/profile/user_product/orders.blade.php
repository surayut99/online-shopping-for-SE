<div>
  @if(!$orders)
  <div class="text-center">
    <h2>ยังไม่มีรายการสั่งซื้อ ณ สถานะนี้</h2>
  </div>
  @endif

  @foreach($orders as $order)

  @continue($order->status != $status)

  <div class="my-2">
    <div class="d-flex">
      <div class="mr-auto d-flex">
        <img class="mr-1" src="{{asset($order->store_img_path)}}" alt="" style="width: 75px; height: 75px">
        <h3>{{$order->store_name}}</h3>
      </div>
      <div class="ml-auto">

        <div class="text-right">
          @if($status == "purchasing")
          <a href="{{route('orders.inform', ['order' => $order->order_id])}}" class="text-right pt-2 btn btn-warning">แจ้งผลชำระเงิน</a>
          @else
          <a href="{{route('orders.show', ['order' => $order->order_id])}}" class="text-right pt-2 btn btn-info">แสดงรายละเอียด</a>
          @endif
        </div>

        <div class="text-right">
          <p class="mr-1 mb-0">สั่งซื้อเมื่อ {{ \Carbon\Carbon::parse( $order->created_at)->timezone('Asia/Bangkok')->toDateTimeString() }}</p>
          @if($status == "purchasing")
          <strong class="mr-1 mb-0">หมดอายุเมื่อ {{ \Carbon\Carbon::parse($order->expired_at)->timezone('Asia/Bangkok') }}</strong>
          @elseif($status == "verifying")
          <strong class="mr-1 mb-0">ชำระเงินเมื่อ {{ \Carbon\Carbon::parse($order->updated_at)->timezone('Asia/Bangkok') }}</strong>
          @elseif($status == "verified")
          <strong class="mr-1 mb-0">ตรวจสอบแล้วเมื่อ {{ \Carbon\Carbon::parse($order->updated_at)->timezone('Asia/Bangkok') }}</strong>
          @elseif($status == "deliveried")
          <p class="mr-1 mb-0">จัดส่งเมื่อ {{ $order->updated_at }}</p>
          <h4 class="mr-1 mb-0">เลขพัสดุ {{$order->track_id}}</h4>
          @elseif($status == "cancelled")
          <p class="mr-1 mb-0">ยกเลิกเมื่อ {{ $order->updated_at }}</p>
          @endif
        </div>
      </div>
    </div>

    <table class="my-2 table table-striped">
      @foreach($orders as $item)
      @continue($item->order_id != $order->order_id)
      <tr>
        <td>
          <img style="object-fit: cover;width:75px;height:75px" src="{{asset($item->product_img_path)}}" alt="">
        </td>
        <td>
          {{ $item->product_name}}
        </td>
        <td class="text-right">
          {{ $item->qty }} ชิ้น
        </td>
        <td class="text-right">
          {{ $item->price}} บาท
        </td>
        @if($status == "cancelled" || $status == "history")
        <td class="text-center">
          <a class="btn btn-primary">สั่งซื้ออีกครั้ง</a>
        </td>
        @endif
      </tr>
      @endforeach
    </table>

    <div class="d-flex">
      <h5 class="ml-auto">ราคาทั้งหมด {{$order->total_cost}} บาท</h5>
    </div>

    <hr>
  </div>

  @endforeach
</div>
