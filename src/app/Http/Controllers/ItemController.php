<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function  index(Request $request)
    {
        $items = Item::Paginate(8);
        return view('index', compact('items'));
}

    public function detail(Request $request)
    {
        $item = Item::all();
        return view('detail',compact('item'));
    }
}
