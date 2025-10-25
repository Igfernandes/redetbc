<?php
use \Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('assistance.assistance_route_prefix')],function(){
    Route::get('/','AssistanceController@index')->name('assistance.search'); // Search
    Route::get('/{slug}','AssistanceController@detail')->name('assistance.detail');// Detail
});

Route::group(['prefix'=>'user/'.config('assistance.assistance_route_prefix'),'middleware' => ['auth','verified']],function(){
    Route::get('/','ManageAssistanceController@manageAssistance')->name('assistance.vendor.index');
    Route::get('/create','ManageAssistanceController@createAssistance')->name('assistance.vendor.create');
    Route::get('/edit/{id}','ManageAssistanceController@editAssistance')->name('assistance.vendor.edit');
    Route::get('/del/{id}','ManageAssistanceController@deleteAssistance')->name('assistance.vendor.delete');
    Route::post('/store/{id}','ManageAssistanceController@store')->name('assistance.vendor.store');
    Route::get('bulkEdit/{id}','ManageAssistanceController@bulkEditAssistance')->name("assistance.vendor.bulk_edit");
    Route::get('/booking-report/bulkEdit/{id}','ManageAssistanceController@bookingReportBulkEdit')->name("assistance.vendor.booking_report.bulk_edit");
    Route::get('/recovery','ManageAssistanceController@recovery')->name('assistance.vendor.recovery');
    Route::get('/restore/{id}','ManageAssistanceController@restore')->name('assistance.vendor.restore');
});

Route::group(['prefix'=>'user/'.config('assistance.assistance_route_prefix')],function(){
    Route::group(['prefix'=>'availability'],function(){
        Route::get('/','AvailabilityController@index')->name('assistance.vendor.availability.index');
        Route::get('/loadDates','AvailabilityController@loadDates')->name('assistance.vendor.availability.loadDates');
        Route::post('/store','AvailabilityController@store')->name('assistance.vendor.availability.store');
        Route::get('/availabilityBooking','AvailabilityController@availabilityBooking')->name('assistance.vendor.availability.availabilityBooking');

    });
});
