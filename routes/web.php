<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingsUserController;
use App\Http\Controllers\SettingsShopAdminController;
use App\Http\Controllers\SettingsAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchUserController;
use App\Http\Controllers\SearchShopAdminController;
use App\Http\Controllers\SearchShopController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SearchReservationController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SearchFavoriteController;
use App\Http\Controllers\SearchVisitedController;

Route::get('/', [SearchController::class, 'index']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/detail/{shop_id}', [SearchController::class, 'show']);
Route::get('/user/destroy/withdraw', [UserController::class, 'show']);
Route::get('/shopadmin/destroy/withdraw', [ShopAdminController::class, 'show']);
Route::get('/admin/destroy/withdraw', [AdminController::class, 'show']);
Route::get('/shopadmin/send-thanks', [ShopAdminController::class, 'showSend']);
Route::get('/admin/send-thanks', [AdminController::class, 'showSend']);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/mypage', [MypageController::class, 'index']);
    Route::post('/favorite', [FavoriteController::class, 'store']);
    Route::post('/favorite/destroy/{favorite_id}', [FavoriteController::class, 'destroy']);
    Route::get('/evaluation/create/{reservation_id}', [EvaluationController::class, 'create']);
    Route::post('/evaluation', [EvaluationController::class, 'store']);
    Route::get('/evaluation/edit/{evaluation_id}', [EvaluationController::class, 'edit']);
    Route::post('/evaluation/update/{evaluation_id}', [EvaluationController::class, 'update']);
    Route::post('/evaluation/destroy/{evaluation_id}', [EvaluationController::class, 'destroy']);
    Route::post('/reservation', [ReservationController::class, 'store']);
    Route::get('/reservation-thanks', [ReservationController::class, 'show']);
    Route::get('/user/settings', [SettingsUserController::class, 'index']);
    Route::post('/reservation/update/{reservation_id}', [ReservationController::class, 'update']);
    Route::get('/search/favorite', [SearchFavoriteController::class, 'search']);
    Route::get('/search/visited', [SearchVisitedController::class, 'search']);
});

Route::middleware(['auth:shopadmin', 'verified'])->group(function (){
    Route::get('/shopadmin/register-thanks', [ShopAdminController::class, 'showThanks']);
    Route::get('/shopadmin/settings', [SettingsShopAdminController::class, 'index']);
    Route::post('/shop', [ShopController::class, 'store']);
    Route::post('/coupon', [CouponController::class, 'store']);
    Route::post('/coupon/destroy/{coupon_id}', [CouponController::class, 'destroy']);
    Route::get('/reservation/search', [SearchReservationController::class, 'search']);
});

Route::middleware(['auth:admin', 'verified'])->group(function (){
    Route::get('/admin/register-thanks', [AdminController::class, 'showThanks']);
    Route::get('/admin/settings', [SettingsAdminController::class, 'index']);
    Route::get('/admin/settings/shopdetail/{shop_id}', [SettingsAdminController::class, 'editShop']);
    Route::get('/admin/settings/shopadmin/{shop_admin_id}', [SettingsAdminController::class, 'editShopAdmin']);
    Route::get('/admin/settings/user/{user_id}', [SettingsAdminController::class, 'editUser']);
    Route::post('/admin/update', [AdminController::class, 'update']);
    Route::post('/admin/destroy', [AdminController::class, 'destroy']);
    Route::get('/search/user', [SearchUserController::class, 'search']);
    Route::get('/search/shopadmin', [SearchShopAdminController::class, 'search']);
    Route::get('/search/shop', [SearchShopController::class, 'search']);
    Route::post('/notice', [NoticeController::class, 'store']);
    Route::post('/notice/destroy/{notice_id}', [NoticeController::class, 'destroy']);
});

Route::middleware(['auth:shopadmin,admin', 'verified'])->group(function (){
    Route::post('/shopadmin/update', [ShopAdminController::class, 'update']);
    Route::post('/shopadmin/destroy', [ShopAdminController::class, 'destroy']);
    Route::post('/shop/update/{shop_id}', [ShopController::class, 'update']);
    Route::get('/shop/done', [ShopController::class, 'show']);
    Route::post('/shop/destroy/{shop_id}', [ShopController::class, 'destroy']);
});

Route::middleware(['auth:web,admin', 'verified'])->group(function (){
    Route::post('/user/update', [UserController::class, 'update']);
    Route::post('/user/destroy', [UserController::class, 'destroy']);
});

Route::middleware(['auth:web,shopadmin', 'verified'])->group(function (){
    Route::post('/reservation/destroy/{reservation_id}', [ReservationController::class, 'destroy']);
    Route::get('/reservation-cancel', [ReservationController::class, 'cancel']);
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});

Route::prefix('shopadmin')->name('shopadmin.')->group(function(){
    require __DIR__.'/shopadmin.php';
});
