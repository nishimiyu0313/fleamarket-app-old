<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

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
    
    
    public function search(Request $request)
    {
        $query = Item::query();
        if ($request->keyword) {
            $query = $query->where('name', 'LIKE', "%{$request->keyword}%");
        }
        $items = $query->paginate(8);
        return view('item.index', compact('items'));

}
}