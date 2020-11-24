<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->realText(10),
            'product_description' => $this->faker->realText(50),
            'product_primary_type' => $this->faker->realText(20),
            'product_secondary_type' => $this->faker->realText(20),
            'color' => $this->faker->realText(10),
            'size' => $this->faker->realText(20),
            'price' => $this->faker->randomFloat(100,550),
            'qty' => $this->faker->numberBetween(35,42),
//            'seller_id' => $this->faker->numberBetween(1200,1456),
        ];
    }
}
