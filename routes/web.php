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

