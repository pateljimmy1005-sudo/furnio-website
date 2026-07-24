<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ProductImage;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if(!$exists)
        {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
        }

        return back()->with('success', 'Added To Wishlist');
    }

    public function remove(Request $request)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->delete();

        return back()->with('success', 'Removed From Wishlist');
    }

    public function index()
    {
        $userId = auth()->id();

        $wishlistItems = Wishlist::with('product.featuredImage')->where('user_id', $userId)->get();
        $products = $wishlistItems->pluck('product')->filter();

        return view('wishlist', compact('products'));
    }
}