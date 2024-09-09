<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    ProductController,
    ShopsController,
    PDFController
};

use App\Http\Controllers\API\{
    Billing,
};


Route::post('/login', [AuthController::class, 'app_login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/get-gategory', [CategoryController::class, 'index']);
    Route::post('/get-products-by-category', [ProductController::class, 'get_products_by_category_id']);

    Route::post('/add-to-billing-cart', [Billing::class, 'add_to_billing_cart']);
    Route::get('/bill-preview', [Billing::class, 'bill_preview']);
    Route::post('/add-new-shop', [ShopsController::class, 'store']);
    Route::get('/get-all-shops', [Billing::class, 'get_all_shops']);
    Route::post('/process-bill', [Billing::class, 'process_bill']);
    Route::get('/remove-cart-item/{id}', [Billing::class, 'remove_cart_item']);
    Route::get('/get-all-orders', [Billing::class, 'get_all_orders']);
    Route::get('/get-order-items/{id}', [Billing::class, 'get_order_items']);

    Route::get('/get-bill/{id}', [PDFController::class, 'generatePDF']);
    
    Route::post('/logout', [AuthController::class, 'app_logout']);
});