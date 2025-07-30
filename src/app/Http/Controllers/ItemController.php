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

    
    public function search(Request $request)
    {
        $query = Item::query();
        if ($request->keyword) {
            $query = $query->where('name', 'LIKE', "%{$request->keyword}%");
        }

        switch ($request->sort) {
            case '1':
                $query->orderBy('price', 'desc')->get();
            case '2':
                $query->orderBy('price', 'asc')->get();
            }
        $items = $query->paginate(8);
        return view('item.index', compact('items'));
}
    public function  profileBuy(Request $request)
    {
        return view('item.profilebuy');
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
            