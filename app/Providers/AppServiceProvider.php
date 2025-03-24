<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App; // ✅ تأكد من استيراد App
use Mcamara\LaravelLocalization\Facades\LaravelLocalization; // ✅ استيراد LaravelLocalization

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale(LaravelLocalization::setLocale());
    }
}
