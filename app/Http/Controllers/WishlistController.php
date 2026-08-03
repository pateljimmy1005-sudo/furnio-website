<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\ProductImage;

class WishlistController extends Controller
{
    public function add(Request $request, $id = null)
    {
        $productId = $request->product_id ?? $id;

        if (!$productId) {
            return back()->with('error', 'Invalid product!');
        }

        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        if(!$exists)
        {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
            return back()->with('success', 'Product added to Wishlist successfully!');
        }

        return back()->with('info', 'Product is already in your Wishlist!');
    }

    public function remove(Request $request, $id = null)
    {
        $productId = $request->product_id ?? $id;

        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->delete();

        return back()->with('success', 'Product removed from Wishlist successfully!');
    }

    public function index()
    {
        $userId = auth()->id();

        $wishlistItems = Wishlist::with('product.featuredImage')->where('user_id', $userId)->get();
        $products = $wishlistItems->pluck('product')->filter();

        return view('wishlist', compact('products'));
    }
}