<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Schedule;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/cars'))
        ->writeToFile(public_path('sitemap.xml'));
})->daily();  // يحدث الخريطة يوميًا
