<?php

namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cart = new Cart();
        $cart->user_id = 1;
        $cart->product_id = 1;
        $cart->qty = 10;

        $cart->save();
    }
}
