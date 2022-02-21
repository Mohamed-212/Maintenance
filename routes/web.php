<?php

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


Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();
Route::group(['middleware' => ['auth', 'role:Admin'], 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('/', 'AdminController@index')->name('dashboard');
    //Dues
    Route::get('/over-due-date', 'AdminController@dues')->name('dues');
    //cities
    Route::resource('cities', 'CitiesController');
    //areas
    Route::resource('areas', 'AreasController');
    //types of taxes
    Route::resource('taxTypes', 'TaxTypesController');
    //taxes
    Route::resource('taxes', 'TaxesController');
    //categories for items
    Route::resource('categories', 'CategoriesController');
    //items
    Route::resource('items', 'ItemsController');
    //customers
    Route::resource('customers', 'CustomersController');
    /*get areas of cities ajax */
    Route::get('get_areas/{city}', 'CustomersController@getAreas')->name('getAreas');
    //jobs for employees
    Route::resource('jobs', 'Jobscontroller');
    //salaries for employees
    Route::get('getSalary/{id}', 'SalariesController@getSalary');
    Route::resource('salaries', 'SalariesController');
    //loans for employees
    Route::resource('loans', 'LoansController');
    //employees
    Route::resource('employees', 'Employeescontroller');
    //inventories
    Route::resource('inventories', 'InventoriesController');
    //suppliers
    Route::resource('suppliers', 'SuppliersController');
    //return purchase orders
    Route::get('purchaseOrders/returns', 'PurchaseOrdersController@returns')->name('returns.index');
    Route::get('purchaseOrders/returns/create', 'PurchaseOrdersController@returnsCreate')->name('returns.create');
    Route::get('purchaseOrders/returns/show/{id}', 'PurchaseOrdersController@returnsShow')->name('returns.show');
    Route::get('purchaseOrders/returns/getItem/{id}', 'PurchaseOrdersController@getItems');
    Route::post('purchaseOrders/returns/store', 'PurchaseOrdersController@returnsStore')->name('returns.store');
    //purchase orders
    Route::resource('purchaseOrders', 'PurchaseOrdersController');
    //offers
    Route::resource('offers', 'OffersController');
    //users
    Route::resource('users', 'UsersController');
    //roles
    Route::resource('roles', 'RolesController');
    //purchase payments
    Route::resource('payments', 'PaymentsController');
    //sales payments
    Route::resource('salesPayments', 'SalesPaymentsController');
    /*get Items by category_id */
    Route::get('getItemsByCategory/{category}', 'AjaxController@getItemsByCategory')->name('getItems');
    Route::get('getItem/{item}/{quantity}/{invoice}', 'AjaxController@getItem')->name('getSales');
    Route::get('getService/{service}/{invoice}', 'AjaxController@getService')->name('getService');
    Route::get('totalMaintenance/{itemSub}/{serviceSub}', 'AjaxController@totalMaintenance')->name('totalMaintenance');

    Route::get('total/{cost}/{quantity}/{invoice}', 'AjaxController@TotalPurchaseOrder')->name('getPurchase');
    Route::get('remaining/{paid}/{total}', 'AjaxController@remaining')->name('getRemaining');
    //sales Order
    Route::resource('salesOrders', 'SalesOrderController');
    //invoices for sales order
    Route::resource('invoices', 'InvoicesController');
    //Types of expenses
    Route::resource('expensesType', 'ExpenseTypeController');
    //expenses
    Route::resource('expenses', 'ExpensesController');
    //profits

    Route::get('reports/profits', 'ReportsController@profits')->name('profits');
    Route::get('reports/purchases', 'ReportsController@purchases')->name('purchase');
    Route::get('reports/sales', 'ReportsController@sales')->name('sale');
    Route::get('reports/salesItem', 'ReportsController@salesItem')->name('saleItem');
    Route::get('reports/expenses', 'ReportsController@expenses')->name('expense');
    Route::get('reports/returns', 'ReportsController@returns')->name('report.returns');


    //safes
    Route::get('reports/safes', 'ReportsController@safe')->name('report.safe');
    Route::get('reports/safes/cash', 'ReportsController@safeCash')->name('report.safeCash');
    Route::get('reports/safes/visa', 'ReportsController@safeVisa')->name('report.safeVisa');

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
    Route::resource('subCategories', 'SubCategoriesController');

    Route::get('getSubByCategory/{category}', 'AjaxController@getSubByCategory')->name('getSubCategories');
    Route::get('getItemsBySubCategory/{category}', 'AjaxController@getItemsBySubCategory')->name('getItemsBySubCategory');
    Route::get('getItemBySerial/{serial}/{quantity}/{invoice}', 'AjaxController@getItemBySerial')->name('getItemsBySubCategory');







});
