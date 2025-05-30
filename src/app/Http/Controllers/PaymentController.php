<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Item;

class PaymentController extends Controller
{
    public function  index($id)
    {
        $item = Item::find($id);
        return view('payment.purchase',compact('item'));
    }
}
