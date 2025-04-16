<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL; // ✅ إضافة استيراد URL
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */

public function boot(): void
{

 

    Schema::defaultStringLength(191); // ✅ تجنب مشاكل قواعد البيانات

    // ✅ ضبط اللغة في الجلسة إذا لم يتم تعيينها مسبقًا
    if (!Session::has('applocale')) {
        Session::put('applocale', 'en');
    }

    App::setLocale(Session::get('applocale')); // ✅ ضبط اللغة الافتراضية
}

}
