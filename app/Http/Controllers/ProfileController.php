<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Owner;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use App\Rules\TelNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        $addresses = Address::where("user_id", "=", Auth::user()->id)
                    ->orderBy("default", "desc")
                    ->get();
        $store = Store::where('user_id', "=", Auth::user()->id)->first();

        return view('profile.index', [
            'addrs' =>  $addresses,
            'store' => $store,
        ]);
    }


    public function showEditProfile() {
        return view('profile.edit_profile');
    }

    public function editProfile(Request $request) {
        $request->validate([
            'new_name' => ['required', 'max:30', 'string'],
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if ($request->file('inpImg')) {
            $img = $request->file('inpImg');
            $filename = Auth::user()->id . ".jpg";
            $path = 'storage/pictures/avatars';
            $img->move($path, $filename);
            $user->profile_photo_path = $path . "/" . $filename;
        }

        $user->name = $request->input('new_name');
        $user->save();

        return redirect()->route('profile');
    }
}
