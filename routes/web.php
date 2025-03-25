<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home1Controller;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    if (!Session::has('applocale')) {
        Session::put('applocale', 'en');
        return redirect(LaravelLocalization::getLocalizedURL('en'));
    }
    return redirect(LaravelLocalization::getLocalizedURL(Session::get('applocale')));
});

Route::get('/test', function () {
    dd(LaravelLocalization::getLocalizedURL('en'));
});

//lang

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    Route::get('/', [Home1Controller::class, 'index'])->name('home');
    Route::get('/available-cars', [CarController::class, 'availableCars'])->name('available.cars');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/dashboard', [Home1Controller::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    require __DIR__.'/auth.php';

    Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::get('/contact/test', [ContactController::class, 'test'])->name('contact.test');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
        Route::get('/contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

        Route::get('/carsadmin', [CarController::class, 'adminindex'])->name('cars.index');

        Route::resource('reservations', ReservationController::class);
        Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.delete');

        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    });

    Route::resource('cars', CarController::class);
    Route::get('/cars', [CarController::class, 'index'])->name('cars');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    Route::get('/test-email', function () {
        try {
            Mail::raw('This is a test email', function ($message) {
                $message->to('test@example.com')
                        ->subject('Test Email');
            });
            return 'Email sent successfully!';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    });

    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    });
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

    Route::get('/about', function () {
        return view('nav.about');
    })->name('nav.about');

    Route::get('/terms', function () {
        return view('nav.terms');
    })->name('nav.terms');

    Route::get('/privacy', function () {
        return view('nav.privacy');
    })->name('nav.privacy');

    Route::get('/payment', function () {
        return view('nav.payment');
    })->name('nav.payment');

    Route::get('/generate-sitemap', function () {
        Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/cars'))
            ->add(Url::create('/about'))
            ->add(Url::create('/contact'))
            ->writeToFile(public_path('sitemap.xml'));
        return "تم إنشاء خريطة الموقع بنجاح!";
    });

    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar', 'fr'])) {
            session(['applocale' => $locale]);
        }
        return redirect()->back();
    });
});
