<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {

        $sum = Cart::where('user_id','=',Auth::user()->id)->join('products','products.product_id','=','carts.product_id')->select(DB::raw('products.price*carts.qty as total'))->pluck('total')->sum();
        $cart = Cart::where('user_id','=',Auth::user()->id)->join('products','products.product_id','=','carts.product_id')->select('carts.product_id','price','products.*',DB::raw('carts.qty as amount'))->get();
        $address = Address::where("user_id", "=", Auth::user()->id)->orderBy("default", "desc")->first();

        return view('pages.cart',[
            'carts' => $cart,
            'address' => $address,
            'sum' => $sum
        ]);
    }

    public function store(Request $request,$id){
        $request->validate([
            'qty' => ['required', 'numeric', 'integer']
        ],[
            'qty.required' => 'กรุณากรอกจำนวน',
            'qty.numeric' => 'กรุณากรอกตัวเลข',
            'qty.integer' => 'กรุณากรอกจำนวนเต็ม',
        ]);
        $cart = Cart::where('user_id', '=', Auth::user()->id)->where('product_id', '=', $id);
        if ($cart->count()==1){
            $count = $cart->get()[0]->qty + $request->input('qty');
            $cart->update([
                'qty'=> $count,
            ]);
            return redirect()->route('cart');
        }
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $id;
        $cart->qty = $request->input('qty');
        $cart->save();
        return redirect()->route('cart');
    }

    public function update(Request $request,$id){
        DB::table('carts')->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $id)
        ->update([
            'qty' => $request->input('amount'),
        ]);
    }

    public function destroy($id)
    {
        DB::table('carts')->where('user_id', '=', Auth::user()->id)->where('product_id', '=', $id)->delete();
        return redirect()->route('cart');
    }

}
