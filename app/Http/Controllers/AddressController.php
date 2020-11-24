<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Rules\TelNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.add_address');
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
            'new_receiver' => ['required'],
            'new_address' => ['required'],
            'new_tel' => ['required', new TelNumber],
        ]);

        $new_addr = new Address();
        $new_addr->user_id = Auth::user()->id;
        $new_addr->receiver = $request->input('new_receiver');
        $new_addr->address = $request->input('new_address');
        $new_addr->telephone = $request->input('new_tel');
        $new_addr->no = Address::where("user_id", "=", Auth::user()->id)->count() + 1;

        if (Address::where("user_id", "=", Auth::user()->id)->count() == 0) {
            $new_addr->default = true;
        }

        $new_addr->save();

        return redirect()->route('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addr = Address::where('user_id', '=', Auth::user()->id)->where('no', '=', $id)->first();
        return view('profile.edit_address', [
            'addr' => $addr
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
            'new_receiver' => ['required'],
            'new_address' => ['required'],
            'new_tel' => ['required', new TelNumber],
        ]);

        Address::where('user_id', '=', Auth::user()->id)->where('no', '=', $id)
        ->update([
            'receiver' => $request->input('new_receiver'),
            'telephone' => $request->input('new_tel'),
            'address' => $request->input('new_address')
        ]);

        return redirect()->route('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mustSetDefault = Address::where('user_id', '=', Auth::user()->id)->where('no', '=', $id)->get()[0]->default;

        Address::where('user_id', '=', Auth::user()->id)->where('no', '=', $id)->delete();
        Address::where('user_id', '=', Auth::user()->id)->where('no', '>', $id)->decrement('no');

        if ($mustSetDefault) {
            Address::where('user_id', '=', Auth::user()->id)->where('no', '=', 1)->update(array('default' => true));
        }

        return redirect()->route('profile');
    }

    public function changeDefaultAddress($id) {
        Address::where('user_id', '=', Auth::user()->id)->where('default', '=', true)->update(array('default' => false));
        Address::where('user_id', '=', Auth::user()->id)->where('no', '=', $id)->update(array('default' => true));

        return redirect()->route('profile');
    }
}
