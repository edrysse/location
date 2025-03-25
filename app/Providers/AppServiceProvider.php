<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL; // ✅ إضافة استيراد URL
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https'); // ✅ فرض HTTPS في الإنتاج
        }

        Schema::defaultStringLength(191); // تجنب مشاكل قواعد البيانات

        App::setLocale(LaravelLocalization::setLocale());
    }
}
