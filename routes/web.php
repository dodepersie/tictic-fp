<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantEventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\CheckMerchantStatus;
use App\Http\Middleware\OnlyAdminRole;
use App\Http\Middleware\OnlyCustomerRole;
use App\Http\Middleware\OnlyCustomerMerchantRole;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Categories',
        'categories' => Category::all(),
    ]);
})->name('categories');

Route::middleware(['auth', OnlyCustomerMerchantRole::class])->group(function () {
    Route::get('/view-ticket-detail', [TransactionController::class, 'index'])->name('view-ticket-detail');
    Route::post('/view-ticket-detail', [TransactionController::class, 'viewTicketDetail'])->name('view-ticket-detail');
});

// Auth Route
Route::get('/login', [LoginController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->name('register')->middleware('guest');
Route::get('/register/merchant', [RegisterController::class, 'index_merchant'])->name('register_merchant')->middleware('guest');
Route::post('/register/merchant', [RegisterController::class, 'store_merchant'])->name('egister_merchant')->middleware('guest');

// Product / Event Route
Route::resource('/events', ProductController::class)->names('event');

Route::middleware(['auth', OnlyCustomerRole::class])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout-index');
    Route::get('/checkout/{transaction}', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'proccess'])->name('checkout-proccess');
    Route::get('/checkout/success/{transaction}', [CheckoutController::class, 'success'])->name('checkout-success');
    Route::get('/checkout/invoice/{transaction}', [CheckoutController::class, 'invoice'])->name('checkout-invoice');
    Route::get('/dashboard/transactions', [TransactionController::class, 'all_transactions'])->name('dashboard_transactions.index');
    Route::get('/dashboard/transactions/{transaction}/review', [ReviewController::class, 'review_transaction'])->name('dashboard_transactions.index.review');
    Route::post('/dashboard/transactions/{transaction}/review', [ReviewController::class, 'store_review'])->name('dashboard_transactions.review.store');
});

Route::prefix('dashboard')->middleware(['auth', OnlyAdminRole::class])->group(function () {
    Route::resource('/categories', CategoryController::class)->names('dashboard_categories');
});

// About
Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
})->name('about');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password', [
        'title' => 'Forgot Password',
    ]);
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token, 'title' => 'Reset Password']);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);

Route::get('/email/verify', function () {
    if (auth()->user()->email_verified_at) {
        return redirect()->route('dashboard.index');
    }

    $title = 'Email Verification';

    return view('auth.verify-email', compact('title'));
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Link verifikasi terkirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::prefix('dashboard')->middleware(['auth', 'verified', CheckMerchantStatus::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Merchant
    Route::post('merchant/{merchant}/approve', [RegisterController::class, 'approve_merchant'])->name('merchant.approve');
    Route::post('merchant/{merchant}/reject', [RegisterController::class, 'reject_merchant'])->name('merchant.reject');
    Route::resource('merchants', MerchantController::class)->names('dashboard_merchants');

    // Merchant Event
    Route::resource('events', MerchantEventController::class)->names('merchant_events');
    Route::get('/checkSlug', [MerchantEventController::class, 'checkSlug']);

    // User Profile Management
    Route::resource('profile', UserProfileController::class);
    Route::delete('/profile/{id}/remove-picture', [UserProfileController::class, 'removeProfilePicture'])->name('profile.remove_picture');
    Route::post('/profile/{id}/change-pwd', [UserProfileController::class, 'changePassword'])->name('profile.change_password');
});
