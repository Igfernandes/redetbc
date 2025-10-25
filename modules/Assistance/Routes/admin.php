<?php
use \Illuminate\Support\Facades\Route;
Route::get('/','AssistanceController@index')->name('assistance.admin.index');
Route::get('/create','AssistanceController@create')->name('assistance.admin.create');
Route::get('/edit/{id}','AssistanceController@edit')->name('assistance.admin.edit');
Route::post('/store/{id}','AssistanceController@store')->name('assistance.admin.store');
Route::post('/bulkEdit','AssistanceController@bulkEdit')->name('assistance.admin.bulkEdit');
Route::get('/recovery','AssistanceController@recovery')->name('assistance.admin.recovery');
Route::get('/getForSelect2','AssistanceController@getForSelect2')->name('assistance.admin.getForSelect2');

Route::group(['prefix'=>'attribute'],function (){
    Route::get('/','AttributeController@index')->name('assistance.admin.attribute.index');
    Route::get('/edit/{id}','AttributeController@edit')->name('assistance.admin.attribute.edit');
    Route::post('/store/{id}','AttributeController@store')->name('assistance.admin.attribute.store');
    Route::post('/editAttrBulk','AttributeController@editAttrBulk')->name('assistance.admin.attribute.editAttrBulk');

    Route::get('/terms/{id}','AttributeController@terms')->name('assistance.admin.attribute.term.index');
    Route::get('/term_edit/{id}','AttributeController@term_edit')->name('assistance.admin.attribute.term.edit');
    Route::post('/term_store','AttributeController@term_store')->name('assistance.admin.attribute.term.store');
    Route::post('/editTermBulk','AttributeController@editTermBulk')->name('assistance.admin.attribute.term.editTermBulk');

    Route::get('/getForSelect2','AttributeController@getForSelect2')->name('assistance.admin.attribute.term.getForSelect2');
});

Route::group(['prefix'=>'availability'],function(){
    Route::get('/','AvailabilityController@index')->name('assistance.admin.availability.index');
    Route::get('/loadDates','AvailabilityController@loadDates')->name('assistance.admin.availability.loadDates');
    Route::post('/store','AvailabilityController@store')->name('assistance.admin.availability.store');
});
