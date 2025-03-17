<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Home1Controller;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;

// الصفحة الرئيسية
Route::get('/', [Home1Controller::class, 'index'])->name('home');

// صفحة الترحيب
Route::get('/welcome', function () {
    return view('welcome');
});

// لوحة التحكم (Dashboard) - تتطلب تسجيل دخول وتحقق من البريد الإلكتروني

Route::get('/dashboard', [Home1Controller::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// ملفات المصادقة (Auth)
require __DIR__.'/auth.php';

// مجموعة المسارات التي تتطلب تسجيل دخول
Route::middleware('auth')->group(function () {
    // ملف تعريف المستخدم
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // المراجعات (Reviews)
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});


// السيارات (Cars)
Route::resource('cars', CarController::class);
Route::get('/carsadmin', [CarController::class, 'adminindex'])->name('cars.index');
Route::get('/available-cars', [CarController::class, 'availableCars'])->name('available.cars');

// الحجوزات (Reservations)
Route::resource('reservations', ReservationController::class);
Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
Route::post('/confirm-reservation', [ReservationController::class, 'confirm'])->name('reservations.confirm');
Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.delete');

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

// المراجعات (Reviews)
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/cars', [CarController::class, 'index'])->name('cars');
// مسار لعرض صفحة إضافة التقييمات

// مسار لتخزين التقييم الجديد


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');


Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contact/create', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
Route::get('/contact/{contact}/edit', [ContactController::class, 'edit'])->name('contact.edit');
Route::put('/contact/{contact}', [ContactController::class, 'update'])->name('contact.update');
Route::delete('/contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');