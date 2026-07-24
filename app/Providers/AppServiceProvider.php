<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Wishlist;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
         
    
    public function boot(): void
    {
         Schema::defaultStringLength(191);
         // View::composer('*', function ($view) {
         //     $view->with('data', Product::all());
         //     // $count = Wishlist::where('user_id', 1)->count();
         //     // $view->with('wishlistCount', $count);
         // });
    }
}
