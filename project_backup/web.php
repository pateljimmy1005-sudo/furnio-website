<?php
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/category/{name}', [ProductController::class, 'category'])->name('category');

Route::get('/store',[ProductController::class, 'store'])->name('store');

Route::get('/image-detail/{id}', [ProductController::class, 'imageDetail'])->name('image.detail');

Route::middleware('auth')->group(function () {

    Route::post('/add-to-cart/{id}',
        [ProductController::class, 'addToCart'])
        ->name('cart.add');

    Route::get('/cart',
        [ProductController::class, 'cart'])
        ->name('cart');

    Route::get('/cart/remove/{id}',
        [ProductController::class, 'removeCart'])
        ->name('cart.remove');

    Route::post('/order/place',
        [ProductController::class, 'placeOrder'])
        ->name('order.place');

    Route::get('/orders',
        [ProductController::class, 'orders'])
        ->name('orders');

    Route::get('/cancel-order/{id}',
        [ProductController::class, 'cancelOrder'])
        ->name('cancel.order');

    Route::post('/wishlist/add',
        [WishlistController::class, 'add'])
        ->name('wishlist.add');

    Route::post('/wishlist/remove',
        [WishlistController::class, 'remove'])
        ->name('wishlist.remove');

    Route::get('/wishlist',
        [WishlistController::class, 'index'])
        ->name('wishlist');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::middleware('auth')->group(function () {

    Route::post('/buy-now/{id}',
        [ProductController::class, 'buyNow'])
        ->name('buy.now');

});


Route::middleware(['auth','admin'])->group(function () {

    Route::get('/admin/dashboard',
        [ProductController::class,'dashboard'])
        ->name('admin.dashboard');

    Route::get('/admin/products',
        [ProductController::class, 'adminProducts'])
        ->name('admin.products');

    Route::get('/admin/product/create',
        [ProductController::class, 'createProduct'])
        ->name('admin.product.create');

        
            Route::post('/admin/product/store', [ProductController::class, 'storeProduct'])
        ->name('admin.product.store');
        
        

    Route::get('/admin/product/edit/{id}',
        [ProductController::class, 'editProduct'])
        ->name('admin.product.edit');

    Route::delete('/admin/product/delete/{id}',
        [ProductController::class, 'deleteProduct'])
        ->name('admin.product.delete');
   Route::get('/admin/users', [ProductController::class, 'adminUsers'])
        ->name('admin.users');

            Route::get('/admin/orders', [ProductController::class, 'adminOrders'])
        ->name('admin.orders');
});


Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');


require __DIR__.'/auth.php';


Route::get('/shop', function () {
    return view('shop.index');
});

Route::get('/about', [AboutController::class, 'index']);

Route::get('/admin/about', [AboutController::class, 'edit']);

Route::post('/admin/about/update', [AboutController::class, 'update']);

Route::get('/success', function () {
    return view('success');
})->name('success');








Route::get('/admin/order/delivered/{id}',
    [ProductController::class, 'deliveredOrder'])
    ->name('admin.order.delivered');

Route::get('/admin/order/cancel/{id}',
    [ProductController::class, 'cancelAdminOrder'])
    ->name('admin.order.cancel');

Route::get('/admin/order/delete/{id}',
    [ProductController::class, 'deleteOrder'])
    ->name('admin.order.delete');


Route::get('/admin/user/delete/{id}',
    [ProductController::class, 'deleteUser'])
    ->name('admin.user.delete');

Route::get('/admin/user/block/{id}',
    [ProductController::class, 'blockUser'])
    ->name('admin.user.block');

Route::get('/admin/user/role/{id}',
    [ProductController::class, 'changeRole'])
    ->name('admin.user.role');

Route::get('/admin/user/profile/{id}',
    [ProductController::class, 'userProfile'])
    ->name('admin.user.profile');

 Route::put('/admin/product/update/{id}', [ProductController::class, 'updateProduct'])
    ->name('admin.product.update');




Route::get('/contact', function () {

    return view('contact');

})->name('contact');

Route::post('/contact-store',
    [ContactController::class, 'contact'])
    ->name('contact.store');