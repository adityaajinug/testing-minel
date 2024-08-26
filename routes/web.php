<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(BlogController::class)
    ->as('admin.blog.')
    ->prefix('admin/blog')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::post('/store', 'store')->name('store');
        Route::get('/{uuid}/edit', 'edit')->name('edit');
        Route::put('/{uuid}/update', 'update')->name('update');
        Route::delete('/{uuid}/destroy', 'destroy')->name('destroy');
    });
