<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserProductController extends Controller
{

    private function parseTimeZone($dt) {
        return Carbon::parse($dt)->timezone('Asia/Bangkok')->toDateTimeString();
    }

    private function findOrder($opt) {
        $order_list = array();
        $orders = DB::table('orders')
                ->where('orders.user_id', '=', Auth::user()->id)
                ->where('status', '=', $opt)
                ->join("order_details", "order_details.order_id", '=', 'orders.order_id')
                ->join("products", 'products.product_id', '=', 'order_details.product_id')
                ->join("stores", "stores.store_id", '=', "products.store_id")
                ->select("orders.order_id", "orders.created_at", "orders.expired_at", "orders.total_cost", "orders.updated_at", "orders.status",
                        "stores.store_id","stores.store_name", "stores.store_img_path",
                        "products.product_img_path", "order_details.product_name",
                        "order_details.qty", "order_details.price",'track_id')
                ->get();
        return $orders;
    }

    private function findAndSetCancelled() {
        DB::table('orders')
        ->where('user_id', '=', Auth::id())
        ->where("expired_at", "<", Carbon::now())
        ->update([
            'status' => 'cancelled'
        ]);
    }

    public function showUserProduct($opt) {
        $this->findAndSetCancelled();
        $status = ["purchasing", "verifying", "verified", "deliveried", "completed", "cancelled"];
        return in_array($opt, $status) ?
            view('profile.user_product.orders', ["orders" => $this->findOrder($opt), "status" => $opt]) :
            redirect()->route('profile');
    }
}
