<?php

use Illuminate\Support\Facades\Route;

//============== Admin Routes =================================
use App\Http\Controllers\{
    Settings,
    AuthController,
    Dashboard,
    RoleController,
    PermissionController,
    UsersController,
    CategoryController,
    ProductController,
    TrucksController,
    SalesmanController,
    ShopsController,
    DailySalesController,
    BillingController,
    Report_Controller,
    AccountsController,
    AccountsController2Controller,
    PDFController,
};

Route::get('/', function (){
    return redirect(route('login'));
});


//====================== Admin Panel Routes =======================


//======================= Admin Login Routes =====================
Route::controller(AuthController::class)->group( function () {
    Route::get("/login","login")->name("login");
    Route::get("/register-user","register_user");
    Route::post("/changep","change_pass");
    Route::post("/checkuser","checkuser");
    Route::get("/logout","logout");
    Route::get("/changepass","change_password");
});


Route::middleware('auth')->group(function () {
    
    Route::prefix('admin')->group(function () {

        //======================= Admin Dashboard Routes ======================
        Route::get("/dashboard",[Dashboard::class,"dashboard"])->name('dashboard');


        //======================= Settings Routes ======================

        Route::controller(Settings::class)->group(function () {
            Route::get("/settings-contents","content")->name('settings-contents');
            Route::post("/add-content","add_content")->name('settings-contents.add');
            Route::get("/bill-settings","bill_settings")->name('bill-settings');
            Route::post("/process-bill-settings","process_bill_settings")->name('process-bill-settings');
        });

        //========================= Roles & Permission =======================

        Route::controller(RoleController::class)->group(function () {
            Route::prefix('role')->group(function () {
                Route::get("/",'roles')->name('roles');
                Route::post("/create-role",'create_role')->name('role.create');
                Route::post("{roleId}/update-role",'update_role')->name('role.update');
                Route::put("/{roleId}/destroy-role",'destroy_role')->name('role.destroy');

                Route::post("/{roleId}/give-permissions",'givePermissionToRole')->name('role.give-permissions');
            });
        });

        Route::controller(PermissionController::class)->group(function () {
            Route::prefix('permission')->group(function () {
                Route::get("/",'permission')->name('permission');
                Route::post("/create-permission",'create_permission')->name('permission.create');
                Route::post("{permissionId}/update-permission",'update_permission')->name('permission.update');
                Route::put("/{permissionId}/destroy-permission",'destroy_permission')->name('permission.destroy');
            });
        });

        //============================== Master Data Routes ===================
        
        Route::prefix('master-data')->group(function () {
            Route::resource('monthly-return', MonthlyReturnMasterController::class);
            Route::resource('remuneration-benefit', RemunerationBenefitController::class);
            Route::resource('franchise-benefit', FranchiseBenefitController::class);
            Route::resource('award-reword', AwardMasterController::class);

            //============================ Lavel Master Routes ========================
            Route::prefix('lavel-master')->group(function () {
                Route::get("/",[Lavel_master::class,"index"])->name('lavel-master');
                Route::get("add-new",[Lavel_master::class,"add_new"])->name('lavel-master.add-new');
                Route::post("process",[Lavel_master::class,"process"])->name('lavel-master.process');
                Route::get("edit/{id}",[Lavel_master::class,"edit"])->name('lavel-master.edit');
                Route::post("process-edit",[Lavel_master::class,"process_edit"])->name('lavel-master.update');
                Route::get("delete/{id}",[Lavel_master::class,"delete"])->name('lavel-master.delete');
            });
        });


        //========================= Users Routes =======================

        Route::controller(UsersController::class)->group(function () {
            Route::prefix('users')->group(function () {
                Route::get('/','index')->name('users');
                Route::get('/add-new','add_new')->name('users.add');
                Route::post('/add-new/process','process')->name('users.add.process');
                Route::get('/edit/{id}','edit')->name('users.edit');
                Route::post('/update','update_process')->name('users.update');
                Route::get('/delete/{id}','delete')->name('users.delete');
            });
        });


        Route::controller(CategoryController::class)->group( function () {
            Route::prefix('category')->group( function () {
                Route::get('','index')->name('category.index');
                Route::get('create','create')->name('category.create');
                Route::post('store','store')->name('category.store');
                Route::get('{id}/edit','edit')->name('category.edit');
                Route::post('update','update')->name('category.update');
                Route::get('{id}/delete','delete')->name('category.delete');
            });
        });

        Route::controller(ProductController::class)->group( function () {
            Route::prefix('products')->group( function () {
                Route::get('','index')->name('products.index');
                Route::post('get-products-by-category','get_products_by_category_id')->name('products.get-products-by-category');
                Route::post('update-product-stock','update_product_stock')->name('products.update-product-stock');
                Route::get('basic-info-create','basic_info_create')->name('products.basic-info-create');
                Route::post('basic-info-process','basic_info_process')->name('products.add-basic-info');

                Route::get('basic-info-edit/{id?}','basic_info_edit')->name('products.basic-info-edit');
                Route::post('basic-info-edit-process','basic_info_edit_process')->name('products.add-basic-edit-info');

                Route::get('price-edit/{id?}','price_edit')->name('products.price-edit');
                Route::post('price-edit-process','price_edit_process')->name('products.price-edit-process');

                
                Route::get('inventory-edit/{id?}','inventory_edit')->name('products.inventory-edit');
                Route::post('inventory-edit-process','inventory_edit_process')->name('products.inventory-edit-process');
                
                Route::get('variation-edit/{id?}','variation_edit')->name('products.variation-edit');
                Route::post('variation-edit-process','variation_edit_process')->name('products.variation-edit-process');
                
                Route::get('product-images-edit/{id?}','product_images_edit')->name('products.product-images-edit');
                Route::post('product-images-edit-process','product_images_edit_process')->name('products.product-images-edit-process');

                Route::get('edit','edit')->name('products.edit');
                Route::get('delete/{id}','destroy')->name('products.delete');
                Route::get('delete-image/{id}','destroy_product_image')->name('products.delete-product-image');

                //==================== Variation Routes ================

                Route::post('add-variation','add_variation')->name('products.variation-add');
                Route::post('add-variation-option','add_variation_option')->name('products.add-variation-option');
                Route::post('get-variation-options','get_variation_options')->name('products.get-variation-options');
                Route::get('delete-variation/{id}','delete_variation')->name('products.variation-delete');
            });
        });


        Route::resource('trucks', TrucksController::class);
        Route::resource('salesmans', SalesmanController::class);
        Route::resource('shops', ShopsController::class);
        Route::resource('daily-sales', DailySalesController::class);
        Route::get('daily-sales/{id}/assigned-products',[DailySalesController::class,'show_assigned_products'])->name('daily-sales.show-assigned-products');
        Route::get('daily-sales/{id}/assigned-products-report',[DailySalesController::class,'show_assigned_products_report'])->name('daily-sales.show-assigned-products-report');
        Route::post('daily-sales/get-truck-products',[DailySalesController::class,'get_truck_products'])->name('daily-sales.get-truck-products');
        Route::post('daily-sales/get-asign-products',[DailySalesController::class,'get_asign_products'])->name('daily-sales.get-asign-products');


        Route::controller(BillingController::class)->group( function () {
            Route::prefix('bills')->group( function () {
                Route::get('','index')->name('bills.index');
                Route::get('todays-bills','todays_bills')->name('bills.todays-bill');
                Route::get('bill-details/{id}','bill_details')->name('bills.bill-details');
            });
        });

        Route::prefix('reports')->group(function () {
            Route::get("/dealer-wise-sales-report",[Report_Controller::class,"dealer_wise_sales_report"])->name('report.dealer-wise-sales-report');
            Route::post("/generate-dealer-wise-sales-report",[Report_Controller::class,"generate_dealer_wise_sales_report"])->name('report.generate-dealer-wise-sales-report');

            Route::get("/salesman-wise-sales-report",[Report_Controller::class,"salesman_wise_sales_report"])->name('report.salesman-wise-sales-report');
            Route::post("/generate-salesman-wise-sales-report",[Report_Controller::class,"generate_salesman_wise_sales_report"])->name('report.generate-salesman-wise-sales-report');

            Route::get("/trucks-wise-sales-report",[Report_Controller::class,"trucks_wise_sales_report"])->name('report.trucks-wise-sales-report');
            Route::post("/generate-trucks-wise-sales-report",[Report_Controller::class,"generate_trucks_wise_sales_report"])->name('report.generate-trucks-wise-sales-report');

            Route::get("/stock-report",[Report_Controller::class,"stock_report"])->name('report.stock-report');
            // Route::post("/report.generate-stock-report",[Report_Controller::class,"generate_stock_report"])->name('report.generate-stock-report');

            Route::get("account-report",[Report_Controller::class,"account_report"])->name('report.account-report');
            Route::post("generate-account-report",[Report_Controller::class,"generate_account_report"])->name('report.generate-account-report');

            Route::get("account-report2",[Report_Controller::class,"account_report2"])->name('report.account-report2');
            Route::post("generate-account-report2",[Report_Controller::class,"generate_account_report2"])->name('report.generate-account-report2');
        });


        Route::resource('accounts', AccountsController::class);
        Route::resource('accounts2', AccountsController2Controller::class);
    });
});

Route::get('/generate-pdf/{id?}', [PDFController::class, 'generatePDF'])->name('generate-pdf');
