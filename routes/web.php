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
    $groupeData = [
        'namespace' => 'Blog\Admin',
        'prefix' => 'admin',
    ];

    Route::group($groupeData, function () {
        Route::resource('index', 'MainController')
            ->names('blog.admin.index');
    });

});

