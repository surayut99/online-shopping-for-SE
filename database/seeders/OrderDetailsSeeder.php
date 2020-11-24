<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail = new OrderDetail();
        $detail->order_id = 1;
        $detail->product_id = 1;
        $detail->product_name = "สินค้าสวยงาม";
        $detail->qty = 12;
        $detail->price = 30;
        $detail->save();

        $detail = new OrderDetail();
        $detail->order_id = 2;
        $detail->product_id = 1;
        $detail->product_name = "สินค้าน่าซื้อ";
        $detail->qty = 20;
        $detail->price = 300;
        $detail->save();

        // $detail = new OrderDetail();
        // $detail->order_id = 1;
        // $detail->product_id = 3;
        // $detail->qty = 12;
        // $detail->price = 30;
        // $detail->save();

        // $detail = new OrderDetail();
        // $detail->order_id = 1;
        // $detail->product_id = 4;
        // $detail->qty = 20;
        // $detail->price = 300;
        // $detail->save();
    }
}
