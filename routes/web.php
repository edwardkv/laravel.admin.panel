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
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/** Admin side **/



Route::group(['middleware' => ['status', 'auth']], function () {

    $groupData = [
        'namespace' => '\App\Http\Controllers\Blog\Admin',
        'prefix' => 'admin',
    ];

    Route::group($groupData, function () {
        Route::resource('index', 'MainController')
            ->names('blog.admin.index');

        Route::resource('orders','OrderController')
            ->names('blog.admin.orders');
        Route::get('/orders/change/{id}','OrderController@change')
            ->name('blog.admin.orders.change');
        Route::post('/orders/save/{id}','OrderController@save')
            ->name('blog.admin.orders.save');
        Route::get('/orders/forcedestroy/{id}','OrderController@forcedestroy')
            ->name('blog.admin.orders.forcedestroy');

        Route::get('/categories/mydel','CategoryController@mydel')
            ->name('blog.admin.categories.mydel');
        #$methods = ['index','edit','update','create','store', 'destroy','mydel'];
        Route::resource('categories', 'CategoryController')
            ->names('blog.admin.categories');

        Route::resource('users','UserController')
            ->names('blog.admin.users');

        Route::resource('products','ProductController')
            ->names('blog.admin.products');

        Route::get('/products/related','ProductController@related');

        Route::match(['get', 'post'], '/products/ajax-image-upload', 'ProductController@ajaxImage');
        Route::delete('/products/ajax-remove-image/{filename}', 'ProductController@deleteImage');

        Route::post('/products/gallery','ProductController@gallery')
            ->name('blog.admin.products.gallery');

        Route::post('/products/delete-gallery','ProductController@deleteGallery')
            ->name('blog.admin.products.deletegallery');

        Route::get('/products/return-status/{id}','ProductController@returnStatus')
            ->name('blog.admin.products.returnstatus');
        Route::get('/products/delete-status/{id}','ProductController@deleteStatus')
            ->name('blog.admin.products.deletestatus');
        Route::get('/products/delete-product/{id}', 'ProductController@deleteProduct')
            ->name('blog.admin.products.deleteproduct');

        Route::get('/filter/group-filter', 'FilterController@attributeGroup');
        Route::get('/filter/group-add', 'FilterController@attributeGroup');
        Route::match(['get','post'],'/filter/group-add-group', 'FilterController@groupAdd');
        Route::match(['get','post'],'/filter/group-edit/{id}','FilterController@groupEdit');
        Route::get('/filter/group-delete/{id}', 'FilterController@groupDelete');
        Route::get('/filter/attributes-filter', 'FilterController@attributeFilter');
        Route::match(['get','post'],'/filter/attrs-add', 'FilterController@attributeAdd');
        Route::get('/filter/attr-delete/{id}', 'FilterController@attrDelete');
        Route::match(['get','post'],'/filter/attr-edit/{id}','FilterController@attrEdit');

        Route::get('/currency/index','CurrencyController@index');
        Route::match(['get','post'],'/currency/add','CurrencyController@add');
        Route::match(['get','post'],'/currency/edit/{id}','CurrencyController@edit');
        Route::get('/currency/delete/{id}','CurrencyController@delete');

        Route::get('/search/result', 'SearchController@index');
        Route::get('/autocomplete', 'SearchController@search');


    });

    Route::get('user/index','\App\Http\Controllers\Blog\User\MainController@index');

    error_reporting(E_ALL & ~E_NOTICE);

//    //User side
//  $groupeData = [
//        'namespace' => '\App\Http\Controllers\',
//        'prefix' => 'user',
//    ];
//    Route::group($groupeData, function () {
//        Route::resource('index', 'MainController')
//            ->names('blog.user.index');
//    });
//    //---------
//
//
//    //Disabled side - in that moment don`t work yet
//    $groupeData = [
//        'namespace' => 'Blog\Disabled',
//        'prefix' => 'disabled',
//    ];
//    Route::group($groupeData, function () {
//        Route::resource('index', 'MainController')
//            ->names('blog.disabled.index');
//    });
    //---------




});

