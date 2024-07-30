<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Admin Controller
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeOptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdministratorController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\Auth\ForgotPasswordController;
use App\Http\Controllers\Client\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Client\Auth\RegisterController as AuthRegisterController;
//Client Controller
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CategoryController as ClientCategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Client\SearchController;

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

Route::get('/login', [AuthLoginController::class, 'create'])->name('login');
Route::post('/login', [AuthLoginController::class, 'store'])->name('login');
Route::post('/logout', [AuthLoginController::class, 'destroy'])->name('logout');
Route::get('/register', [AuthRegisterController::class, 'create'])->name('register');
Route::post('/register', [AuthRegisterController::class, 'store'])->name('register');
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('forgot-password');
Route::get('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password', [ForgotPasswordController::class, 'postResetPassword'])->name('reset-password');

Route::get('/san-pham/{product:slug}', [ClientProductController::class, 'show'])->name('client.product.detail');
Route::post('/san-pham/{product:slug}', [ReviewController::class, 'store'])->name('client.review.store');
Route::get('/danh-muc/{category:slug}', [ClientCategoryController::class, 'index'])->name('client.category.index');
Route::get('/tim-kiem', [SearchController::class, 'search'])->name('client.product.search');
Route::get('/live-search', [SearchController::class, 'liveSearch'])->name('client.search.liveSearch');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ClientProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ClientProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ClientProfileController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/change-password', [ClientProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('/profile/my-orders', [ClientProfileController::class, 'myOrders'])->name('profile.my-orders');
    Route::get('/profile/order-detail/{order}', [ClientProfileController::class, 'orderDetail'])->name('profile.order-detail');
    Route::get('/profile/product-reviews', [ClientProfileController::class, 'productReviews'])->name('profile.product-reviews');

    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/destroy', [CartController::class, 'destroy'])->name('cart.delete');
    Route::get('/check-out', [OrderController::class, 'create'])->name('client.checkout');
    Route::post('/check-out', [OrderController::class, 'store'])->name('client.checkout.store');
    Route::get('/payment-result', [OrderController::class, 'vnpayResult']);
    Route::get('/order/apply-coupon', [OrderController::class, 'applyCoupon']);
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/', [LoginController::class, 'create'])->name('login');
    Route::post('/', [LoginController::class, 'store'])->name('login');
    Route::get('/forgot-password', [AdminForgotPasswordController::class, 'create'])->name('forgot-password');
    Route::post('/forgot-password', [AdminForgotPasswordController::class, 'store'])->name('forgot-password');
    Route::get('/reset-password', [AdminForgotPasswordController::class, 'resetPassword'])->name('reset-password');
    Route::post('/reset-password', [AdminForgotPasswordController::class, 'postResetPassword'])->name('reset-password');
});

Route::prefix('admin')->name('admin.')->middleware('administrator')->group(function() {
    //Profile
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [AdminProfileController::class, 'edit'])->name('profile.change-password');
    Route::post('/profile/change-password', [AdminProfileController::class, 'updatePassword'])->name('profile.change-password.update');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    //Brand 
    Route::get('brands/', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

    //Attribute
    Route::get('attributes/', [AttributeController::class, 'index'])->name('attributes.index');
    Route::get('/attributes/create', [AttributeController::class, 'create'])->name('attributes.create');
    Route::post('/attributes', [AttributeController::class, 'store'])->name('attributes.store');
    Route::get('/attributes/{attribute}/edit', [AttributeController::class, 'edit'])->name('attributes.edit');
    Route::put('/attributes/{attribute}', [AttributeController::class, 'update'])->name('attributes.update');
    Route::delete('/attributes/{attribute}', [AttributeController::class, 'destroy'])->name('attributes.destroy');

    // AttributeOption
    Route::get('attributeOptions/', [AttributeOptionController::class, 'index'])->name('attributeOptions.index');
    Route::get('/attributeOptions/create', [AttributeOptionController::class, 'create'])->name('attributeOptions.create');
    Route::post('/attributeOptions', [AttributeOptionController::class, 'store'])->name('attributeOptions.store');
    Route::get('/attributeOptions/{attributeOption}/edit', [AttributeOptionController::class, 'edit'])->name('attributeOptions.edit');
    Route::put('/attributeOptions/{attributeOption}', [AttributeOptionController::class, 'update'])->name('attributeOptions.update');
    Route::delete('/attributeOptions/{attributeOption}', [AttributeOptionController::class, 'destroy'])->name('attributeOptions.destroy');

    //Product
    Route::get('products/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/updateFeatureStatus', [ProductController::class, 'updateFeatureStatus'])->name('products.update-feature-status');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    //Coupon 
    Route::get('coupons/', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy');

    //Order OutSite
    Route::get('orders/', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');

    //User
    Route::get('users/', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/updateStatus', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import');
    Route::get('/users/export', [UserController::class, 'export'])->name('users.export');

    //Review
    Route::get('reviews/', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::post('reviews/{review}/chage-status', [AdminReviewController::class, 'changeReviewStatus'])->name('reviews.changeStatus');

    //Role
    Route::get('roles/', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{role}/authorization', [RoleController::class, 'authorization'])->name('roles.authorization');
    Route::post('/roles/{role}/storeAuthorization', [RoleController::class, 'storeAuthorization'])->name('roles.storeAuthorization');

    // Administrator
    Route::get('administrators/', [AdministratorController::class, 'index'])->name('administrators.index');
    Route::get('/administrators/create', [AdministratorController::class, 'create'])->name('administrators.create');
    Route::post('/administrators', [AdministratorController::class, 'store'])->name('administrators.store');
    Route::get('/administrators/{administrator}/edit', [AdministratorController::class, 'edit'])->name('administrators.edit');
    Route::put('/administrators/{administrator}', [AdministratorController::class, 'update'])->name('administrators.update');
    Route::get('/administrators/updateStatus', [AdministratorController::class, 'updateStatus'])->name('administrators.updateStatus');
    Route::delete('/administrators/{administrator}', [AdministratorController::class, 'destroy'])->name('administrators.destroy');
});

// require __DIR__.'/auth.php';

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'administrator']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
});
