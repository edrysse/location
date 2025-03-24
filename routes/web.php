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

// إعادة توجيه الطلب إلى الجذر "/" للغة الإنجليزية فقط
Route::get('/', function () {
    return redirect('/en');
});

// (يمكنك حذف أي محاولات إعادة توجيه عامة أخرى لتفادي حلقة إعادة التوجيه)

// المسار الثابت (غير المعتمد على الترجمة) إن وجد
Route::get('/about', function () {
    return view('about');
})->name('about');

// مجموعة المسارات المعتمدة على لغة التطبيق
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    // الصفحة الرئيسية للغة المحددة (عند الدخول إلى /en/ مثلاً)
    Route::get('/', [Home1Controller::class, 'index'])->name('home');

    Route::get('/available-cars', [CarController::class, 'availableCars'])->name('available.cars');

    // صفحة الترحيب
    Route::get('/welcome', function () {
        return view('welcome');
    });

    // لوحة التحكم (Dashboard) - تتطلب تسجيل دخول وتحقق من البريد الإلكتروني
    Route::get('/dashboard', [Home1Controller::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    // ملفات المصادقة (Auth)
    require __DIR__.'/auth.php';

    Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::get('/contact/test', [ContactController::class, 'test'])->name('contact.test');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // مجموعة المسارات التي تتطلب تسجيل دخول
    Route::middleware('auth')->group(function () {
        // ملف تعريف المستخدم
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // المراجعات (Reviews)
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        // إدارة الاتصالات
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
        Route::get('/contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');

        // إدارة السيارات للمشرف
        Route::get('/carsadmin', [CarController::class, 'adminindex'])->name('cars.index');

        // الحجوزات (Reservations)
        Route::resource('reservations', ReservationController::class);
        Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.delete');

        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    });

    // إدارة السيارات (Cars)
    Route::resource('cars', CarController::class);
    Route::get('/cars', [CarController::class, 'index'])->name('cars');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    // الحجوزات (Reservations)
    Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    // الدفع (Payments)
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    // اختبار إرسال البريد الإلكتروني
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

    // إدارة المراجعات (Reviews) للمشرف
    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::post('/reviews/', [ReviewController::class, 'store'])->name('reviews.store');
    });
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

    // عناصر القائمة (nav items)
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

    // توليد خريطة الموقع
    Route::get('/generate-sitemap', function () {
        Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/cars'))
            ->add(Url::create('/about'))
            ->add(Url::create('/contact'))
            ->writeToFile(public_path('sitemap.xml'));

        return "تم إنشاء خريطة الموقع بنجاح!";
    });

    // تغيير اللغة عبر الرابط
    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar', 'fr'])) {
            session(['applocale' => $locale]);
        }
        return redirect()->back();
    });
});
