<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreOrderController extends Controller
{
    private function findOrder($opt) {
        $id = DB::table('stores')->where('user_id', '=', Auth::id())->first()->store_id;
        return DB::table('orders')
        ->where('store_id', '=', $id)
        ->where("status", '=', $opt)
        ->get();
    }

    private function getAllOrder() {
        $id = DB::table('stores')->where('user_id', '=', Auth::id())->first()->store_id;
        $orders= DB::table('orders')->where('store_id', '=', $id)->get();

        return $orders;
    }

    private function findAndSetCancelled() {
        $id = DB::table('stores')->where('user_id', '=', Auth::id())->first()->store_id;
        DB::table('orders')
        ->where('store_id', '=', $id)
        ->where("expired_at", "<", Carbon::now())
        ->update([
            'status' => 'cancelled'
        ]);
    }

    public function orderByStatus($opt) {
        $this->findAndSetCancelled();
        $status = ["purchasing", "verifying", "verified", "deliveried", "completed", "cancelled", "total"];
        if ($opt == "total") {
            return view('orders.store_orders', [
                'orders' => $this->getAllOrder()
            ]);
        }
        $id = DB::table('stores')->where('user_id', '=', Auth::id());
        return in_array($opt, $status) ?
            view('orders.store_orders', ["orders" => $this->findOrder($opt), "status" => $opt]) :
            redirect()->route('stores.show', ['store' => $id]);
    }
}
