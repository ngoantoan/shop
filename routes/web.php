<?php

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

Route::match(['get', 'post'], '/', 'IndexController@index');
Route::get('/categories/{category_id}', 'IndexController@categories');
Route::get('/products/{id}', 'ProductsController@products');
Route::get('/get-product-price', 'ProductsController@getPrice');
Route::get('/about-us', 'AboutController@aboutUs');

// User Route
Route::get('/login-register', 'UsersController@useLoginRegister');
Route::post('/user-register', 'UsersController@register');
Route::post('/user-login', 'UsersController@login');
Route::get('/user-logout', 'UsersController@logout');

Route::group(['middleware' => ['frontlogin']], function () { // Route for middleware after front login
    Route::match(['get', 'post'], '/account', 'UsersController@account');
    Route::match(['get', 'post'], '/change-password', 'UsersController@changePassword');
    Route::match(['get', 'post'], '/change-address', 'UsersController@changeAddress');
    // Checkout Route
    Route::match(['get', 'post'], '/checkout', 'ProductsController@checkout')->middleware('verified');
    Route::match(['get', 'post'], '/order-review', 'ProductsController@orderReview');
    Route::match(['get', 'post'], '/place-order', 'ProductsController@placeOrder');
    Route::match(['get', 'post'], '/stripe', 'ProductsController@stripe');
    Route::get('/thanks', 'ProductsController@thanks');
    Route::get('/orders', 'ProductsController@userOrders');
    Route::get('/order/{id}', 'ProductsController@userOrderDetails');

    // Paypal Route
    Route::get('/paypal', 'PaypalController@paypal')->name('paypal');
    Route::get('/cancel', 'PaypalController@cancel')->name('paypal.cancel');
    Route::get('/paypal/success', 'PaypalController@success')->name('paypal.success');
});

// Cart Route
Route::match(['get', 'post'], '/add-cart', 'ProductsController@addtoCart');
Route::match(['get', 'post'], '/cart', 'ProductsController@cart');
Route::get('/cart/delete-product/{id}', 'ProductsController@deleteCartProduct');
Route::get('/cart/update-quantity/{id}/{quantity}', 'ProductsController@updateCartQuantity');
Route::post('/cart/apply-coupon', 'ProductsController@applyCoupon');

// Contact us Route
Route::match(['get', 'post'], 'contact-us', 'ContactController@contact');

Auth::routes(['verify' => true]);

Route::match(['get', 'post'], '/home', 'IndexController@home');

// Admin Route
Route::match(['get', 'post'], '/admin', 'AdminController@login');
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::match(['get', 'post'], '/dashboard', 'AdminController@dashboard');

    // Category Route
    Route::match(['get', 'post'], '/add-category', 'CategoryController@addCategory');
    Route::match(['get', 'post'], '/view-categories', 'CategoryController@viewCategories');
    Route::match(['get', 'post'], '/edit-category/{id}', 'CategoryController@editCategory');
    Route::post('/delete-category', 'CategoryController@deleteCategory');
    Route::post('/update-category-status', 'CategoryController@updateStatus');

    // Product Route
    Route::match(['get', 'post'], '/add-product', 'ProductsController@addProduct');
    Route::match(['get', 'post'], '/view-products', 'ProductsController@viewProducts');
    Route::match(['get', 'post'], '/edit-product/{id}', 'ProductsController@editProduct');
    Route::match(['get', 'post'], '/delete-product/{id}', 'ProductsController@deleteProduct');
    Route::post('/update-product-status', 'ProductsController@updateStatus');
    Route::post('/update-featured-product', 'ProductsController@updateFeatured');

    // Products Attributes
    Route::match(['get', 'post'], '/add-attributes/{id}', 'ProductsController@addAttributes');
    Route::match(['get', 'post'], '/edit-attribute/{id}', 'ProductsController@editAttributes');
    Route::get('/delete-attribute/{id}', 'ProductsController@deleteAttribute');
    Route::match(['get', 'post'], '/add-images/{id}', 'ProductsController@addImages');
    Route::get('/delete-alt-image/{id}', 'ProductsController@deleteAltImage');

    // Banners Route
    Route::match(['get', 'post'], '/banners', 'BannersController@banners');
    Route::match(['get', 'post'], '/add-banner', 'BannersController@addBanner');
    Route::match(['get', 'post'], '/edit-banner/{id}', 'BannersController@editBanner');
    Route::match(['get', 'post'], '/delete-banner/{id}', 'BannersController@deleteBanner');
    Route::post('/update-banner-status', 'BannersController@updateStatus');

    // Coupons Route
    Route::match(['get', 'post'], '/add-coupon', 'CouponsController@addCoupon');
    Route::match(['get', 'post'], '/view-coupons', 'CouponsController@viewCoupons');
    Route::match(['get', 'post'], '/edit-coupon/{id}', 'CouponsController@editCoupon');
    Route::post('/update-coupon-status', 'CouponsController@updateStatus');
    Route::get('/delete-coupon/{id}', 'CouponsController@deleteCoupon');

    // Orders Route
    Route::get('/orders', 'ProductsController@viewOrders');
    Route::get('/order/{id}', 'ProductsController@viewOrderDetails');
    Route::post('/update-order-status', 'ProductsController@UpdateOrderStatus'); // Uodate Orders Status

    // Contact Us Route
    Route::get('/contacts', 'ContactController@viewContacts');
    Route::get('/delete-contact/{id}', 'ContactController@deleteContact');
});

Route::get('/logout', 'AdminController@logout');
