<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Store;
use App\Rules\TelNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::check()){
            return view('auth.login');
        }

        $stores = Store::all();
        return view('store.index',[
            'stores' => $stores,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = ['ธนาคารกรุงไทย','ธนาคารกรุงเทพ','ธนาคารกรุงศรีอยุธยา','ธนาคารกสิกรไทย','ธนาคารไทยพาณิชย์'];
        return view('store.create',[
            'banks' => $banks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "storeName" => "required",
            "storeDes" => "required",
            "bankId" => "required",
            "storeTel" => new TelNumber()
        ],
        [
            "storeName.required" => "กรุณากรอกชื่อร้านค้า",
            "storeDes.required" => "กรุณากรอกรายละเอียดร้านค้า",
            "bankId.required" => "กรุณากรอกเลขบัญชีธนาคาร",
        ]
    );

        $store = new Store;
        $store->store_name = $request->input('storeName');
        $store->store_description = $request->input('storeDes');
        $store->user_id = Auth::user()->id;
        $store->store_bank_name = $request->input('store_bank_name');
        $store->store_bank_number = $request->input('bankId');

        $store->save();

        if ($request->file('inpImg')) {
            $img = $request->file('inpImg');
            $store = DB::table('stores')->where("user_id", "=", Auth::user()->id)->first();
            $filename = $store->store_id . ".jpg";
            $path = 'storage/pictures/brand';
            $img->move($path, $filename);
        }

        $store_id = DB::table('stores')->where('user_id', '=', Auth::id())->first()->store_id;

        return redirect()->route('stores.show', ['store' => $store_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if(!Auth::check()){
        //     return view('auth.login');
        // }
        $store = Store::where('store_id', '=', $id)->first();
        $products = DB::table('products')->where('store_id','=', $id)->orderByDesc('updated_at')->get();

        return view('store.show',[
            'store' => $store,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banks = ['ธนาคารกรุงไทย','ธนาคารกรุงเทพ','ธนาคารกรุงศรีอยุธยา','ธนาคารกสิกรไทย','ธนาคารไทยพาณิชย์'];
        $store = DB::table('stores')->where('store_id','=',$id)->first();
        $store1 = DB::table('stores')->select('store_id')->where('user_id','=',Auth::user()->id)->first();
        if(!Auth::check() || Auth::user()->id!=$store->user_id){
            return redirect()->route('stores.show',['store'=>$store->store_id]);
        }
        return view('store.edit',[
            'store' => $store,
            'banks' => $banks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'store_name' => 'required',
            'store_tel' => ['required', new TelNumber],
            'store_bank_name' => 'required',
            'store_bank_number' => ['required','max:10','min:10'],
            'store_description' => 'required',
        ],[
            'store_name.required' => 'กรุณาใส่ชื่อร้านค้า',
            'store_tel.required' => "กรุณากรอกเบอร์โทรศัพท์",
            'store_bank_name.required' => 'กรุณาเลือกธนาคาร',
            'store_bank_number.required' =>  'กรุณากรอกหมายเลขบัญชีธนาคาร',
            'store_bank_number.max' =>  'กรุณากรอกหมายเลขบัญชีธนคารให้ถูกต้อง',
            'store_bank_number.min' =>  'กรุณากรอกหมายเลขบัญชีธนาคารให้ถูกต้อง',
            'store_description.required' => 'กรุณาใส่คำอธิบายร้านค้า'
        ]);
        $store = DB::table('stores')->where('store_id','=',$id)->first();
        $img = $request->file('inpImg');
        if($img){
            $filename = $store->store_id . "." . $img->getClientOriginalExtension();
            $path = 'storage/pictures/stores';
            $img->move($path, $filename);
            DB::table('stores')->where('store_id','=', $store->store_id)->update([
                'store_img_path' => $path . "/" . $filename,
            ]);
        }
        DB::table('stores')->where('store_id','=', $store->store_id)->update([
            'store_name' => $request->store_name,
            "store_description" => $request->store_description,
            'store_tel' => $request->store_tel,
            'store_bank_name' => $request->input("store_bank_name"),
            'store_bank_number' => $request->store_bank_number,
        ]);
        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
