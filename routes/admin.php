<?php
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\CustomRoleController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\POSController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\TransferController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\PayableController;
use App\Http\Controllers\Admin\ReceivableController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\StocklimitController;
use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LeaveRequestController;
use App\Http\Controllers\Admin\NatureOfLeaveController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'submit']);
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::get('change-language/{locale}', [LanguageController::class, 'changeLanguage'])->name('change.language');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::post('account-status', [DashboardController::class, 'accountStats'])->name('account-status');
        Route::get('settings', [SystemController::class, 'settings'])->name('settings');
        Route::post('settings', [SystemController::class, 'settingsUpdate']);
        Route::get('settings-password', [SystemController::class, 'settings'])->name('settings.password');
        Route::post('settings-password', [SystemController::class, 'settingsPasswordUpdate'])->name('settings-password');

        // Custom Role Routes
        Route::group(['prefix' => 'custom-role', 'as' => 'custom-role.', 'middleware' => ['module:employee_role_section']], function () {
            Route::get('create', [CustomRoleController::class, 'create'])->name('create');
            Route::post('create', [CustomRoleController::class, 'store']);
            Route::get('edit/{id}', [CustomRoleController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [CustomRoleController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [CustomRoleController::class, 'distroy'])->name('delete');
            Route::post('search', [CustomRoleController::class, 'search'])->name('search');
            Route::get('status/{id}/{status}', [CustomRoleController::class, 'status'])->name('status');
            Route::get('export-employee-role', [CustomRoleController::class, 'employee_role_export'])->name('export-employee-role');
        });

        // Employee Routes
        Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => ['module:employee_section']], function () {
            Route::get('add-new', [EmployeeController::class, 'add_new'])->name('add-new');
            Route::post('add-new', [EmployeeController::class, 'store']);
            Route::get('list', [EmployeeController::class, 'list'])->name('list');
            Route::get('update/{id}', [EmployeeController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [EmployeeController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [EmployeeController::class, 'distroy'])->name('delete');
            Route::get('export-employee', [EmployeeController::class, 'employee_list_export'])->name('export-employee');
        });

        // Category Routes
        Route::group(['prefix' => 'category', 'as' => 'category.', 'middleware' => ['module:category_section']], function () {
            Route::get('add', [CategoryController::class, 'index'])->name('add');
            Route::get('add-sub-category', [CategoryController::class, 'subIndex'])->name('add-sub-category');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::get('sub-edit/{id}', [CategoryController::class, 'editSub'])->name('sub-edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::post('update-sub/{id}', [CategoryController::class, 'updateSub'])->name('update-sub');
            Route::post('store', [CategoryController::class, 'store'])->name('store');
            Route::get('status/{id}/{status}', [CategoryController::class, 'status'])->name('status');
            Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        });

        // Brand Routes
        Route::group(['prefix' => 'brand', 'as' => 'brand.', 'middleware' => ['module:brand_section']], function () {
            Route::get('add', [BrandController::class, 'index'])->name('add');
            Route::post('store', [BrandController::class, 'store'])->name('store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [BrandController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [BrandController::class, 'delete'])->name('delete');
        });

        // Unit Routes
        Route::group(['prefix' => 'unit', 'as' => 'unit.', 'middleware' => ['module:unit_section']], function () {
            Route::get('index', [UnitController::class, 'index'])->name('index');
            Route::post('store', [UnitController::class, 'store'])->name('store');
            Route::get('edit/{id}', [UnitController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [UnitController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [UnitController::class, 'delete'])->name('delete');
        });

        // Product Routes
        Route::group(['prefix' => 'product', 'as' => 'product.', 'middleware' => ['module:product_section']], function () {
            Route::get('add', [ProductController::class, 'index'])->name('add');
            Route::post('store', [ProductController::class, 'store'])->name('store');
            Route::get('list', [ProductController::class, 'list'])->name('list');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ProductController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('delete');
            Route::get('barcode-generate/{id}', [ProductController::class, 'barcodeGenerate'])->name('barcode-generate');
            Route::get('barcode/{id}', [ProductController::class, 'barcode'])->name('barcode');
            Route::get('bulk-import', [ProductController::class, 'bulkImportIndex'])->name('bulk-import');
            Route::post('bulk-import', [ProductController::class, 'bulkImportData']);
            Route::get('bulk-export', [ProductController::class, 'bulkExportData'])->name('bulk-export');
            Route::get('get-categories', [ProductController::class, 'getCategories'])->name('get-categories');
            Route::get('remove-image/{id}/{name}', [ProductController::class, 'remove_image'])->name('remove-image');
        });

        // POS Routes
        Route::group(['prefix' => 'pos', 'as' => 'pos.', 'middleware' => ['module:pos_section']], function () {
            Route::get('/', [POSController::class, 'index'])->name('index');
            Route::get('quick-view', [POSController::class, 'quickView'])->name('quick-view');
            Route::post('variant_price', [POSController::class, 'variant_price'])->name('variant_price');
            Route::post('add-to-cart', [POSController::class, 'addToCart'])->name('add-to-cart');
            Route::post('remove-from-cart', [POSController::class, 'removeFromCart'])->name('remove-from-cart');
            Route::post('cart-items', [POSController::class, 'cartItems'])->name('cart_items');
            Route::post('update-quantity', [POSController::class, 'updateQuantity'])->name('updateQuantity');
            Route::post('empty-cart', [POSController::class, 'emptyCart'])->name('emptyCart');
            Route::post('tax', [POSController::class, 'updateTax'])->name('tax');
            Route::post('discount', [POSController::class, 'updateDiscount'])->name('discount');
            Route::get('customers', [POSController::class, 'getCustomers'])->name('customers');
            Route::get('customer-balance', [POSController::class, 'customerBalance'])->name('customer-balance');
            Route::post('order', [POSController::class, 'placeOrder'])->name('order');
            Route::get('orders', [POSController::class, 'orderList'])->name('orders');
            Route::delete('delete-order/{id}', [POSController::class, 'deleteOrder'])->name('delete-order');
            Route::get('order-details/{id}', [POSController::class, 'order_details'])->name('order-details');
            Route::get('invoice/{id}', [POSController::class, 'generateInvoice'])->name('invoice');
            Route::get('search-products', [POSController::class, 'searchProduct'])->name('search-products');
            Route::get('search-by-add', [POSController::class, 'searchByAddProduct'])->name('search-by-add');

            Route::post('coupon-discount', [POSController::class, 'couponDiscount'])->name('coupon-discount');
            Route::post('remove-coupon', [POSController::class, 'removeCoupon'])->name('remove-coupon');
            Route::get('change-cart', [POSController::class, 'changeCart'])->name('change-cart');
            Route::get('new-cart-id', [POSController::class, 'newCartId'])->name('new-cart-id');
            Route::get('clear-cart-ids', [POSController::class, 'clearCartIds'])->name('clear-cart-ids');
            Route::get('get-cart-ids', [POSController::class, 'getCartIds'])->name('get-cart-ids');
        });

        // Account Routes

        Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => ['module:account_section']], function () {
            Route::get('add', [AccountController::class, 'add'])->name('add');
            Route::post('store', [AccountController::class, 'store'])->name('store');
            Route::get('list', [AccountController::class, 'list'])->name('list');
            Route::get('view/{id}', [AccountController::class, 'view'])->name('view');
            Route::get('edit/{id}', [AccountController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [AccountController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [AccountController::class, 'delete'])->name('delete');

            // Expense Routes
            Route::get('add-expense', [ExpenseController::class, 'add'])->name('add-expense');
            Route::post('store-expense', [ExpenseController::class, 'store'])->name('store-expense');

            // Income Routes
            Route::get('add-income', [IncomeController::class, 'add'])->name('add-income');
            Route::post('store-income', [IncomeController::class, 'store'])->name('store-income');

            // Transfer Routes
            Route::get('add-transfer', [TransferController::class, 'add'])->name('add-transfer');
            Route::post('store-transfer', [TransferController::class, 'store'])->name('store-transfer');

            // Transaction Routes
            Route::get('list-transaction', [TransactionController::class, 'list'])->name('list-transaction');
            Route::get('transaction-export', [TransactionController::class, 'export'])->name('transaction-export');

            // Payable Routes
            Route::get('add-payable', [PayableController::class, 'add'])->name('add-payable');
            Route::post('store-payable', [PayableController::class, 'store'])->name('store-payable');
            Route::post('payable-transfer', [PayableController::class, 'transfer'])->name('payable-transfer');

            // Receivable Routes
            Route::get('add-receivable', [ReceivableController::class, 'add'])->name('add-receivable');
            Route::post('store-receivable', [ReceivableController::class, 'store'])->name('store-receivable');
            Route::post('receivable-transfer', [ReceivableController::class, 'transfer'])->name('receivable-transfer');
        });

        // Customer Routes
        Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['module:customer_section']], function () {
            Route::get('add', [CustomerController::class, 'index'])->name('add');
            Route::post('store', [CustomerController::class, 'store'])->name('store');
            Route::get('list', [CustomerController::class, 'list'])->name('list');
            Route::get('view/{id}', [CustomerController::class, 'view'])->name('view');
            Route::get('edit/{id}', [CustomerController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [CustomerController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [CustomerController::class, 'delete'])->name('delete');
            Route::post('update-balance', [CustomerController::class, 'updateBalance'])->name('update-balance');
            Route::get('transaction-list/{id}', [CustomerController::class, 'transactionList'])->name('transaction-list');
        });

        // Supplier Routes
        Route::group(['prefix' => 'supplier', 'as' => 'supplier.', 'middleware' => ['module:supplier_section']], function () {
            Route::get('add', [SupplierController::class, 'index'])->name('add');
            Route::post('store', [SupplierController::class, 'store'])->name('store');
            Route::get('list', [SupplierController::class, 'list'])->name('list');
            Route::get('view/{id}', [SupplierController::class, 'view'])->name('view');
            Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [SupplierController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [SupplierController::class, 'delete'])->name('delete');
            Route::get('products/{id}', [SupplierController::class, 'productList'])->name('products');
            Route::get('transaction-list/{id}', [SupplierController::class, 'transactionList'])->name('transaction-list');
            Route::post('add-new-purchase', [SupplierController::class, 'addNewPurchase'])->name('add-new-purchase');
            Route::post('pay-due', [SupplierController::class, 'payDue'])->name('pay-due');
        });

        // Stock Limit Routes
        Route::group(['prefix' => 'stock', 'as' => 'stock.', 'middleware' => ['module:stock_section']], function () {
            Route::get('stock-limit', [StocklimitController::class, 'stockLimit'])->name('stock-limit');
            Route::post('update-quantity', [StocklimitController::class, 'updateQuantity'])->name('update-quantity');
        });

        // Business Settings Routes
        Route::group(['prefix' => 'business-settings', 'as' => 'business-settings.', 'middleware' => ['actch','module:setting_section']], function () {
            Route::get('shop-setup', [BusinessSettingsController::class, 'shopIndex'])->name('shop-setup');
            Route::post('update-setup', [BusinessSettingsController::class, 'shopSetup'])->name('update-setup');
            Route::get('shortcut-keys', [BusinessSettingsController::class, 'shortcutKey'])->name('shortcut-keys');
        });

        // Coupon Routes
        Route::group(['prefix' => 'coupon', 'as' => 'coupon.', 'middleware' => ['module:coupon_section']], function () {
            Route::get('add-new', [CouponController::class, 'addNew'])->name('add-new');
            Route::post('store', [CouponController::class, 'store'])->name('store');
            Route::get('edit/{id}', [CouponController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [CouponController::class, 'update'])->name('update');
            Route::get('status/{id}/{status}', [CouponController::class, 'status'])->name('status');
            Route::delete('delete/{id}', [CouponController::class, 'delete'])->name('delete');
        });

        // Departement Routes
        Route::group(['prefix' => 'departement', 'as' => 'departement.', 'middleware' => ['module:departement_section']], function () {
            Route::get('', [DepartmentController::class, 'index'])->name('index');
            Route::get('create', [DepartmentController::class, 'create'])->name('create');
            Route::post('store', [DepartmentController::class, 'store'])->name('store');
            Route::get('view/{id}', [DepartmentController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DepartmentController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [DepartmentController::class, 'destroy'])->name('delete');
        });

        // Nature Of Leave Routes
        Route::group(['prefix' => 'natureofleave', 'as' => 'natureofleave.', 'middleware' => ['module:natureofleave_section']], function () {
            Route::get('', [NatureOfLeaveController::class, 'index'])->name('index');
            Route::get('create', [NatureOfLeaveController::class, 'create'])->name('create');
            Route::post('store', [NatureOfLeaveController::class, 'store'])->name('store');
            Route::get('view/{id}', [NatureOfLeaveController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [NatureOfLeaveController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [NatureOfLeaveController::class, 'destroy'])->name('delete');
        });

        // Leave Request Routes
        Route::group(['prefix' => 'leave-request', 'as' => 'leave-request.', 'middleware' => ['module:leave_request_section']], function () {
            Route::get('', [LeaveRequestController::class, 'index'])->name('index');
            Route::get('create', [LeaveRequestController::class, 'create'])->name('create');
            Route::post('store', [LeaveRequestController::class, 'store'])->name('store');
            Route::get('view/{id}', [LeaveRequestController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [LeaveRequestController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [LeaveRequestController::class, 'destroy'])->name('delete');
            Route::post('update-status', [LeaveRequestController::class, 'updateStatus'])->name('update-status')->middleware('module:can_change_status_leave_request');
        });
    });
});

require_once "fileponds.php";
