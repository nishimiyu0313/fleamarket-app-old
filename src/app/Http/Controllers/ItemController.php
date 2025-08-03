<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller

{
    public function  list(Request $request)
    {
        $items = Item::Paginate(8);
        return view('item.index', compact('items'));
}
    public function  mylist(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $favoriteItems = $user->likedItems()->latest()->paginate(8);

        return view('item.mylist', compact('favoriteItems', 'user'));
    }


    public function detail($id)
    {
        $item = Item::find($id);
        return view('item.detail',compact('item'));
    }
    public function  storeComment(Request $request, $itemId)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'item_id' => $itemId,
            'content' => $request->input('content')
        ]);
        return redirect('/item/{item_id}');
    }
    public function like($id)
    {
        $item = Item::find($id);
        $user = Auth::user();

        $item->likedUsers()->attach($user->id);

        return view('item.detail', compact('item', 'user'));
    }
    public function unlike($id)
    {
        $item = Item::find($id);
        $user = Auth::user();

        $item->likedUsers()->detach($user->id);

        return view('item.detail', compact('item', 'user'));
    }
    

    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Item::query();
        if (!empty($keyword)) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        // dd($query);
        $items = $query->paginate(8);

        return view('item.index', compact('items', 'keyword'));
}
    public function  profileBuy(Request $request)
    {
       
        $user = Auth::user();
        $boughtItems = Item::where('buyer_id', $user->id)->latest()->paginate(8);
     
        return view('item.profilebuy', compact('user', 'boughtItems'));
    }

    public function  profileSell(Request $request)
    {
        $user = Auth::user();
       $listedItems  = Item::where('user_id', $user->id)->latest()->paginate(8);
        return view('item.profilesell', compact('user', 'listedItems'));
    }

    public function  index() 
    {
        $conditions = Condition::all();
        return view('item.sell', compact('conditions'));
    }

    public function  sell(Request $request)
    {
       
    
        $imagePath = $request->image->store('images', 'public');
        $condition = Condition::find($request->condition_id);
    


        Item::create([
            
                'name' => $request->name,
                'condition_id' => $request->condition_id,
                'brand_name' => $request->brand_name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $imagePath,
                'user_id' => Auth::id()
               
            ]);


        return view('item.profilebuy', compact('condition', 'imagePath'));
    }

    
}
            