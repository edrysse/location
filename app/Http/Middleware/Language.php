<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * التعامل مع الطلب وتعيين لغة التطبيق بناءً على قيمة الجلسة.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // تحقق من محتويات الجلسة
        \Log::info('Session:', session()->all());

        // إذا كانت الجلسة لا تحتوي على 'applocale'، تعيينها إلى اللغة الافتراضية
        if (!session()->has('applocale')) {
            \Log::info('Setting default locale to en');
            session()->put('applocale', 'en');
        }

        // قراءة قيمة اللغة من الجلسة
        $locale = session('applocale');

        // تعيين لغة التطبيق
        \Log::info('Locale:', $locale);
        App::setLocale($locale);

        return $next($request);
    }

}
