<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function  index(Request $request)
    {
        $items = Item::Paginate(8);
        return view('item.index', compact('items'));
}

    public function detail($id)
    {
        $item = Item::find($id);
        return view('item.detail',compact('item'));
    }
}
