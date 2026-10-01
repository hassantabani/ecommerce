<?php

// Controllers
use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Website\HomeController as WHController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Artisan;
// Packages
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

//UI Pages Routs
Route::get('/home', [HomeController::class, 'uisheet'])->name('uisheet');

Route::get('/', [WHController::class, 'index'])->name('website-home');
Route::get('/about', [WHController::class, 'about'])->name('website-about');
Route::get('/contact-us', [WHController::class, 'contact'])->name('website-contact');
Route::get('/product',[WHController::class,'single_product'])->name('website-product');
Route::get('/product-categories/{id}',[WHController::class,'product_categories'])->name('product-categories');
Route::get('/products',[WHController::class,'products'])->name('products');


// Route::get('/', [AuthenticatedSessionController::class, 'create'])
//                 ->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
 
    // Permission Module
    Route::get('/role-permission',[RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission',PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::get('/thankyou/{orderId}', [WHController::class, 'thankyou'])->name('website-thankyou');
    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders-pending', [OrderController::class, 'orders_pending'])->name('orders-pending');
    Route::get('/orders-inprocess', [OrderController::class, 'orders_inprocess'])->name('orders-inprocess');
    Route::get('/orders-reject', [OrderController::class, 'orders_reject'])->name('orders-reject');
    Route::get('/orders-deliver', [OrderController::class, 'orders_deliver'])->name('orders-deliver');
    Route::get('/view-order/{id}', [OrderController::class, 'view_order'])->name('view-order');

    Route::group(['middleware' => 'scanner'],function(){
        Route::get('/scanner', [OrderController::class, 'scanner'])->name('scanner');
       
    });
    Route::resource('users', UserController::class);
    Route::post('add-payment-method',[UserController::class,'add_payment_method'])->name('add-payment-method');
    Route::get('make-withdraw',[UserController::class,'make_withdraw'])->name('make-withdraw');
    Route::get('get-all-request',[UserController::class,'get_all_request'])->name('get-all-request');
    Route::post('store-make-withdraw',[UserController::class,'store_make_withdraw'])->name('store-withdraw-request');
    Route::get('/view-withdraw/{id}',[UserController::class,'view_withdraw'])->name('view-withdraw');
    Route::post('swithdraw-status-update/{id}',[UserController::class,'withdraw_status_update'])->name('withdraw-status-update');

    Route::get('/order-detail/{id}',[OrderController::class,'order_detail'])->name('order-detail');
 
    Route::get('profit-details',[OrderController::class,'show_profit_details'])->name('show-profit-details');
    Route::group(['middleware' => 'admin'],function(){
        Route::get('/get-gateways',[ApiController::class,'get_gateways'])->name('get-gateways');
        Route::get('/get-cities',[ApiController::class,'get_cities'])->name('get-cities');
     
        Route::get('all-products',[ProductController::class,'list'])->name('product-list');
        
        Route::get('add-products',[ProductController::class,'add_product'])->name('product-add');
        Route::get('edit-product/{id}',[ProductController::class,'edit_product'])->name('edit-product');
        Route::post('store-product',[ProductController::class,'store_products'])->name('product-store');
        Route::post('product-update/{id}',[ProductController::class,'product_update'])->name('product-update');
        Route::get('product-delete/{id}',[ProductController::class,'product_delete'])->name('product-delete');
        Route::get('/order-print/{id}',[OrderController::class,'order_print'])->name('order-print');
    });
    // Users Module
    Route::post('order-status-update/{id}',[OrderController::class,'order_status_update'])->name('order-status-update');
    Route::post('/add_to_cart',[WHController::class,'add_to_cart'])->name('website-add-to-cart');
    Route::get('/cart',[WHController::class,'cart'])->name('website-cart');
    Route::post('/delete-cart',[WHController::class,'delete_cart'])->name('website-delete-cart');
    Route::post('/update-cart',[WHController::class,'update_cart'])->name('website-update-cart');
    Route::get('/checkout',[WHController::class,'checkout'])->name('website-checkout');
    Route::post('/place-order',[WHController::class,'place_order'])->name('website-place-order');
    Route::post('/store-shipping-method',[WHController::class,'store_shipping'])->name('website-store-shipping-method');
   
});

//App Details Page => 'Dashboard'], function() {
Route::group(['prefix' => 'menu-style'], function() {
    //MenuStyle Page Routs
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

//App Details Page => 'special-pages'], function() {
Route::group(['prefix' => 'special-pages'], function() {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

//Widget Routs
Route::group(['prefix' => 'widget'], function() {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

//Maps Routs
Route::group(['prefix' => 'maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});

//Error Page Route
Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});


//Forms Pages Routs
Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
});


//Table Page Routs
Route::group(['prefix' => 'table'], function() {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

//Icons Page Routs
Route::group(['prefix' => 'icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});
//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');
