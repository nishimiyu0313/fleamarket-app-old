<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function  profile(Request $request)
    {
        return view('profile');
    }

    public function store(Request $request)
    {
        Profile::create(
            [
                'user_id' => Auth::id(),
                'postal_code' => Auth::id(),
                'address' => $request->address,
                'building' => $request->building,
            ]);
        return redirect('/item');
}
