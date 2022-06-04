<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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



Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function() {
    Route::get('/logout', 'Auth\LoginController@logout');
    Auth::routes(['register' => false]);
    Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::get('/', 'AdminController@index')->name('dashboard');
        //Dues
        Route::get('/over-due-date', 'AdminController@dues')->name('dues');
        //cities
        Route::resource('cities', 'CitiesController')->middleware('role:locations');
        //areas
        Route::resource('areas', 'AreasController')->middleware('role:locations');
        //types of taxes
        Route::resource('taxTypes', 'TaxTypesController')->middleware('role:taxes');
        //taxes
        Route::resource('taxes', 'TaxesController')->middleware('role:taxes');
        //categories for items
        Route::resource('categories', 'CategoriesController')->middleware('role:items');
        //items
        Route::resource('items', 'ItemsController')->middleware('role:items');
        //customers
        Route::resource('customers', 'CustomersController')->middleware('role:customers');
        /*get areas of cities ajax */
        Route::get('get_areas/{city}', 'CustomersController@getAreas')->name('getAreas');
        //jobs for employees
        Route::resource('jobs', 'Jobscontroller')->middleware('role:employees');
        //salaries for employees
        Route::get('getSalary/{id}', 'SalariesController@getSalary');
        Route::resource('salaries', 'SalariesController')->middleware('role:employees');
        //loans for employees
        Route::resource('loans', 'LoansController')->middleware('role:employees');
        //employees
        Route::resource('employees', 'Employeescontroller')->middleware('role:employees');
        //inventories
        Route::resource('inventories', 'InventoriesController')->middleware('role:inventories');
        //suppliers
        Route::resource('suppliers', 'SuppliersController')->middleware('role:suppliers');
        //return purchase orders
        Route::get('purchaseOrders/returns', 'PurchaseOrdersController@returns')->name('returns.index')->middleware('role:returns');
        Route::get('purchaseOrders/returns/create', 'PurchaseOrdersController@returnsCreate')->name('returns.create')->middleware('role:returns');
        Route::get('purchaseOrders/returns/show/{id}', 'PurchaseOrdersController@returnsShow')->name('returns.show')->middleware('role:returns');
        Route::get('purchaseOrders/returns/getItem/{id}', 'PurchaseOrdersController@getItems')->middleware('role:returns');
        Route::post('purchaseOrders/returns/store', 'PurchaseOrdersController@returnsStore')->name('returns.store')->middleware('role:returns');
        //purchase orders
        Route::resource('purchaseOrders', 'PurchaseOrdersController')->middleware('role:orders');
        //offers
        Route::resource('offers', 'OffersController')->middleware('role:offers');
        //users
        Route::resource('users', 'UsersController')->middleware('role:administrators');
        //roles
        Route::resource('roles', 'RolesController')->middleware('role:administrators');
        //purchase payments
        Route::resource('payments', 'PaymentsController')->middleware('role:purchase_payments');
        //sales payments
        Route::resource('salesPayments', 'SalesPaymentsController')->middleware('role:sales_payments');
        /*get Items by category_id */
        Route::get('getItemsByCategory/{category}', 'AjaxController@getItemsByCategory')->name('getItems');
        Route::get('getItem/{item}/{quantity}/{invoice}', 'AjaxController@getItem')->name('getSales');
        Route::get('getService/{service}/{invoice}', 'AjaxController@getService')->name('getService');
        Route::get('totalMaintenance/{itemSub}/{serviceSub}', 'AjaxController@totalMaintenance')->name('totalMaintenance');

        Route::get('total/{cost}/{quantity}/{invoice}', 'AjaxController@TotalPurchaseOrder')->name('getPurchase');
        Route::get('remaining/{paid}/{total}', 'AjaxController@remaining')->name('getRemaining');
        //sales Order
        Route::resource('salesOrders', 'SalesOrderController')->middleware('role:orders');
        //invoices for sales order
        Route::resource('invoices', 'InvoicesController');
        //Types of expenses
        Route::resource('expensesType', 'ExpenseTypeController')->middleware('role:expenses');
        //expenses
        Route::resource('expenses', 'ExpensesController')->middleware('role:expenses');
        //profits

        Route::get('reports/profits', 'ReportsController@profits')->name('profits')->middleware('role:reports');
        Route::get('reports/purchases', 'ReportsController@purchases')->name('purchase')->middleware('role:reports');
        Route::get('reports/sales', 'ReportsController@sales')->name('sale')->middleware('role:reports');
        Route::get('reports/salesItem', 'ReportsController@salesItem')->name('saleItem')->middleware('role:reports');
        Route::get('reports/expenses', 'ReportsController@expenses')->name('expense')->middleware('role:reports');
        Route::get('reports/returns', 'ReportsController@returns')->name('report.returns')->middleware('role:reports');


        //safes
        Route::get('reports/safes', 'ReportsController@safe')->name('report.safe')->middleware('role:reports');
        Route::get('reports/safes/cash', 'ReportsController@safeCash')->name('report.safeCash')->middleware('role:reports');
        Route::get('reports/safes/visa', 'ReportsController@safeVisa')->name('report.safeVisa')->middleware('role:reports');

        //rents
        Route::get('rents/check-date/{from}/{to}/{dress}/{id?}', 'RentController@checkDate')->name('check.date');
        Route::resource('rents', 'RentController')->except(['store']);
        Route::post('rents/store', 'RentController@store')->name('rents.store');
        Route::match(array('GET', 'POST'),'/rents', 'RentController@index')->name('rents.index');

        //services
        Route::resource('services', 'ServicesController');
        //car brands
        Route::resource('carBrands', 'CarBrandsController');
        //car models
        Route::resource('carModels', 'CarModelsController');
        //cars
        Route::get('cars/insert/{customer_id}', 'CarsController@insert');
        Route::resource('cars', 'CarsController');
        //get models of slected brand
        Route::get('get_Models/{brand_id}', 'AjaxController@getModelsByBrand')->name('getBrands');
        //get customer cars
        Route::get('customerCars/{customer_id}', 'AjaxController@customerCars')->name('getCars');


        //car maintenance
        Route::resource('serviceMaintenance', 'ServiceMaintenanceController');

        //Subcategories
        Route::resource('subCategories', 'SubCategoriesController')->middleware('role:items');

        Route::get('getSubByCategory/{category}', 'AjaxController@getSubByCategory')->name('getSubCategories');
        Route::get('getItemsBySubCategory/{category}', 'AjaxController@getItemsBySubCategory')->name('getItemsBySubCategory');
        Route::get('getItemBySerial/{serial}/{quantity}/{invoice}', 'AjaxController@getItemBySerial')->name('getItemsBySerial');







    });
});
