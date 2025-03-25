<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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
use Illuminate\Support\Facades\Session;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

Route::get('/test-cloudinary', function () {
    try {
        // تأكد من تكوين Cloudinary بشكل صحيح
        $cloudinaryConfig = config('services.cloudinary');

        Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // رفع صورة باستخدام رابط صحيح (رابط صورة تجريبي من حساب demo الخاص بـ Cloudinary)
        $response = (new UploadApi())->upload('https://res.cloudinary.com/demo/image/upload/sample.jpg');

        return response()->json([
            'message'  => 'تم الاتصال بكلاوديناري بنجاح!',
            'response' => $response
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error'   => 'فشل الاتصال بكلاوديناري!',
            'message' => $e->getMessage()
        ]);
    }
});
/*
|--------------------------------------------------------------------------
| Redirect and Test Routes
|--------------------------------------------------------------------------
|
| يتم إعادة توجيه المستخدم من الجذر إلى النسخة المحلية، وهناك مسار للاختبار.
|
*/

// إعادة توجيه الجذر إلى "/en"
Route::get('/', function () {
    return redirect('/en');
});


// مجموعة المسارات مع البادئة اللغوية

// اختبار: عرض URL باللغة الإنجليزية باستخدام LaravelLocalization
Route::get('/test', function () {
    dd(LaravelLocalization::getLocalizedURL('en'));
});

/*
|--------------------------------------------------------------------------
| Localized Routes Group
|--------------------------------------------------------------------------
|
| جميع المسارات داخل المجموعة ستبدأ بالبادئة اللغوية (على سبيل المثال /en أو /ar).
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

    /*
    |--------------------------------------------------------------------------
    | الصفحات الثابتة والصفحة الرئيسية
    |--------------------------------------------------------------------------
    */
    Route::get('/', [Home1Controller::class, 'index'])->name('home');
    Route::get('/available-cars', [CarController::class, 'availableCars'])->name('available.cars');

    // صفحة "عن الموقع" الأولى (انتبه إلى التعارض مع تعريف "/about" الثاني)
    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/welcome', function () {
        return view('welcome');
    });

    /*
    |--------------------------------------------------------------------------
    | لوحة التحكم (Dashboard)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [Home1Controller::class, 'dashboard'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    // تحميل مسارات المصادقة
    require __DIR__.'/auth.php';

    /*
    |--------------------------------------------------------------------------
    | مسارات الاتصال (Contact)
    |--------------------------------------------------------------------------
    */
    // مسارات عامة لإنشاء وتخزين رسالة الاتصال
    Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::get('/contact/test', [ContactController::class, 'test'])->name('contact.test');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    /*
    |--------------------------------------------------------------------------
    | المسارات المحمية (تتطلب مصادقة المستخدم)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {

        // ملف المستخدم (Profile)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // مسارات التقييمات (Reviews)
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        // إدارة رسائل الاتصال
        Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
        Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
        Route::get('/contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
        Route::post('/cars', [CarController::class, 'store'])->name('cars.index');

        // إدارة السيارات من لوحة الإدارة
        Route::get('/carsadmin', [CarController::class, 'adminindex'])->name('cars.index');

        // إدارة الحجوزات
        Route::resource('reservations', ReservationController::class);
        Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.delete');

        // عرض قائمة التقييمات للمستخدمين المسجلين
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    });

    /*
    |--------------------------------------------------------------------------
    | مسارات السيارات والحجوزات العامة
    |--------------------------------------------------------------------------
    */
    // موارد السيارات
    Route::resource('cars', CarController::class);
    Route::get('/cars', [CarController::class, 'index'])->name('cars');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

    // مسارات الحجوزات الإضافية
    Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');

    /*
    |--------------------------------------------------------------------------
    | مسارات الدفع والبريد الإلكتروني
    |--------------------------------------------------------------------------
    */
    // معالجة الدفع
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

    /*
    |--------------------------------------------------------------------------
    | مسارات الإدارة الخاصة بالتقييمات (Reviews)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
        Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
        Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // مسارات إضافية للتقييمات (قد تكون زائدة عن الحاجة إذا تم تعريفها سابقًا)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    });


    /*
    |--------------------------------------------------------------------------
    | الصفحات الثابتة الإضافية (Navigation)
    |--------------------------------------------------------------------------
    */
    // ملاحظة: تم تعريف مسار "/about" سابقًا، فهنا تم تغييره إلى اسم مختلف لتجنب التعارض
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

    /*
    |--------------------------------------------------------------------------
    | توليد خريطة الموقع (Sitemap)
    |--------------------------------------------------------------------------
    */
    Route::get('/generate-sitemap', function () {
        Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/cars'))
            ->add(Url::create('/about'))
            ->add(Url::create('/contact'))
            ->writeToFile(public_path('sitemap.xml'));
        return "تم إنشاء خريطة الموقع بنجاح!";
    });

    /*
    |--------------------------------------------------------------------------
    | تغيير اللغة (Language Switcher)
    |--------------------------------------------------------------------------
    */
    Route::get('lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'ar', 'fr'])) {
            session(['applocale' => $locale]);
        }
        return redirect()->back();
    });
});
