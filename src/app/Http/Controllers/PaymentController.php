<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Payment;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function  index($id)
    {
        $item = Item::find($id);
        $user = Auth::user();
        $profile = $user->profile;
        $payments = Payment::select('content')->distinct()->get();
        return view('payment.purchase',compact('item', 'user', 'payments', 'profile'));
    }
    public  function payment(Request $request)
    {
        $item = Item::find($request->product_id);

        Payment::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,
            'content' => $request->content,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,

        ]);
        return view('payment.purchase');
    }
}

