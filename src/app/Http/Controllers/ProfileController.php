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
        $profile = Profile::find($id);
        $user = Auth::user();
        return view('payment.address', compact('item', 'user', 'profile'));
    }
    public function  updateAddress(Request $request)
    {

        $address = $request->only([
            'postal_code',
            'address',
            'building',
        ]);
        
        $user = Auth::user();
        Payment::create($address);
        return redirect('payment.purchase', compact('address', 'user'));
    }
}
