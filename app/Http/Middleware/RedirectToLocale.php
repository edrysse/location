<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RedirectToLocale
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق إذا كان المستخدم يزور "/"
        if ($request->path() === '/') {
            return Redirect::to('/en'); // تغيير "/en" إلى أي لغة افتراضية لديك
        }

        return $next($request);
    }
}
