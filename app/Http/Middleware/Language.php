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
        // قراءة قيمة اللغة من الجلسة، وإذا لم تكن موجودة، استخدام اللغة الافتراضية من ملف config/app.php
        $locale = session('applocale', config('app.locale'));
        
        // تعيين لغة التطبيق
        App::setLocale($locale);

        return $next($request);
    }
}
