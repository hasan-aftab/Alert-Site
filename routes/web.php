<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\FaqController;

use App\Http\Controllers\CustomForgotPasswordController;
use App\Http\Controllers\Subscriptions\PaymentController;
use App\Http\Controllers\Subscriptions\StripeWebhookController;
use App\Http\Controllers\Subscriptions\SubscriptionController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

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

Route::group(['prefix' => 'admin','middleware' => 'check.auth'], function () {
    Route::get('', [AdminController::class, 'index']);
    //Route::get('/',[ProductsController::class, 'product_show']);
    //Route::get('/show/{product}',[ProductsController::class,'product_view']);
    Route::get('products/create_template/{id}', [ProductsController::class, 'create_template']);
    Route::resource('/products', ProductsController::class);
    Route::post('/products', [ProductsController::class, 'store'])->name('admin.products.store');
    Route::post('/products/update/{id}', [ProductsController::class, 'update']);
    Route::get('/products/remove/{id}', [ProductsController::class, 'destroy']);
    Route::get('products/{product}', 'ProductsController@show');
    Route::get('photos/create/{id}', 'PhotoController@create');
    Route::get('/order', [AdminController::class, 'order']);
    Route::get('/customer', [AdminController::class, 'customer']);
    Route::get('/customer/delete/{id}', [AdminController::class, 'customer_delete']);
    Route::get('/contact/delete/{id}', [AdminController::class, 'contact_delete']);
    Route::post('/cancel-subscription/{id}', [AdminController::class, 'cancelSubscription'])->name('cancel.subscription');

    //blogs
    Route::get('blogs', [BlogsController::class, 'index']);
    Route::post('/blogs', [BlogsController::class, 'store'])->name('admin.blogs.store');
    Route::post('/blogs/update/{id}', [BlogsController::class, 'update']);
    Route::get('/blogs/remove/{id}', [BlogsController::class, 'destroy']);
    Route::get('/blogs/edit/{id}', [BlogsController::class, 'edit']);
    Route::get('blogs/{product}', [BlogsController::class, 'show']);
    Route::get('blogs/add/new', [BlogsController::class, 'create']);
    Route::get('blogs/moderate/{id}', [BlogsController::class, 'moderate']);
    Route::get('blogs/moderate/changestatus/{id}/{status}', [BlogsController::class, 'changestatus']);

    //pages
    Route::get('pages', [PagesController::class, 'index']);
    Route::post('/pages', [PagesController::class, 'store'])->name('admin.pages.store');
    Route::post('/pages/update/{id}', [PagesController::class, 'update']);
    Route::get('/pages/remove/{id}', [PagesController::class, 'destroy']);
    Route::get('/pages/edit/{id}', [PagesController::class, 'edit']);
    Route::get('pages/{product}', [PagesController::class, 'show']);
    Route::get('pages/add/new', [PagesController::class, 'create']);
    Route::get('pages/moderate/{id}', [PagesController::class, 'moderate']);
    Route::get('pages/moderate/changestatus/{id}/{status}', [PagesController::class, 'changestatus']);

    //faq
    Route::get('faq', [FaqController::class, 'index']);
    Route::post('/faq', [FaqController::class, 'store'])->name('admin.faq.store');
    Route::post('/faq/update/{id}', [FaqController::class, 'update']);
    Route::get('/faq/remove/{id}', [FaqController::class, 'destroy']);
    Route::post('/faq/update_order', [FaqController::class, 'update_order']);
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit']);
    Route::get('faq/{product}', [FaqController::class, 'show']);
    Route::get('faq/add/new', [FaqController::class, 'create']);
    Route::get('faq/moderate/{id}', [FaqController::class, 'moderate']);
    Route::get('faq/moderate/changestatus/{id}/{status}', [FaqController::class, 'changestatus']);

    //setting
    Route::get('setting', [AdminController::class, 'setting']);
    Route::post('setting_save', [AdminController::class, 'setting_save'])->name('setting.store');
    Route::get('store', [AdminController::class, 'store']);
    Route::get('contacts', [AdminController::class, 'contacts']);
    Route::post('/contact/bulk-delete', [AdminController::class, 'bulkDelete'])->name('admin.contact.bulkDelete');
});

Route::group(['middleware' => 'check.auth'], function () {
    Route::get('/my_account', [App\Http\Controllers\HomeController::class, 'my_account'])->name('my_account');
    Route::get('/myprofile', [App\Http\Controllers\HomeController::class, 'myprofile'])->name('myprofile');
    Route::post('/profile-update', [App\Http\Controllers\HomeController::class, 'profile_update'])->name('profile.update');

    Route::get('/track/list', [App\Http\Controllers\TrackController::class, 'track_list'])->name('track.list');
    Route::get('/track/add', [App\Http\Controllers\TrackController::class, 'add'])->middleware('check.track.limit')->name('track.add');
    Route::post('/track/save', [App\Http\Controllers\TrackController::class, 'save'])->middleware('check.track.limit')->name('track.save');
    Route::get('/track/remove/{id}', [App\Http\Controllers\TrackController::class, 'destroy'])->name('track.destroy');
    Route::get('/track/edit/{id}', [App\Http\Controllers\TrackController::class, 'edit'])->name('track.edit');
    Route::post('/track/update/{id}', [App\Http\Controllers\TrackController::class, 'update'])->name('track.update');
    //Route::post('/track/update/{id}', [App\Http\Controllers\TrackController::class, 'update'])->middleware('check.track.update.limit')->name('track.update');

    //For the user dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/myalerts', [App\Http\Controllers\DashboardController::class, 'myalerts'])->name('myalerts');
    Route::get('/editalert/{id}', [App\Http\Controllers\DashboardController::class, 'editalert'])->name('editalert');
    Route::get('/top_deals', [App\Http\Controllers\DashboardController::class, 'top_deals'])->name('top_deals');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/save_review', [App\Http\Controllers\HomeController::class, 'save_review'])->name('save_review');
Route::get('/get_images', [App\Http\Controllers\HomeController::class, 'get_images'])->name('get_images');
Route::get('/updateImageNames', [App\Http\Controllers\HomeController::class, 'updateImageNames'])->name('updateImageNames');
Route::get('/updateEmptyImageColumns', [App\Http\Controllers\HomeController::class, 'updateEmptyImageColumns'])->name('updateEmptyImageColumns');
Route::post('/contact/save', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact.save');

Route::get('/pricing', [App\Http\Controllers\HomeController::class, 'pricing'])->name('pricing');
Route::get('/contactus', [App\Http\Controllers\HomeController::class, 'contactus'])->name('contactus');
Route::get('/aboutus', [App\Http\Controllers\HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/track', [App\Http\Controllers\HomeController::class, 'track'])->middleware('check.auth')->name('track');
Route::get('/get_stores', [App\Http\Controllers\HomeController::class, 'get_stores'])->middleware('check.auth')->name('get_stores');
//Route::get('/track/add', [App\Http\Controllers\TrackController::class, 'add'])->middleware('check.track.limit')->name('track.add');

Route::get('/faq', [App\Http\Controllers\HomeController::class, 'faq'])->name('faq');
Route::get('/terms-and-conditions', [App\Http\Controllers\HomeController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('privacy_policy');

Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register.form');

Route::post('/register', [App\Http\Controllers\UserController::class, 'register'])->name('register');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::post(
    'stripe/webhook',
    [WebhookController::class, 'handleWebhook']
);

Route::post('/charge', [App\Http\Controllers\PaymentController::class, 'processPayment'])->name('charge');
Route::post('/check_coupon', [App\Http\Controllers\PaymentController::class, 'check_coupon'])->name('check_coupon');

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('plans', [SubscriptionController::class, 'index'])->middleware('auth')->name('plans');
Route::get('/plan/{id}', [App\Http\Controllers\HomeController::class, 'plandetails'])->middleware('auth')->name('plan.detail');
Route::get('/check_store/{id}', [App\Http\Controllers\TrackController::class, 'check_store'])->middleware('auth')->name('check_store');

Route::get('/subscribe', 'SubscriptionController@showSubscription');
Route::post('/subscribe', [PaymentController::class, 'store'])->name('subscribe.form');
Route::get('/subscription-cancel', [PaymentController::class, 'subscriptionCancel'])->name('subscription-cancel');

// welcome page only for subscribed users
Route::get('/welcome', 'SubscriptionController@showWelcome')->middleware('subscribed');
Route::group(['middleware' => ['role:seller']], function () {
  Route::get('/welcome', 'SubscriptionController@showWelcome');
});

Route::post('/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('cashier.webhook');
Route::any('/email-send', [TrackController::class, 'sendEmailToUsersWithTracks']);
Route::any('/sms-send', [TrackController::class, 'sendSMSToUsers']);
Route::any('/get-store-price', [TrackController::class, 'getallstore']);
Route::any('/get-store-name', [TrackController::class, 'getstorewithname']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/email', [CustomForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

//for webhook sms api
Route::get('/webhook1', [App\Http\Controllers\HomeController::class, 'webhook']);
Route::get('/webhook2', [App\Http\Controllers\HomeController::class, 'webhook']);