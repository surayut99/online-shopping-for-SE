<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addr = new Address();
        $addr->user_id = 1;
        $addr->no = 1;
        $addr->telephone = "09090";
        $addr->receiver = "Puen Cruff";
        $addr->address = "this is my address";
        $addr->default = true;

        $addr->save();

        $addr = new Address();
        $addr->user_id = 1;
        $addr->no = 2;
        $addr->telephone = "123123";
        $addr->receiver = "PueN";
        $addr->address = "AS";
        $addr->default = false;

        $addr->save();
    }
}
