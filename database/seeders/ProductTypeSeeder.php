<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Database\Factories\ProductTypeFactory;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_Bshirt = ['เสื้อเชิ้ต','เสื้อแจ๊คเก็ต','เสื้อกล้าม'];
        $array_Gshirt = ['เสื้อยืด','เดรส'];
        $array_Bshoes = ['รองเท้าผ้าใบ','รองเท้าแตะ'];
        $array_Gshoes = ['รองเท้าส้นสูง', 'รองเท้ารัดส้น'];
        $array_Bag = ['กระเป๋าสะพายหลัง','กระเป๋าสะพายข้าง'];
        $array_primary = [
            'เสื้อผ้าผู้ชาย' => $array_Bshirt,
            'เสื้อผ้าผู้หญิง' => $array_Gshirt,
            'รองเท้าผู้ชาย' => $array_Bshoes,
            'รองเท้าผู้หญิง' => $array_Gshoes,
            'กระเป๋า' => $array_Bag,
        ];

        $product = new ProductType;
        foreach ($array_primary as $key=>$primary){
            foreach ($primary as $type){
                $product->product_primary_type = $key;
                $product->product_secondary_type = $type;
                $product->save();
                $product = new ProductType;
            }
        }
    }
}
