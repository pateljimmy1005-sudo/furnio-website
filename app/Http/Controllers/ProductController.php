<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private function uploadProductImage(Request $request): string
    {
        // Double-check validation inside the helper to prevent bypassing
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $image = $request->file('image');
        $path = $image->store('products', 'public');

        return 'storage/' . $path;
    }

    private function deleteImageFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        // Handle both old 'uploads/products' and new 'storage/products'
        if (str_starts_with($path, 'storage/')) {
            $storagePath = str_replace('storage/', '', $path);
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($storagePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($storagePath);
            }
        } else {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }
    }

    private function storefrontQuery()
    {
        return Product::with('featuredImage')->where('is_active', true);
    }

    public function index()
    {
        $featuredProducts = Product::with('images')->where('is_active', true)->latest()->take(8)->get();
        $reviews = \App\Models\Review::with(['user', 'product'])->where('rating', '>=', 4)->latest()->take(6)->get();
        $data = $featuredProducts;

        return view('home', compact('data', 'featuredProducts', 'reviews'));
    }


    public function search(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'material' => 'nullable|string|max:100',
            'color' => 'nullable|string|max:100',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
            'sort' => 'nullable|string|in:latest,price_asc,price_desc,name_asc,name_desc'
        ]);

        $search = $request->input('search');
        $categoryFilter = $request->input('category');
        $materialFilter = $request->input('material');
        $colorFilter = $request->input('color');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $sort = $request->input('sort', 'latest');

        $query = $this->storefrontQuery();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%");
            });
        }

        if ($categoryFilter) {
            $query->where('category', $categoryFilter);
        }

        if ($materialFilter) {
            $query->where('material', $materialFilter);
        }

        if ($colorFilter) {
            $query->where('color', $colorFilter);
        }

        if (is_numeric($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        if (is_numeric($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $data = $query->get();

        $categories = Product::select('category')->whereNotNull('category')->where('category', '!=', '')->distinct()->pluck('category');
        $materials = Product::select('material')->whereNotNull('material')->where('material', '!=', '')->distinct()->pluck('material');
        $colors = Product::select('color')->whereNotNull('color')->where('color', '!=', '')->distinct()->pluck('color');

        return view('search', compact(
            'data', 'search', 'categoryFilter', 'materialFilter', 
            'colorFilter', 'minPrice', 'maxPrice', 'sort', 
            'categories', 'materials', 'colors'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $request->input('search');

        $data = $this->storefrontQuery()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('description', 'LIKE', "%{$search}%")
                      ->orWhere('category', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('store', compact('data', 'search'));
    }
    public function category($name)
    {
        $categoryName = trim(str_replace('+', ' ', urldecode($name)));

        $products = $this->storefrontQuery()
            ->where(function ($query) use ($categoryName) {
                $query->where('category', 'LIKE', $categoryName)
                      ->orWhere('category', 'LIKE', '%' . $categoryName . '%')
                      ->orWhereRaw('LOWER(category) = ?', [strtolower($categoryName)]);
            })
            ->latest()
            ->get();

        if ($products->isEmpty()) {
            $words = explode(' ', $categoryName);
            $firstWord = $words[0] ?? $categoryName;
            $products = $this->storefrontQuery()
                ->where('category', 'LIKE', '%' . $firstWord . '%')
                ->latest()
                ->get();
        }

        $name = $categoryName;

        return view('category', compact('products', 'name'));
    }

public function imageDetail($id, \Illuminate\Http\Request $request)
{
    $sort = $request->query('sort', 'recent');

    $reviewQuery = function ($q) use ($sort) {
        $q->with('user');
        if ($sort === 'highest') {
            $q->orderBy('rating', 'desc')->orderBy('created_at', 'desc');
        } elseif ($sort === 'lowest') {
            $q->orderBy('rating', 'asc')->orderBy('created_at', 'desc');
        } else {
            $q->orderBy('created_at', 'desc');
        }
    };

    $product = Product::with([
        'images',
        'reviews' => $reviewQuery,
    ])->findOrFail($id);

    if (!$product->is_active && (!auth()->check() || auth()->user()->role !== 'admin')) {
        return redirect()->route('store')->with('info', 'This product is currently unavailable.');
    }

    $hasPurchased = false;
    if (auth()->check()) {
        $hasPurchased = Order::where('user_id', auth()->id())
            ->whereIn('status', ['Delivered', 'Completed'])
            ->whereHas('items', function($q) use ($id) {
                $q->where('product_id', $id);
            })
            ->exists();
    }

    // Get list of user_ids who have a verified completed/delivered purchase for this product
    $verifiedUserIds = Order::whereIn('status', ['Delivered', 'Completed'])
        ->whereHas('items', function($q) use ($id) {
            $q->where('product_id', $id);
        })
        ->pluck('user_id')
        ->unique()
        ->toArray();

    return view('image-detail', compact('product', 'hasPurchased', 'verifiedUserIds', 'sort'));
}

public function toggleProductStatus($id)
{
    $product = Product::findOrFail($id);
    $product->is_active = !$product->is_active;
    $product->save();

    $statusText = $product->is_active ? 'Active' : 'Inactive';
    return redirect()->back()->with('success', "Product status updated to {$statusText}.");
}

    public function cancelOrder($id)
    {
        $order = Order::with('items')->where('user_id', auth()->id())->findOrFail($id);

        if (strtolower($order->status->value) === 'delivered') {
            return back()->with('error', 'Delivered orders cannot be cancelled.');
        }

        if (strtolower($order->status->value) === 'cancelled') {
            return back()->with('info', 'Order is already cancelled.');
        }

        $order->status = 'Cancelled';
        $order->save();

        foreach ($order->items as $item) {
            $product = \App\Models\Product::find($item->product_id);
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }

        return back()->with('success', 'Order cancelled successfully.');
    }



    
    public function shop()
    {
        $products = $this->storefrontQuery()->latest()->get();
        return view('shop.index', compact('products'));
    }


    public function adminProducts()
    {
        $products = Product::with('images')->latest()->get();
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.create-product');
    }

public function storeProduct(\App\Http\Requests\StoreProductRequest $request)
{

    $imagePath = $this->uploadProductImage($request);

    $product = Product::create([
        'name'        => $request->name,
        'price'       => $request->price,
        'description' => $request->description,
        'category'    => $request->category,
        'image'       => $imagePath,
        'material'    => $request->material,
        'color'       => $request->color,
        'stock'       => $request->stock,
        'discount'    => $request->discount ?? 0,
        'is_active'   => $request->has('is_active') ? $request->boolean('is_active') : true,
    ]);

    ProductImage::create([
        'product_id'  => $product->id,
        'image'       => $imagePath,
        'sort_order'  => 0,
        'is_featured' => true,
    ]);

    return redirect()
        ->route('admin.products')
        ->with('success', 'Product Added Successfully');
}
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }

public function updateProduct(\App\Http\Requests\UpdateProductRequest $request, $id)
{
    $product = Product::with('images')->findOrFail($id);

    if ($request->hasFile('image')) {
        $this->deleteImageFile($product->image);
        $imagePath = $this->uploadProductImage($request);
        $product->image = $imagePath;
    }

    $product->fill([
        'name'        => $request->name,
        'price'       => $request->price,
        'description' => $request->description,
        'category'    => $request->category,
        'material'    => $request->material,
        'color'       => $request->color,
        'stock'       => $request->stock,
        'discount'    => $request->discount ?? 0,
        'is_active'   => $request->has('is_active') ? $request->boolean('is_active') : $product->is_active,
    ]);

    $product->save();

    $featuredImage = $product->images->firstWhere('is_featured', true)
        ?? $product->images->first();

    if ($featuredImage) {
        if ($request->hasFile('image')) {
            $this->deleteImageFile($featuredImage->image);
            $featuredImage->image = $product->image;
            $featuredImage->save();
        }
    } else {
        ProductImage::create([
            'product_id'  => $product->id,
            'image'       => $product->image,
            'sort_order'  => 0,
            'is_featured' => true,
        ]);
    }

    return redirect()
        ->route('admin.products')
        ->with('success', 'Product Updated Successfully');
}

    public function deleteProduct($id)
    {
        $product = Product::with('images')->findOrFail($id);

        $this->deleteImageFile($product->image);

        foreach ($product->images as $image) {
            if ($image->image !== $product->image) {
                $this->deleteImageFile($image->image);
            }
        }

        ProductImage::where('product_id', $product->id)->delete();
        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }

    public function adminOrders(Request $request)
    {
        $search = $request->search;

        $orders = Order::with('items.product.featuredImage')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('phone', 'LIKE', "%{$search}%")
                             ->orWhere('id', 'LIKE', "%{$search}%")
                             ->orWhere('address', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->get();
            
        return view('admin.orders', compact('orders', 'search'));
    }

public function updateOrderStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Created,Cancelled,Delivered',
    ]);

    $order = Order::with('items')->findOrFail($id);

    if (strtolower($order->status->value) !== 'cancelled' && strtolower($request->status) === 'cancelled') {
        foreach ($order->items as $item) {
            $product = \App\Models\Product::find($item->product_id);
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }
    } elseif (strtolower($order->status->value) === 'cancelled' && strtolower($request->status) !== 'cancelled') {
        foreach ($order->items as $item) {
            $product = \App\Models\Product::find($item->product_id);
            if ($product) {
                $product->decrement('stock', $item->quantity);
            }
        }
    }

    $order->status = $request->status;

    if ($request->status === 'Delivered' && strtolower($order->payment_method) === 'cod') {
        $order->payment_status = 'paid';
    }

    $order->save();

    return redirect()->back()->with('success', 'Order status updated to ' . $request->status . '.');
}

public function deleteOrder($id)
{
    $order = Order::with('items')->findOrFail($id);

    if (strtolower($order->status->value) !== 'cancelled') {
        foreach ($order->items as $item) {
            $product = \App\Models\Product::find($item->product_id);
            if ($product) {
                $product->increment('stock', $item->quantity);
            }
        }
    }

    $order->items()->delete();
    $order->delete();

    return redirect()->back()->with('success', 'Order deleted successfully.');
}






}
