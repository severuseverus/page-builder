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

Route::get('/', function () {
    return view('pages.new');
});

Route::post('/photos/list', 'Photos\\PhotosController@listPhotos')->name('list');
Route::post('/photos/upload', 'Photos\\PhotosController@save')->name('upload');
Route::post('/photos/delete', 'Photos\\PhotosController@delete')->name('delete');

Route::get('/pages/list', 'Pages\\PagesController@index')->name('pages.list');
Route::get('/pages/new', 'Pages\\PagesController@create')->name('pages.new');
Route::get('/pages/edit', 'Pages\\PagesController@edit')->name('pages.edit');
Route::post('/pages/save', 'Pages\\PagesController@save')->name('pages.save');

Route::post('/templates/list', 'Templates\\TemplatesController@listTemplates')->name('templates.list');
Route::get('/templates/list', 'Templates\\TemplatesController@index')->name('templates.list');
Route::get('/templates/new', 'Templates\\TemplatesController@create')->name('templates.new');
Route::get('/templates/edit/{templateId}', 'Templates\\TemplatesController@edit')->name('templates.edit');
Route::post('/templates/save', 'Templates\\TemplatesController@save')->name('templates.save');

Route::get('/collections/list', 'TemplateCollections\\TemplateCollectionsController@index')->name('template-collections.list');
Route::get('/collections/new', 'TemplateCollections\\TemplateCollectionsController@create')->name('template-collections.new');
Route::get('/collections/edit/{collectionId}', 'TemplateCollections\\TemplateCollectionsController@edit')->name('template-collections.edit');
Route::post('/collections/save', 'TemplateCollections\\TemplateCollectionsController@save')->name('template-collections.save');
Route::delete('/collections/delete/{collectionId}', 'TemplateCollections\\TemplateCollectionsController@destroy')->name('template-collections.delete');