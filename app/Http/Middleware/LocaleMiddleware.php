<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('applocale')) {
            Session::put('applocale', 'en'); // اجعل الإنجليزية الافتراضية
        }

        App::setLocale(Session::get('applocale'));

        return $next($request);
    }
}
