<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
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


// Route url
// Route::get('/', 'DashboardController@dashboardAnalytics');

// Route Dashboards
Route::get('/dashboard-analytics', 'DashboardController@dashboardAnalytics');
// Route Components
Route::get('/sk-layout-2-columns', 'StaterkitController@columns_2');
Route::get('/sk-layout-fixed-navbar', 'StaterkitController@fixed_navbar');
Route::get('/sk-layout-floating-navbar', 'StaterkitController@floating_navbar');
Route::get('/sk-layout-fixed', 'StaterkitController@fixed_layout');

// acess controller
Route::get('/access-control', 'AccessController@index');
Route::get('/access-control/{roles}', 'AccessController@roles');
Route::get('/modern-admin', 'AccessController@home')->middleware('permissions:approve-post');

// Auth::routes();

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

Auth::routes();

Route::middleware('auth')->group(function () {
  //Common Used Routes 
  Route::get('/', 'HomeController@index');
  Route::get('home', 'HomeController@index')->name('home');
  Route::get('/logout', 'HomeController@logout');

  //Admin Used Routes

  //Admin - Tenant Module
  Route::get('/user-dashboard', 'UserController@index')->name('userdashboard');
  Route::get('/user-register', 'UserController@create');
  Route::post('/user-register', 'UserController@store')->name('userregister');
  Route::get('/view-user/{user}', 'UserController@show');
  Route::get('/edit-user/{user}/edit', 'UserController@edit');
  Route::put('/edit-user/{user}', 'UserController@update');
  Route::get('/update-profile', 'ProfileController@edit');
  Route::put('/edit-self', 'ProfileController@update');
  Route::get('/change-user-password', 'ChangePasswordController@edit')
    ->name('change-password');
  Route::put('/change-user-password', 'ChangePasswordController@update')->name('changepassword');
  Route::get('/delete-user/{user}', 'UserController@destroy')->name('userdelete');
  Route::get('/user-approve', 'UserApproveDeclineController@store');
  Route::get('/user-decline', 'UserApproveDeclineController@store');

  //Company Module
  Route::get('companies', 'CompanyController@index')->name('companies');
  Route::get('companies/create', 'CompanyController@create')->name('company.create');
  Route::get('companies/{company}', 'CompanyController@show');
  Route::post('companies', 'CompanyController@store');
  Route::get('companies/{company}/edit', 'CompanyController@edit');
  Route::put('companies/{company}', 'CompanyController@update');

  //Maintainance Services Module
  Route::get('maintainance-services', 'MaintainanceServiceController@index')->name('maintainance-services');
  Route::get('maintainance-services/create', 'MaintainanceServiceController@create')->name('company.create');
  Route::get('maintainance-services/{maintainanceService}', 'MaintainanceServiceController@show');
  //Route::get('companies.getAll', 'CompanyController@getCompanies')->name('companies.get');
  Route::post('maintainance-services', 'MaintainanceServiceController@store');
  Route::get('maintainance-services/{maintainanceService}/edit', 'MaintainanceServiceController@edit');
  Route::put('maintainance-services/{maintainanceService}', 'MaintainanceServiceController@update');
  Route::delete('maintainance-services/{maintainanceService}', 'MaintainanceServiceController@destroy');

  //Maintainance Providers Module
  Route::get('maintainance-providers', 'MaintainanceProviderController@index')->name('maintainance-providers');
  Route::get('maintainance-providers/create', 'MaintainanceProviderController@create')->name('company.create');
  Route::get('maintainance-providers/{maintainanceProvider}', 'MaintainanceProviderController@show');
  Route::post('maintainance-providers', 'MaintainanceProviderController@store');
  Route::get('maintainance-providers/{maintainanceProvider}/edit', 'MaintainanceProviderController@edit');
  Route::put('maintainance-providers/{maintainanceProvider}', 'MaintainanceProviderController@update');
  Route::delete('maintainance-providers/{maintainanceProvider}', 'MaintainanceProviderController@destroy');

  //Payment Used Routs
  Route::get('payments', 'PaymentController@index')->name('payments');
  Route::get('payments/create', 'PaymentController@create')->name('payments.create');
  Route::get('payments/{payment}', 'PaymentController@show');
  Route::post('payments', 'PaymentController@store');
  Route::get('payments/{payment}/edit', 'PaymentController@edit');
  Route::put('payments/{payment}', 'PaymentController@update');
  Route::delete('payments/{payment}', 'PaymentController@destroy');

  //Tenant Used Routes 
  Route::get('near-by-shops', 'NearByShopController@index')->name('near-by-shops');
  Route::get('near-by-serviceproviders', 'NearByMaintainanceServiceProviderController@index')->name('near-by-serviceproviders');
  Route::get('rents', 'RentController@index')->name('rents');
  Route::get('rents/{rent}/edit', 'RentController@edit');
  Route::put('rents/{rent}', 'RentController@update');
  // Route::get('maintainance-services/create', 'MaintainanceServiceController@create')->name('company.create');
  // Route::get('maintainance-services/{maintainanceService}', 'MaintainanceServiceController@show');
  // //Route::get('companies.getAll', 'CompanyController@getCompanies')->name('companies.get');
  // Route::post('maintainance-services', 'MaintainanceServiceController@store');
  // Route::get('maintainance-services/{maintainanceService}/edit', 'MaintainanceServiceController@edit');
  // Route::put('maintainance-services/{maintainanceService}', 'MaintainanceServiceController@update');
  // Route::delete('maintainance-services/{maintainanceService}', 'MaintainanceServiceController@destroy');
});
