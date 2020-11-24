<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = DB::table('stores')->where('user_id', '=', Auth::id())->first()->store_id;

        $status = ['purchasing'=>'รอจ่าย', 'verifying'=> 'รอการยืนยัน', 'verified'=>'ยืนยันแล้ว', 'deliveried'=>'จัดส่งแล้ว','cancelled'=>'ยกเลิก', "completed" => "ได้รับแล้ว"];
        $store = DB::table('stores')->where('store_id','=',$id)->first();
        $orders = DB::table('orders')->where('store_id','=',$id)->get();
        return view('store.show_orders',[
            'orders' => $orders,
            'store' => $store,
            "status" => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Cart::where('carts.user_id','=',Auth::user()->id)
                ->join('products','products.product_id','=','carts.product_id')
                ->join('stores', 'stores.store_id', '=', 'products.store_id')
                ->orderBy("products.store_id")
                ->select('products.*','stores.store_name', 'stores.store_bank_name', 'stores.store_bank_number' ,DB::raw('carts.qty as amount'))
                ->get();
        $address = Address::where("user_id", "=", Auth::user()->id)->orderBy("default", "desc")->first();
        $shipment_type = ['Kerry', 'EMS', 'DHL', 'Flash', 'Standard Express'];
        $payment_type = ['COD', 'Transfering'];

        return view("orders.create", [
            'products' => $products,
            'address' => $address,
            'shipment_types' => $shipment_type,
            'payment_types' => $payment_type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addresses = Address::where("user_id", "=", Auth::user()->id)->orderBy("default", "desc")->first();
        $products = Cart::where('user_id','=',Auth::user()->id)->join('products','products.product_id','=','carts.product_id')
            ->select('products.product_id','products.product_name','products.price','carts.qty','products.store_id')->orderBy('products.store_id')->get();
        $dateTime = Carbon::now();
        $current_store = null;
        $order = null;
        $order_id = null;
        $total = null;
        for($i = 0; $i < $products->count();$i++){
            if($products[$i]->store_id != $current_store){
                $current_store = $products[$i]->store_id;
                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->store_id = $current_store;
                $order->expired_at = $dateTime->copy()->addDays(2);
                $order->total_cost = 0;
                $order->recv_address = $addresses->address;
                $order->recv_name = $addresses->receiver;
                $order->recv_tel = $addresses->telephone;
                $order->shipment_type = $request->get($current_store . 'shipment_type');
                $order->payment_type = $request->get($current_store . 'payment_type');
                $order->status = $order->payment_type == "COD"? "verified" : "purchasing";
                $order->save();

                $order_id = DB::table('orders')->max('order_id');
                $total = 0;
            }


            $order_detail = new OrderDetail();
            $order_detail->order_id = $order_id;
            $order_detail->product_id = $products[$i]->product_id;
            $order_detail->product_name = $products[$i]->product_name;
            $order_detail->qty = $products[$i]->qty;
            $order_detail->price = $products[$i]->price;
            $total = $order_detail->qty * $order_detail->price;
            $order_detail->save();

            $qty = DB::table('products')->where('product_id', '=', $products[$i]->product_id)->first()->qty;
            DB::table('orders')->where('order_id','=', $order_id)->update(['total_cost'=>$total]);
            DB::table('products')->where('product_id', '=', $products[$i]->product_id)->update([
                'qty' => $qty - $products[$i]->qty
            ]);
        }

        DB::table('carts')->where('user_id', '=', Auth::id())->delete();

        return $this->success();
    }

    public function success()
    {
        $dt = Order::where('user_id','=',1)->select(DB::raw("max(created_at) as last"))->first()->last;
        $orders = Order::where('orders.user_id', '=', Auth::id())->where('orders.created_at', '=', $dt)
            ->join("order_details", 'order_details.order_id', '=', 'orders.order_id')
            ->join('stores', 'stores.store_id', '=', 'orders.store_id')
            ->select('orders.*', 'stores.store_name', 'order_details.product_name', 'order_details.price', 'order_details.qty')
            ->orderBy('store_id')
            ->get();
        $address = Address::where("user_id", "=", Auth::user()->id)->orderBy("default", "desc")->first();

        return view('orders.success', [
            'order_list' => $orders,
            'orders' => $orders,
            'address' => $address,
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = DB::table('orders')->where('order_id', '=', $id)->first();
        $payment = DB::table('payments')->where('order_id', '=', $id)->first();
        $products = DB::table('order_details')->where('order_id', '=', $id)
                ->join('products', 'products.product_id', '=', 'order_details.product_id')
                ->join('stores', 'stores.store_id', '=', 'products.store_id')
                ->select('order_details.*', 'products.product_img_path', "productS.store_id")
                ->get();
        $owner = DB::table('stores')->where('store_id','=',$order->store_id)->first();

        return view('orders.show', [
            'order' => $order,
            'payment' => $payment,
            'products' => $products,
            'owner' => $owner
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "store_comment" => "required"
        ],[
            "store_comment.required" => "กรุณากรอกเหตุผลในการปฎิเสธการแจ้งชำระเงินนี้"
        ]);
        DB::table('orders')->where('order_id','=',$id)->update([
            'status' => 'cancelled',
            'store_comment' => $request->input('store_comment'),
        ]);
        return redirect()->route('orders.show',['order'=>$id]);
    }
    public function accept($id)
    {
        DB::table('orders')->where('order_id','=',$id)->update([
            'status' => 'verified',
        ]);
        return redirect()->route('orders.show',['order'=>$id]);
    }
    public function orderTrackId(Request $request, $id){
        $request->validate([
            'track_id' => 'required',
        ],[
            'track_id.required' => 'กรุณาระบุเลขพัสดุ'
        ]);

        DB::table('orders')->where('order_id','=',$id)->update([
            'status' => 'deliveried',
            'track_id' => $request->track_id,
        ]);
        return redirect()->route('orders.show',['order'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function informPayment($id) {
        $order = DB::table('orders')->where("order_id", "=", $id)->first();

        if (!Auth::check()) {
            return redirect()->route('login');
        } else if (Auth::id() != $order->user_id || $order->status != "purchasing") {
            return redirect()->route('profile');
        }

        $products = DB::table('order_details')->where("order_id", "=", $order->order_id)
                ->join("products", "products.product_id", "=", "order_details.product_id")
                ->select("order_details.*", "products.product_img_path")
                ->get();
        return view("orders.inform", [
            "order" => $order,
            "products" => $products,
            "total" => 0
        ]);
    }

    public function storePayment(Request $request, $id) {
        $validation = Validator::make($request->all(), [
            "inpImg" => "required",
            "bank_name" => "required"
        ],
        [
            "inpImg.required" => "กรุณาอัพโหลดหลักฐานการชำระเงิน",
            "bank_name.required" => "กรุณากรอกชื่อธนาคารที่ใช้ในการชำระเงิน"
        ]);

        $pending_payment = Payment::where("order_id", '=', $id)->first();
        $img = $request->file('inpImg');
        if ($img) {
            $path = "storage/pictures/payments/";
            $filename =  $id . "." . $img->getClientOriginalExtension();
            $img->move($path, $filename);

            if ($pending_payment) {
                Payment::where("order_id", '=', $id)->update(['bank_name' => "null", 'img_path' => $path.$filename]);
            } else {
                $pending_payment = new Payment();
                $pending_payment->order_id = $id;
                $pending_payment->bank_name = "";
                $pending_payment->img_path = $path.$filename;
                $pending_payment->save();
            }
        } else if (!$pending_payment) {
            $validation->validate();
        }

        if ($request->bank_name == null) {
            return redirect()->back()->with(["oldImgpath" => $pending_payment->img_path]);
        }

        DB::table('payments')->where("order_id", '=', $id)
                ->update([
                    'bank_name' => $request->bank_name
                ]);
        DB::table('orders')->where("order_id", '=', $id)
                ->update([
                    "status" => "verifying"
                ]);

        return redirect()->route("profile");
    }

    public function makeComplete($id) {
        DB::table('orders')->where('orer_id', '=', $id)->update(
            [
                "status" => "completed",
                "updated_at" => Carbon::now()
            ]
            );
        return redirect()->route('orders.show', [
            'order' => $id
        ]);
    }
}

