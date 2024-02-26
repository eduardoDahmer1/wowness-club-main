<?php

use App\Enums\Role;
use App\Http\Controllers\Auth\SeekerRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilitatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentsIntegrationController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SeekerController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseStripeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NewsletterController;
use App\Models\Package;
use App\Models\User;
use Faker\Guesser\Name;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/practitioner-application', [FacilitatorController::class, 'create'])->name('facilitators.create');
    Route::post('practitioners', [FacilitatorController::class, 'store'])->name('facilitators.store');
    Route::get('/auth/google', [SocialiteController::class, 'signInWithGoogle']);
    Route::get('/auth/google/seeker', [SocialiteController::class, 'signInWithGoogleSeeker']);
    Route::get('/auth/google/practitioner', [SocialiteController::class, 'signInWithGooglePractitioner']);
    Route::get('/callback/google', [SocialiteController::class, 'callbackToGoogle']);
    Route::get('/preregister', function () {
        return view('front.pre-register');
    })->name('preregister');
});
Route::post('/create-order', [OrderController::class, 'store'])->name('create.order');
Route::post('/create-purchase', [PurchaseController::class, 'store'])->name('create.purchase');
Route::middleware('auth')->group(function () {
    Route::get('/payment-successfull', [OrderController::class, 'paymentSuccessfull'])->name('payment-successfull');
    Route::post('/stripe/payment-intent/{order}', [StripeController::class, 'createPaymentIntent'])->name('payment.intent');
    Route::get('/checkout/{order}', [StripeController::class, 'index'])->name('checkout.index');

    Route::prefix('purchase')->name('purchases.')->group(function () {
        Route::get('/payment-successfull', [PurchaseController::class, 'paymentSuccessfull'])->name('payment-successfull');
        Route::post('/stripe/payment-intent/{purchase}', [PurchaseStripeController::class, 'createPaymentIntent'])->name('payment.intent');
        Route::get('/checkout/{purchase}', [PurchaseStripeController::class, 'index'])->name('checkout.index');
    });
});

Route::middleware('service.provider')->group(function () {
    Route::resource('plans', PlansController::class)->except('show');
    Route::post('/chart-data', [DashboardController::class, 'buildChartData'])->middleware('auth');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'checkNonMaintainer'])->name('dashboard');
    Route::get('/onboarding', fn () => view('admin.onboarding'))->middleware(['auth', 'checkNonMaintainer'])->name('onboarding');
    Route::get('/upgrade', fn () => view('admin.upgrade.index'))->middleware(['auth', 'checkNonMaintainer'])->name('upgrade');
    Route::get('/admin/chat/{user}', [UserController::class, 'startChat'])->name('chat.startChat');
    Route::get('/admin/chat', fn () => view('admin.chat',['user' => 0]))->middleware(['auth', 'checkNonMaintainer'])->name('chat');
    Route::get('/success-register', fn () => view('front.forms.success-register'))->name('success.register');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/users/{user}/status', [UserController::class, 'changeStatus'])->name('user.status.update');
    Route::delete('galleries/{gallery}', [ServiceController::class, 'deleteImg'])->name('delete.img.gallery');
    Route::delete('packages_galleries/{img}', [ServiceController::class, 'deleteImgPackage'])->name('delete.package.gallery');
    Route::delete('certificates/{certificate}', [UserController::class, 'deleteCertificate'])->name('user.delete.certificate');
    Route::get('/stripe/onboarding', [StripeController::class, 'onboardingStatus'])->name('onboarding.status');
    Route::get('/purchase/stripe/onboarding', [PurchaseStripeController::class, 'onboardingStatus'])->name('onboarding.status');
    Route::get('/services/{service}/weekdays', [ServiceController::class, 'weekDays'])->name('services.weekDays');
    Route::get('/services/{service}/individual', [ServiceController::class, 'editIndividual'])->name('individual.edit');
    Route::put('/individual/{service}', [ServiceController::class, 'updateIndividual'])->name('service.updateindividual');
    Route::put('/weekdays/{service}', [ServiceController::class, 'updateWeekday'])->name('weekday.update');
    Route::put('timesday/{service}', [ServiceController::class, 'updateTimes'])->name('update.timesofday');
    // Route::get('/services/{service}/scheduling', [ServiceController::class, 'schedulingCondition'])->name('services.scheduling');
    // Route::put('/scheduling/{service}', [ServiceController::class, 'updateScheduling'])->name('scheduling.update');
    Route::get('/connections', [PaymentsIntegrationController::class, 'index'])->middleware(['auth', 'checkNonMaintainer'])->name('connections.index');
    Route::get('/stripe/integration', [StripeController::class, 'stripeIntegration'])->name('change.status.stripe.integration');
    Route::get('/purchase/stripe/integration', [PurchaseStripeController::class, 'stripeIntegration'])->name('change.status.stripe.integration');
    Route::resource('services', ServiceController::class)->middleware('auth')->except('show');
    Route::middleware('user.plan')->group(function () {
        Route::resource('contents', ContentController::class)->middleware('auth')->except('show');
        Route::prefix('contents')->name('contents.')->group(function () {
            Route::post('/{content}/status', [ContentController::class, 'changeStatus'])->name('status.update');
            Route::get('/{content}/create', [ContentController::class, 'replicate'])->name('replicate');
        });
    });
    Route::post('/services/{service}/status', [ServiceController::class, 'changeStatus'])->name('service.status.update');
    Route::get('/services/{service}/create', [ServiceController::class, 'replicate'])->name('services.replicate');
});

Route::resource('posts', PostController::class)->middleware('maintainer')->except('show');
Route::post('/posts/{post}/status', [PostController::class, 'changeStatus'])->middleware('maintainer')->name('post.status.update');
Route::middleware('admin')->group(function () {
    Route::get('/seekers', [SeekerController::class, 'index'])->name('seekers.index');
    Route::get('/seekers/{user}/edit', [SeekerController::class, 'edit'])->name('seekers.edit');
    Route::put('/seekers/{user}', [SeekerController::class, 'update'])->name('seekers.update');
    Route::delete('/seekers/{user}', [SeekerController::class, 'destroy'])->name('seekers.destroy');
});
Route::resource('newsletter', NewsletterController::class)->middleware('maintainer');

/* Public pages */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/practitioner/{facilitator}', [UserController::class, 'show'])->name('facilitators.show');
Route::get('/blog', [PostController::class, 'showPosts'])->name('posts.blog');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/search', [ServiceController::class, 'searchService'])->name('service.search');
Route::get('/search-content', [ContentController::class, 'search'])->name('content.search');
Route::get('/search-practitioner', [UserController::class, 'search'])->name('practitioner.search');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::prefix('contents')->name('contents.')->group(function () {
    Route::get('/search', [ContentController::class, 'search'])->name('search');
    Route::get('/{content:slug}', [ContentController::class, 'show'])->name('show');
});
/* End public pages */

/* Terms and Policies pages */
Route::get('/terms-of-use', [StaticPageController::class, 'termsOfUse'])->name('terms.of.use');
Route::get('/terms-and-conditions-customers', [StaticPageController::class, 'termsAndConditionsCustomers'])->name('terms.and.conditions.customers');
Route::get('/terms-and-conditions-practitioners', [StaticPageController::class, 'termsAndConditionsPractitioners'])->name('terms.and.conditions.practitioners');
Route::get('/cookie-policy', [StaticPageController::class, 'cookiePolicy'])->name('cookie.policy');
Route::get('/privacy-policy', [StaticPageController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/acceptable-use-policy-content-standards-guidelines', [StaticPageController::class, 'acceptableUsePolicyContentStandardsGuidelines'])->name('acceptable.use.policy.content.standards.guidelines');
/* Terms and Policies pages */

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->middleware(['service.provider', 'checkNonMaintainer'])->name('orders.index');
    Route::get('/purchases', [PurchaseController::class, 'index'])->middleware(['service.provider', 'checkNonMaintainer'])->name('purchases.index');
    Route::get('/panel/orders', [OrderController::class, 'indexSeeker'])->name('orders.indexSeeker');
    Route::get('/panel/purchases', [PurchaseController::class, 'indexSeeker'])->name('purchases.indexSeeker');
    Route::get('/panel/following', function () { return view('front.orders.following'); })->name('following.indexSeeker');
    Route::get('/edit/{seeker}/profile', [SeekerRegisterController::class, 'edit'])->name('seeker.edit');
    Route::patch('/edit/{seeker}/profile', [SeekerRegisterController::class, 'update'])->name('seeker.update');
    Route::get('/seeker-for-practioner/{user}', [UserController::class, 'seekerForPractitioner'])->name('form.practitioner');
    Route::post('/user-practitioner/{user}', [UserController::class, 'dashboardForPractitioner'])->name('practitioner.dashboard');
    Route::resource('reviews', ReviewController::class)->except('edit', 'update', 'store');
    Route::delete('seeker/reviews/{review}/destroy', [ReviewController::class, 'destroySeekerReview'])->name('seeker.reviews.destroy');
    Route::post('/reviews/{order}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{review}/status', [ReviewController::class, 'changeStatus'])->name('review.status.update');
});

Route::middleware('service.provider')->group(function () {
    Route::resource('users', UserController::class)->middleware('auth')->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('subcategories', SubcategoryController::class)->except('show');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::get('services/{service}/calendar', [ServiceController::class, 'showServiceCalendar'])->name('services.calendar');
Route::get('services/{service}/created', [CalendarController::class, 'calendarCreated'])->name('calendar.created');
Route::resource('calendar', CalendarController::class)->only(['index','edit','store']);
Route::controller(CalendarController::class)->group(function () {
    Route::get('getevents','getEvents')->name('calendar.getevents');
    Route::get('getServices','getServices')->name('calendar.getservices');
    Route::put('update/events','updateEvents')->name('calendar.updateevents');
    Route::post('resize/events','resizeEvents')->name('calendar.resizeevents');
    Route::post('drop/events','dropEvents')->name('calendar.dropevents');
});

Route::view('/calendar/events', 'new-calendar-test.calendar');

Route::get('/socialamity', function () {
    return view('front.socialamity');
});
Route::get('/chat', function () {
    return view('front.chatamity');
})->name('chatamity');

require __DIR__ . '/auth.php';
