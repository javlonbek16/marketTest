<?php

use App\Http\Controllers\AddresController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FilltersController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OfficeWorkersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SallesController;
use App\Http\Controllers\SearchesController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopWorkersController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseWorkersController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Route;

// login and register
// moveProducts

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);
});

// if admin

Route::group(

    ['middleware' => ['auth:sanctum', 'role:admin']],

    function () {

        Route::resource('work', WorkController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('worker-warehouse', WarehouseWorkersController::class)->only([
            'index',  'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('worker-office', OfficeWorkersController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('worker-shop', ShopWorkersController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);
    }
);

//if user register 

Route::group(

    ['middleware' => ['auth:sanctum']],

    function () {

        Route::resource('address', AddresController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('category', CategoryController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]); 

        Route::resource('discount', DiscountController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('product', ProductController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('warehouse', WarehouseController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('shop', ShopController::class)->only([
            'index', 'show', 'store', 'update', 'destroy'
        ]);

        Route::resource('office', OfficeController::class)->only([
            'index', 'show', 'store',  'update', 'destroy'
        ]);

        Route::resource('wallet', WalletController::class)->only([
            'index', 'show', 'store',  'update', 'destroy'
        ]);

        Route::resource('client', ClientController::class)->only([
            'index', 'show', 'store',  'update', 'destroy'
        ]);

        Route::post('/move-product-to-the-shop', [ShopController::class, 'moveProducts']);
        Route::post('/move-product-in-shop', [ShopController::class, 'getProductsInShop']);
        Route::post('/move-worker-in-shop', [ShopController::class, 'getWorkersInShop']);
        Route::post('/move-warehouse-shop', [ShopController::class, 'getShopWarehouse']);
        Route::post('/move-detailes-shop', [ShopController::class, 'getShopDetails']);
        Route::post('/get-warehouse-of-the-product', [ProductController::class, 'getWarehouseOftheProduct']);
        Route::post('/get-shop-of-the-product', [ProductController::class, 'getShopOftheProduct']);
        Route::post('/sell-the-product-to-the-client', [SallesController::class, 'store']);
        Route::post('/fillter-product-category', [FilltersController::class, 'filterProductCategory']);
        Route::post('/fillter-product-discount', [FilltersController::class, 'filterProductDiscount']);
        Route::post('/fillter-product-price', [FilltersController::class, 'filterProductPrice']);
        Route::get('/fillter-product-salled', [FilltersController::class, 'filterSalledProduct']);
        Route::get('/fillter-product-salles', [FilltersController::class, 'FilterSallesProduct']);
        Route::get('/search-work/{work_name}', [SearchesController::class, 'SearchWorkName']);
        Route::get('/search-product/{product_name}', [SearchesController::class, 'SearchProductName']);
        // Route::post('shop', ShopController::class) getOfficeAddress
    }
);
