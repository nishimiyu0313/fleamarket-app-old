<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Payment;
use App\Models\Item;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        
        return view('payment.purchase', compact('item', 'user', 'profile'));
    }
    public function payment(PurchaseRequest $request, $item_id)
    {
        
       // Log::debug('payment() メソッド開始');
        $item = Item::find($item_id);

        if (!$item) {
            //Log::debug('商品が見つからない');
            abort(404);
        }

        if ($item->is_sold) {
            //Log::debug('既に購入済み');
            return redirect()->back()->withErrors(['msg' => 'この商品は既に購入済みです。']);
        }

        $user = Auth::user();
       // Log::debug('ユーザーID: ' . (isset($user) && $user->id ? $user->id : 'null'));
  

        $payment = Payment::where('user_id', $user->id)
            ->where('item_id', $item_id)
            ->first();
        
        if ($payment) {
            $payment->update([
                'content' => $request->content,
                'status' => Payment::STATUS_COMPLETED,
            ]);
            //Log::debug('既存のPaymentを更新');
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
       // Log::debug('item->is_sold変更前: ' . $item->is_sold);
        $item->is_sold = true;
        
        $item->save();
        //Log::debug('item->is_sold変更後: ' . $item->is_sold);
        //$item->forceFill(['is_sold' => true])->save();


        return redirect('/');
    }
    
}