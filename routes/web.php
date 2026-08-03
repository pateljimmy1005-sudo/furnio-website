<?php
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/category/{name}', 'category')->name('category');
    Route::get('/store', 'store')->name('store');
    Route::get('/search', 'search')->name('search');
    Route::get('/image-detail/{id}', 'imageDetail')->name('image.detail');
    Route::get('/shop', 'shop')->name('shop');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/add-to-cart/{id}', 'addToCart')->name('cart.add');
    Route::get('/cart', 'cart')->name('cart');
    Route::get('/cart/remove/{id}', 'removeCart')->name('cart.remove');
});

Route::get('/about', [AboutController::class, 'index']);

// Static Views
Route::view('/success', 'success')->name('success');
Route::view('/contact', 'contact')->name('contact');
Route::view('/payment/failed', 'failed')->name('payment.failed');

Route::post('/contact-store', [ContactController::class, 'contact'])->name('contact.store');

Route::controller(PaymentController::class)->group(function () {
    Route::post('/payment/verify', 'verify')->name('payment.verify');
    Route::post('/payment/fail', 'fail')->name('payment.fail');
});
Route::post('/payment/webhook', [WebhookController::class, 'handleRazorpay'])->name('payment.webhook');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

Route::middleware(['auth'])->group(function () {
    
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/order/place', function() {
            return redirect()->route('checkout');
        });
        Route::post('/order/place', 'placeOrder')->name('order.place');
        Route::post('/buy-now/{id}', 'buyNow')->name('buy.now');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'orders')->name('orders');
        Route::get('/cancel-order/{id}', 'cancelOrder')->name('cancel.order');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/{id}', 'show')->name('invoice.show');
        Route::get('/invoice/{id}/download', 'download')->name('invoice.download');
    });

    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'index')->name('wishlist');
        Route::match(['get', 'post'], '/wishlist/add/{id?}', 'add')->name('wishlist.add');
        Route::match(['get', 'post'], '/wishlist/remove/{id?}', 'remove')->name('wishlist.remove');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::post('/review/store', 'store')->name('review.store');
        Route::delete('/review/delete/{id}', 'userDestroy')->name('review.user.delete');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sales-report', [SalesReportController::class, 'index'])->name('sales-report');

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'adminProducts')->name('products');
        Route::get('/product/create', 'createProduct')->name('product.create');
        Route::post('/product/store', 'storeProduct')->name('product.store');
        Route::get('/product/edit/{id}', 'editProduct')->name('product.edit');
        Route::put('/product/update/{id}', 'updateProduct')->name('product.update');
        Route::patch('/product/toggle-status/{id}', 'toggleProductStatus')->name('product.toggle-status');
        Route::delete('/product/delete/{id}', 'deleteProduct')->name('product.delete');
        
        Route::get('/orders', 'adminOrders')->name('orders');
        Route::post('/order/update-status/{id}', 'updateOrderStatus')->name('order.update-status');
        Route::delete('/order/delete/{id}', 'deleteOrder')->name('order.delete');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'adminUsers')->name('users');
        Route::delete('/user/delete/{id}', 'deleteUser')->name('user.delete');
        Route::patch('/user/block/{id}', 'blockUser')->name('user.block');
        Route::patch('/user/unblock/{id}', 'unblockUser')->name('user.unblock');
        Route::patch('/user/role/{id}', 'changeRole')->name('user.role');
        Route::get('/user/profile/{id}', 'userProfile')->name('user.profile');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contacts', 'adminIndex')->name('contacts');
        Route::delete('/contacts/delete/{id}', 'destroy')->name('contacts.destroy');
    });

    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'adminIndex')->name('reviews');
        Route::delete('/review/delete/{id}', 'destroy')->name('review.delete');
    });
});

require __DIR__.'/auth.php';
