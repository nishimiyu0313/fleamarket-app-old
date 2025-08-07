<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('payment.purchase',compact('item', 'user'));
    }
    public  function payment(Request $request)
    {
        $item = Item::find($request->product_id);

        Payment::create([
            'user_id' => Auth::id(),
            'item_id' => $item->id,

        ]);
    }       
    }
    

