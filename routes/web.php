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

Route::get('/', function () {
    return view('welcome');
})->name('home-fe');

Route::get('/product', 'FrontendController@product')->name('product-fe');
Route::get('/project', 'FrontendController@project')->name('project-fe');
Route::get('/filter/{id}', 'FrontendController@showExpertise')->name('filter');
Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::get('/admin/product', 'ProductController@index')->name('product');
Route::post('/admin/product/insert', 'ProductController@insert')->name('product.insert');
Route::get('/admin/product/{id}/edit', 'ProductController@edit')->name('product.edit');
Route::put('/admin/product/{id}', 'ProductController@update')->name('product.update');
Route::delete('/admin/product/{id}', 'ProductController@destroy')->name('product.destroy');

Route::get('/admin/expertise', 'ExpertiseController@index')->name('expertise');
Route::post('/admin/expertise/store', 'ExpertiseController@store')->name('expertise.store');
Route::get('/admin/expertise/{id}/edit', 'ExpertiseController@edit')->name('expertise.edit');
Route::put('/admin/expertise/{id}', 'ExpertiseController@update')->name('expertise.update');
Route::delete('/admin/expertise/{id}', 'ExpertiseController@destroy')->name('expertise.destroy');

Route::get('/admin/project', 'ProjectController@index')->name('project');
Route::post('/admin/project/store', 'ProjectController@store')->name('project.store');
Route::get('/admin/project/{id}/edit', 'ProjectController@edit')->name('project.edit');
Route::put('/admin/project/{id}', 'ProjectController@update')->name('project.update');
Route::delete('/admin/project/{id}', 'ProjectController@destroy')->name('project.destroy');

Route::get('/admin/blog', 'BlogController@index')->name('blog');
Route::get('/admin/blog/create', 'BlogController@create')->name('blog.create');
Route::post('/admin/blog/store', 'BlogController@store')->name('blog.store');
Route::get('/admin/blog/show/{id}', 'BlogController@show')->name('blog.show');
Route::get('/admin/blog/{id}/edit', 'BlogController@edit')->name('blog.edit');
Route::put('/admin/blog/{id}', 'BlogController@update')->name('blog.update');

Route::post('/admin/blog/category/store', 'BlogCategoryController@store')->name('blog_category.store');
Route::post('/admin/kategori', 'BlogCategoryController@store')->name('kategori');