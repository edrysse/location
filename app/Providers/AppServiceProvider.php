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
            URL::forceScheme('https'); // ✅ فرض HTTPS في بيئة الإنتاج
        }

        Schema::defaultStringLength(191); // ✅ تجنب مشاكل قواعد البيانات

        // ✅ ضبط اللغة تلقائيًا في الجلسة إذا لم يتم تعيينها مسبقًا
        if (!session()->has('applocale')) {
            session()->put('applocale', 'en');
        }

        App::setLocale(session('applocale')); // ✅ ضبط اللغة من الجلسة
    }

}
