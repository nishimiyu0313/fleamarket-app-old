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
        if (!$user) {
            
            return redirect()->route('login');
        }
       
        $profile = $user->profile;
        $payments = Payment::select('content')->distinct()->get();
        return view('payment.purchase', compact('item', 'user', 'payments', 'profile'));
    }
    public function payment(PurchaseRequest $request, $item_id)
    {
        $item = Item::find($item_id);

        
        if ($item && $item->sold) {
            return redirect()->back()->withErrors(['msg' => 'この商品は既に購入済みです。']);
        }
        $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();

        $payment = Payment::where('user_id', $user->id)
            ->where('item_id', $item_id)
            ->first();

        
        if ($payment) {
            $payment->update([
                'content' => $request->content,
                'status' => Payment::STATUS_COMPLETED,
            ]);
        } else {
           
            $profile = $user->profile;

            Payment::create([
                'user_id'     => $user->id,
                'item_id'     => $item_id,
                'content'     => $request->content,
                'postal_code' => $profile->postal_code,
                'address'     => $profile->address,
                'building'    => $profile->building,
                'status'      => Payment::STATUS_COMPLETED,
            ]);
        }
        $item = Item::find($item_id);
        if ($item) {
            $item->is_sold = true;
            $item->save();
        }

        return redirect('/');
    }
}