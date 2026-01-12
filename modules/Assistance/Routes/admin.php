<?php
use Illuminate\Support\Facades\Route;

Route::get('/','AssistanceController@index')->name('assistance.admin.index');
Route::get('/create','AssistanceController@create')->name('assistance.admin.create');
Route::get('/edit/{id}','AssistanceController@edit')->name('assistance.admin.edit');
Route::post('/store/{id}','AssistanceController@store')->name('assistance.admin.store');
Route::get('/getForSelect2','AssistanceController@getForSelect2')->name('assistance.admin.getForSelect2');
Route::post('/bulkEdit','AssistanceController@bulkEdit')->name('assistance.admin.bulkEdit');
Route::get('/recovery','AssistanceController@recovery')->name('assistance.admin.recovery');
Route::get('/getForSelect2','AssistanceController@getForSelect2')->name('assistance.admin.getForSelect2');

Route::get('/category','CategoryController@index')->name('assistance.admin.category.index');
Route::get('/category/edit/{id}','CategoryController@edit')->name('assistance.admin.category.edit');
Route::post('/category/store/{id}','CategoryController@store')->name('assistance.admin.category.store');
Route::get('/category/getForSelect2','CategoryController@getForSelect2')->name('assistance.admin.category.category.getForSelect2');
Route::post('/category/bulkEdit','CategoryController@bulkEdit')->name('assistance.admin.category.bulkEdit');

Route::group(['prefix'=>'attribute'],function(){
    Route::get('/','AttributeController@index')->name('assistance.admin.attribute.index');
    Route::get('/edit/{id}','AttributeController@edit')->name('assistance.admin.attribute.edit');
    Route::post('/store/{id}','AttributeController@store')->name('assistance.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('assistance.admin.attribute.editAttrBulk');


    Route::get('/terms/{attr_id}','AttributeController@terms')->name('assistance.admin.attribute.term.index');
    Route::get('/term_edit/{id}','AttributeController@term_edit')->name('assistance.admin.attribute.term.edit');
    Route::post('/term_store/{id}','AttributeController@term_store')->name('assistance.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('assistance.admin.attribute.term.editTermBulk');
});


Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('assistance.admin.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('assistance.admin.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('assistance.admin.availability.store');
});


Route::get('/booking','BookingController@index')->name('assistance.admin.booking.index');
