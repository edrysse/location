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
        // إذا كانت الجلسة لا تحتوي على 'applocale'، تعيينها إلى اللغة الافتراضية
        if (!session()->has('applocale')) {
            session()->put('applocale', 'en');
        }

        // قراءة قيمة اللغة من الجلسة
        $locale = session('applocale');

        // تعيين لغة التطبيق
        App::setLocale($locale);

        return $next($request);
    }

}
