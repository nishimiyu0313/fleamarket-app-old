<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Payment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function  index(Request $request)
    {
        return view('profile.profile');
    }

    public function store(Request $request)
    {
        $profile = $request->only([
            'postal_code',
            'address',
            'building',
        ]);
        $profile['image'] = $request->image->store('img', 'public');
        $profile['user_id'] = Auth::id();
        Profile::create($profile);
        return redirect('/');
}
    public function  address($id)
    {
        $item = Item::find($id);
        $user = Auth::user();
        return view('payment.address', compact('item', 'user'));
    }
    public function  updateAddress(Request $request)
    {
        
        Payment::create([

            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
            'user_id' => Auth::id()

        ]);
        return view('payment.purchase');
    }
}
