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
    ExpenceAPI,
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
    Route::post('/decrese-cart-item-quantity', [Billing::class, 'decrese_cart_item_quantity']);
    Route::post('/clear-cart', [Billing::class, 'clear_carts']);
    Route::get('/get-all-orders', [Billing::class, 'get_all_orders']);
    Route::get('/get-order-items/{id}', [Billing::class, 'get_order_items']);

    Route::get('/get-bill/{id}', [PDFController::class, 'generate_bill_url']);

    Route::get('/get-expence-head', [ExpenceAPI::class, 'expence_category']);
    Route::post('/submit-expence', [ExpenceAPI::class, 'process_expence']);
    Route::get('/get-expences', [ExpenceAPI::class, 'get_expences']);
    Route::delete('/delete-expence', [ExpenceAPI::class, 'delete_expence']);
    
    Route::post('/logout', [AuthController::class, 'app_logout']);
});