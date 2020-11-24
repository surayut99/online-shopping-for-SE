<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr = new User();
        $usr->name = "ปืน ครัฟ";
        $usr->email = "p@pp.com";
        $usr->password = Hash::make("puenpuen");
        $usr->save();

        $usr = new User();
        $usr->name = "ปืน ครัฟ 2";
        $usr->email = "p2@pp.com";
        $usr->password = Hash::make("puenpuen");
        $usr->save();

        $usr = new User();
        $usr->name = "punch";
        $usr->email = "punch.rinlanee@gmail.com";
        $usr->password = Hash::make("12345678");
        $usr->save();
    }
};
