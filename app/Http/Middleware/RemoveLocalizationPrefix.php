<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemoveLocalizationPrefix
{
    public function handle(Request $request, Closure $next)
    {
        // إزالة الـ locale من الرابط (إذا كان موجودًا)
        $locale = app()->getLocale();
        $uri = $request->getRequestUri();
        
        // إذا كان الـ locale موجود في الرابط
        if (strpos($uri, $locale) === 1) {
            $newUri = substr($uri, strlen($locale) + 1);  // حذف الـ locale
            return redirect($newUri);
        }

        return $next($request);
    }
}
