<?php

Route::group(['namespace' => 'Sixturbo\Support\Http\Controllers', 'middleware' => ['web','guest']] + config('faq.prefix'), function(){

	Route::get('faq', 'FaqCategoryController@index')->name('faq');
	Route::get('faq/{faq}', 'FaqCategoryController@show')->name('faq.show');
	Route::get('faq-category/{faq_category}', 'FaqCategoryController@category')->name('faq.category');

	Route::group(['prefix' => 'admin'] + config('faq.middleware'), function(){
		Route::get('faq-categories', 'Admin\FaqCategoryController@index')->name('faq.category.admin.index');
		Route::post('faq-categories', 'Admin\FaqCategoryController@store')->name('faq.category.admin.store');
		Route::post('faq-categories/{faq_category}', 'Admin\FaqCategoryController@update')->name('faq.category.admin.update');
		Route::delete('faq-categories/{faq_category}', 'Admin\FaqCategoryController@delete')->name('faq.category.admin.delete');
		Route::get('faq-categories/{faq_category}/faq', 'Admin\FaqController@index')->name('faq.admin.index');
		Route::post('faq-categories/{faq_category}/faq', 'Admin\FaqController@create')->name('faq.admin.create');
		Route::get('faq-categories/{faq_category}/faq/{faq}/edit', 'Admin\FaqController@edit')->name('faq.admin.edit');
		Route::post('faq-categories/{faq_category}/faq/{faq}', 'Admin\FaqController@update')->name('faq.admin.update');
		Route::delete('faq-categories/{faq_category}/faq/{faq}', 'Admin\FaqController@delete')->name('faq.admin.delete');
	});
});