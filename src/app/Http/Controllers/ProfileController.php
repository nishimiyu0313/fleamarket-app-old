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
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $profile = $request->only([
            'postal_code',
            'address',
            'building',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $profile['image'] = $path;
        }
        $profile['user_id'] = $user->id;
        Profile::create($profile);
        return redirect('/');
    }

    public function  profile(Request $request)
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $profile = $request->only([
            'postal_code',
            'address',
            'building',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $profile['image'] = $path;
        }
        $user->profile->update($profile);
        return redirect('/');
    }




    public function  address($id)
    {
        $item = Item::find($id);
        $user = Auth::user();
        return view('payment.address', compact('user', 'item'));
    }
    public function  updateAddress(Request $request)
    {
        $user = Auth::user();
        $address = $request->only([
            'postal_code',
            'address',
            'building',
        ]);

        Payment::create($address);
        return redirect('payment.purchase', compact('address', 'user'));
    }
}