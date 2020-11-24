<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $rec_images = [
            "เสื้อผู้ชาย" => 'storage/pictures/icon/male_clothe.png',
            "เสื้อผู้หญิง" => 'storage/pictures/icon/female_clothe.png',
            "รองเท้าผู้ชาย" => 'storage/pictures/icon/male_shoe.png',
            "รองเท้าผู้หญิง" => 'storage/pictures/icon/female_shoes.png',
            "กระเป๋า" => 'storage/pictures/icon/bag.png'
        ];

        $stores = Store::all();
        return view('pages.home',[
            'rec_images' => $rec_images,
            'stores' => $stores,
        ]);
    }
}
