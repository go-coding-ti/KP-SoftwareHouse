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

Route::get('/', 'FrontendController@home')->name('home-fe');

Route::get('/product', 'FrontendController@product')->name('product-fe');
Route::get('/project', 'FrontendController@project')->name('project-fe');
Route::get('/filter/{id}', 'FrontendController@showExpertise')->name('filter');
Route::get('/demo','FrontendController@trial')->name('demo');
Route::get('/news', 'FrontendController@blog')->name('news');
Route::get('/blog/{kategori}/{judul}', 'FrontendController@blogShow')->name('blog_show');
Route::get('/blog/{kategori}', 'FrontendController@blogKategori')->name('blog_kategori');
Route::get('/menu/{menu}', 'FrontendController@menu')->name('menu-fe');
Route::get('/menu/{menu}/{submenu}', 'FrontendController@submenu')->name('submenu-fe');
Route::get('/changelanguage', 'FrontendController@chageLanguage')->name('changeLanguage');

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
Route::delete('/admin/blog/{id}', 'BlogController@destroy')->name('blog.destroy');
Route::get('/admin/news/status/{id}', 'BlogController@status');

Route::post('/admin/blog/category/store', 'BlogCategoryController@store')->name('blog_category.store');
Route::post('/admin/kategori', 'BlogCategoryController@store')->name('kategori');
Route::get('/admin/news/category', 'BlogCategoryController@index')->name('blog_category');
Route::post('/admin/news/store', 'BlogCategoryController@store')->name('blog_category.store');
Route::get('/admin/blog/category/{id}/edit', 'BlogCategoryController@edit')->name('blog_category.edit');
Route::put('/admin/blog/category/{id}', 'BlogCategoryController@update')->name('blog_category.update');
Route::delete('/admin/blog/category/{id}', 'BlogCategoryController@destroy')->name('blog_category.destroy');

Route::get('/admin/project/trial', 'ProjectTrialController@index')->name('project_trial');
Route::post('/admin/project/trial/store', 'ProjectTrialController@store')->name('project_trial.store');
Route::get('/admin/project/trial/{id}/edit', 'ProjectTrialController@edit')->name('project_trial.edit');
Route::put('/admin/project/trial/{id}', 'ProjectTrialController@update')->name('project_trial.update');
Route::delete('/admin/project/trial/{id}', 'ProjectTrialController@destroy')->name('project_trial.destroy');

Route::get('/admin/preference', 'PreferenceController@index')->name('preference');
Route::post('/admin/preference/store', 'PreferenceController@store')->name('preference.store');

Route::get('/admin/social-media', 'SocialMediaController@index')->name('social-media');
Route::get('/admin/social-media/{id}/edit', 'SocialMediaController@edit')->name('social-media.edit');
Route::post('/admin/social-media/store', 'SocialMediaController@store')->name('social-media.store');
Route::put('/admin/social-media/{id}', 'SocialMediaController@update')->name('social-media.update');

Route::delete('/admin/social-media/{id}', 'SocialMediaController@destroy')->name('social-media.destroy');

Route::get('/admin/page', 'PageController@index')->name('page');
Route::get('/admin/page/create', 'PageController@create')->name('page.create');
Route::post('/admin/page/store', 'PageController@store')->name('page.store');
Route::get('/admin/page/show/{id}', 'PageController@show')->name('page.show');
Route::get('/admin/page/edit/{id}', 'PageController@edit')->name('page.edit');
Route::put('/admin/page/{id}', 'PageController@update')->name('page.update');
Route::delete('/admin/page/{id}', 'PageController@destroy')->name('page.destroy');

Route::get('/admin/menu', 'MenuController@index')->name('menu');
Route::post('/admin/menu/store', 'MenuController@store')->name('menu.store');
Route::get('/admin/menu/{id}/edit', 'MenuController@edit')->name('menu.edit');
Route::put('/admin/menu/{id}', 'MenuController@update')->name('menu.update');
Route::delete('/admin/menu/{id}', 'MenuController@destroy')->name('menu.destroy');

Route::get('/admin/submenu', 'SubMenuController@index')->name('submenu');
Route::post('/admin/submenu/store', 'SubMenuController@store')->name('submenu.store');
Route::get('/admin/submenu/{id}/edit', 'SubMenuController@edit')->name('submenu.edit');
Route::put('/admin/submenu/{id}', 'SubMenuController@update')->name('submenu.update');
Route::delete('/admin/submenu/{id}', 'SubMenuController@destroy')->name('submenu.destroy');

Route::get('/admin/profile', 'ProfileUser@profile')->name('manuser');
Route::post('/admin/profile/store', 'ProfileUser@profileStore')->name('manuser.profile.store');
Route::post('/admin/profile/changePassword', 'ProfileUser@profileChangePassword')->name('manuser.profile.changePass');

Route::get('/admin/user', 'ManagementUser@index')->name('user');
Route::post('/admin/user/store', 'ManagementUser@store')->name('user.store');
Route::get('/admin/user/{id}/edit', 'ManagementUser@edit')->name('user.edit');
Route::put('/admin/user/{id}', 'ManagementUser@update')->name('user.update');
Route::delete('/admin/user/{id}', 'ManagementUser@destroy')->name('user.destroy');
Route::get('/admin/user/type/{id}', 'ManagementUser@typeChange')->name('user.typeChange');

