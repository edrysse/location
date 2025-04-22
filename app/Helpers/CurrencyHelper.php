<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function formatPrice($price, $locale = null, $withSymbol = true)
    {
        $locale = $locale ?? app()->getLocale();

        $symbols = [
            'en' => '$', // دولار
            'fr' => '€', // يورو
            'ar' => 'د.م', // درهم
        ];

        $symbol = $symbols[$locale] ?? 'د.م';

        // في حالة العربية، اضرب الثمن في 10
        if ($locale === 'ar') {
            $price = $price * 10;
        }

        $formatted = number_format($price, 2);

        if (!$withSymbol) {
            return $formatted;
        }

        // ترتيب العملة حسب اللغة
        if ($locale == 'ar') {
            return $formatted . ' ' . $symbol;
        } else {
            return $symbol . $formatted;
        }
    }
}
