<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return back()->with('error', 'This product is out of stock.');
        }

        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($cart) {
                if ($cart->quantity + 1 > $product->stock) {
                    return back()->with('error', 'Cannot add more than available stock.');
                }
                $cart->quantity += 1;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                if ($cart[$id]['quantity'] + 1 > $product->stock) {
                    return back()->with('error', 'Cannot add more than available stock.');
                }
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'product_id' => $product->id,
                    'quantity' => 1,
                ];
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function cart()
    {
        if (auth()->check()) {
            $cart = Cart::with('product.featuredImage')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        } else {
            $sessionCart = session()->get('cart', []);
            $cart = collect();
            foreach ($sessionCart as $item) {
                $product = Product::with('featuredImage')->find($item['product_id']);
                if ($product) {
                    $cart->push((object)[
                        'id' => 'session_'.$product->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'product' => $product,
                    ]);
                }
            }
        }

        return view('cart', compact('cart'));
    }

    public function removeCart($id)
    {
        if (auth()->check()) {
            $cart = Cart::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

            $cart->delete();
        } else {
            $productId = str_replace('session_', '', $id);
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }

        return back()->with('success', 'Item removed from cart');
    }
}
