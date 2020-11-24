<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            AddressSeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            ProductSeeder::class,
            ProductTypeSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            OrderDetailsSeeder::class
        ]);
    }
}
