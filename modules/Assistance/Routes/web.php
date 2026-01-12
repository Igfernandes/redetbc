<?php
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
use Illuminate\Support\Facades\Route;
// Vendor Manage Assistance
Route::group(['prefix'=>'user/'.config('assistance.assistance_route_prefix'),'middleware' => ['auth','verified']],function(){
    Route::get('/','ManageAssistanceController@manageAssistance')->name('assistance.vendor.index');
    Route::get('/create','ManageAssistanceController@createAssistance')->name('assistance.vendor.create');
    Route::get('/edit/{id}','ManageAssistanceController@editAssistance')->name('assistance.vendor.edit');
    Route::get('/del/{id}','ManageAssistanceController@deleteAssistance')->name('assistance.vendor.delete');
    Route::post('/store/{id}','ManageAssistanceController@store')->name('assistance.vendor.store');
    Route::get('bulkEdit/{id}','ManageAssistanceController@bulkEditAssistance')->name("assistance.vendor.bulk_edit");
    Route::get('clone/{id}','ManageAssistanceController@cloneAssistance')->name("assistance.vendor.clone");
    Route::get('/booking-report/bulkEdit/{id}','ManageAssistanceController@bookingReportBulkEdit')->name("assistance.vendor.booking_report.bulk_edit");
    Route::get('/recovery','ManageAssistanceController@recovery')->name('assistance.vendor.recovery');
    Route::get('/restore/{id}','ManageAssistanceController@restore')->name('assistance.vendor.restore');
});
Route::group(['prefix'=>'user/'.config('assistance.assistance_route_prefix')],function(){
    Route::group(['prefix'=>'availability'],function(){
        Route::get('/','AvailabilityController@index')->name('assistance.vendor.availability.index');
        Route::get('/loadDates','AvailabilityController@loadDates')->name('assistance.vendor.availability.loadDates');
        Route::post('/store','AvailabilityController@store')->name('assistance.vendor.availability.store');
    });
});
// Assistance
Route::group(['prefix'=>config('assistance.assistance_route_prefix')],function(){
    Route::get('/','\Modules\Assistance\Controllers\AssistanceController@index')->name('assistance.search'); // Search
    Route::get('/{slug}','\Modules\Assistance\Controllers\AssistanceController@detail');// Detail
});
