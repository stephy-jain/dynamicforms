<?php

namespace App\Providers;

use App\Models\Form;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
//        $forms = Form::all();
        // Share forms data with all views
//        View::share('forms', $forms);
    }
}
