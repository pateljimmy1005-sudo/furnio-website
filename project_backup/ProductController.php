<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;

class ProductController extends Controller
{
    
    public function index()
    {
        $data = Product::with('images')->get();
        return view('home', compact('data'));
    }


    public function store()
    {
        $data = Product::with('images')->get();
        return view('store', compact('data'));
    }

    // CATEGORY
    public function category($name)
    {
        $product = Product::where('category', $name)->first();

        if (!$product) {
            abort(404);
        }

        $products = ProductImage::where('product_id', $product->id)->get();

        return view('category', compact('products', 'name'));
    }

    // IMAGE DETAIL
    public function imageDetail($id)
    {
        $img = ProductImage::findOrFail($id);
        return view('image-detail', compact('img'));
    }

    // ADD TO CART
    public function addToCart($id)
    {
        $img = ProductImage::findOrFail($id);

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $img->id)
            ->first();

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $img->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart');
    }

    // CART
    public function cart()
    {
        $cart = Cart::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('cart', compact('cart'));
    }

    // BUY NOW
    public function buyNow($id)
    {
        $img = ProductImage::findOrFail($id);

        Order::create([
            'user_id' => auth()->id(),
            'product_id' => $img->id,
            'name' => 'User',
            'phone' => '0000000000',
            'address' => 'N/A',
            'quantity' => 1,
            'total_price' => $img->price,
            'payment_method' => 'COD',
            'status' => 'pending',
        ]);

        return redirect()->route('orders');
    }

    // ORDERS
    public function orders()
    {
        $orders = Order::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders', compact('orders'));
    }

    // REMOVE CART
    public function removeCart($id)
    {
        Cart::findOrFail($id)->delete();
        return back();
    }

    // CANCEL ORDER
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return back();
    }

    // PLACE ORDER
    public function placeOrder(Request $request)
    {
        return redirect()->route('success')
            ->with('success', 'Order Placed Successfully');
    }

    // SHOP
    public function shop()
    {
        $products = ProductImage::latest()->get();
        return view('shop.index', compact('products'));
    }

    // ADMIN DASHBOARD
    public function dashboard()
    {
        $products = Product::count();
        $orders = Order::count();
        $users = User::count();

        return view('admin.dashboard', compact('products','orders','users'));
    }

    // ADMIN PRODUCTS
    public function adminProducts()
    {
        $products = Product::latest()->get();
        return view('admin.products', compact('products'));
    }

    // CREATE PRODUCT PAGE
    public function createProduct()
    {
        return view('admin.create-product');
    }

    // STORE PRODUCT
public function storeProduct(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'category' => 'required',
        'image' => 'required',
        'material' => 'required',
        'color' => 'required',
        'stock' => 'required|numeric',
        'discount' => 'required|numeric',
    ]);

    Product::create([

        'name' => $request->name,

        'price' => $request->price,

        'description' => $request->description,

        'category' => $request->category,

        'image' => $request->image,

        'material' => $request->material,

        'color' => $request->color,

        'stock' => $request->stock,

        'discount' => $request->discount,

    ]);

    return redirect()->route('admin.products')
        ->with('success', 'Product Added Successfully');
}
    // EDIT PRODUCT
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

    // UPDATE PRODUCT
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.products');
    }

    // DELETE PRODUCT
    public function deleteProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }

    // ADMIN ORDERS
    public function adminOrders()
    {
        $orders = Order::with('product')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

 




// DELIVERED
public function deliveredOrder($id)
{
    $order = Order::findOrFail($id);

    $order->status = 'delivered';

    $order->save();

    return redirect()->back();
}



// CANCEL
public function cancelAdminOrder($id)
{
    $order = Order::findOrFail($id);

    $order->status = 'cancelled';

    $order->save();

    return redirect()->back();
}



// DELETE
public function deleteOrder($id)
{
    $order = Order::findOrFail($id);

    $order->delete();

    return redirect()->back();
}






// USERS PAGE
public function adminUsers(Request $request)
{
    $search = $request->search;

    $users = User::where('name', 'LIKE', "%$search%")
        ->latest()
        ->paginate(5);

    return view('admin.users',
        compact('users'));
}



// DELETE USER
public function deleteUser($id)
{
    $user = User::findOrFail($id);

    $user->delete();

    return redirect()->back()
        ->with('success', 'User Deleted');
}



// BLOCK USER
public function blockUser($id)
{
    $user = User::findOrFail($id);

    $user->status = 'blocked';

    $user->save();

    return redirect()->back()
        ->with('success', 'User Blocked');
}



public function changeRole($id)
{
    $user = User::findOrFail($id);

    if($user->role == 'admin')
    {
        $user->role = 'user';
    }
    else
    {
        $user->role = 'admin';
    }

    $user->save();

    return redirect()->back()
        ->with('success', 'Role Updated');
}



// USER PROFILE
public function userProfile($id)
{
    $user = User::findOrFail($id);

    return view('admin.user-profile',
        compact('user'));
}







}