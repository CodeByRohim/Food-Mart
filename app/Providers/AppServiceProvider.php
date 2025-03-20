<?php

namespace App\Providers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        View::share('users', User::get());
        View::share('products', Product::latest()->get());
    }
    
}
