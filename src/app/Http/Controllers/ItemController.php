<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Comment;
use App\Models\Condition;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function list()
    {
        $items = Item::Paginate(8);
        return view('item.index', compact('items'));
    }
    public function mylist()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $favoriteItems = $user->likedItems()->latest()->paginate(8);


        return view('item.mylist', compact('favoriteItems', 'user'));
    }
    public function detail($id)
    {
        $item = Item::with(['condition'])->withCount('comments')->findOrFail($id);
        return view('item.detail', compact('item'));
    }
    public function like(Item $item)
    {
        $user = Auth::user();
        $item->likedUsers()->attach($user->id);

        return redirect()->back(); 
    }

    public function unlike(Item $item)
    {
        $user = Auth::user();
        $item->likedUsers()->detach($user->id);

        return redirect()->back();
    }

    public function commentStore(Request $request, Item $item)
    {
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->item_id = $item->id;
        $comment->save();

        return back()->with('success', 'コメントを投稿しました');
    }
    public function index()
    {
        $categories = Category::all();
        $conditions = Condition::all();
        return view('item.sell', compact('conditions', 'categories'));

        return view('item.sell');
    }
    public function sell(Request $request)
    {
        $imagePath = $request->image->store('images', 'public');
        $conditions = Condition::all();      



        $item = Item::create([
            'name' => $request->name,
           
            'condition_id' => $request->condition_id,
            'brand_name' => $request->brand_name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'user_id' => Auth::id()
        ]);
        return view('item.sell', compact('imagePath', 'item', 'conditions'));
    }


    public function  profileSell(Request $request)
    {
        $user = Auth::user();
        $listedItems  = Item::where('user_id', $user->id)->latest()->paginate(8);
        return view('item.profilesell', compact('user', 'listedItems'));
    }
    public function  profileBuy(Request $request)
    {
        return view('item.profilesbuy',);
    }
}
