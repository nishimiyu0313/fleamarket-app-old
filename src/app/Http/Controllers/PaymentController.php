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
            // ログインしてなければリダイレクト（または例外）
            return redirect()->route('login');
        }
       
        $profile = $user->profile;
        $payments = Payment::select('content')->distinct()->get();
        return view('payment.purchase', compact('item', 'user', 'payments', 'profile'));
    }
    public  function payment(Request $request, $item_id)
    {
        //dd($request->all());
        $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();
        $profile = $user->profile;

        $postal_code = $request->postal_code ?? $profile->postal_code;
        $address = $request->address ?? $profile->address;
        $building = $request->building ?? $profile->building;

        $payment = Payment::where('user_id', $user->id)
            ->where('item_id',  $item_id)
            ->first();

             if ($payment) {
        $payment->status = Payment::STATUS_COMPLETED;
        $payment->save();
    } else {
                    
        Payment::create([
            'user_id' => Auth::id(),
            'item_id' => $item_id,
           'content' => $request->content,
            'postal_code' => $postal_code,
            'address' => $address,
            'building' => $building,
            'status' => Payment::STATUS_COMPLETED,
        ]);       
    }
    return redirect('/');
}
}