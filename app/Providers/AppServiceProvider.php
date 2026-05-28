<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Yeh $categories automatically HAR view ko milega
        View::composer('*', function ($view) {
            if (!isset($view->getData()['categories'])) {
                $view->with('categories', Category::where('is_active', 1)->get());
            }
        });
    }
}