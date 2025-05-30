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
        Profile::create(
            [
                'user_id' => Auth::id(),
                'postal_code' =>  $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]);
        $profile['image'] = $request->image->store('img', 'public');
        return redirect('/item',compact('item'));
}
}
