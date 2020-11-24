<div>
  @foreach($orders as $order)
  <div>
    <h3>หมายเลขสั่งซื้อ: {{$order->order_id}}</h3>
    <p>สั่งซื้อเมื่อ {{$order->created_at}}</p>
    @if($order->status == "vaerifying")
    <p>แจ้งชำระเงินเมื่อ: {{$order->updated_at}}</p>
    @elseif($order->status == "verified")
    <p>ตรวจสอบการเมื่อ: {{$order->updated_at}}</p>
    @elseif($order->status == "cancelled")
    <p>หมดอายุเมื่อ: {{$order->expired_at}}</p>
    @else
    <p>อัพเดทล่าสุดเมื่อ: {{$order->updated_at}}</p>
    @endif
    <div class="form-inline space-right">
      <a href="{{route('orders.show',['order'=>$order->order_id])}}" class="btn btn-info"> แสดงรายละเอียด</a>
    </div>
  </div>
</div>
<hr>
@endforeach
</div>
