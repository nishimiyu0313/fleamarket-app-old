<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
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
    public function  address(Request $request)
    {
        return view('payment.address');
    }
}
