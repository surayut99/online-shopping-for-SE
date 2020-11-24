<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = new Store();
        $str->user_id = 1;
        $str->store_name = "PUEN STORE";
        $str->store_description = "WoW";
        $str->store_tel = "0909042122";
        $str->store_bank_number = "8282831923";

        $str->save();

        $str = new Store();
        $str->user_id = 2;
        $str->store_name = "PUEN STORE 2";
        $str->store_description = "WoW WOWW";
        $str->store_tel = "1150";
        $str->store_bank_number = "2315452333";

        $str->save();
    }
}
