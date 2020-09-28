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

Route::middleware(['guest'])->group(function(){
    Route::get('/', function () {
        return view('login');
    })->name('login');

    Route::post('/auth', '\\'.\App\Http\Controllers\AuthController::class.'@auth')->name('login');
});
Route::middleware(['auth'])->group(function(){
    Route::get('/home', function(){
        return redirect('links');
    });

    Route::get('/links', function(){
        return view('links');
    });
    Route::post('/links/create', '\\'.\App\Http\Controllers\CRUDLinkController::class.'@create')->name('create');
    Route::get('/links/{id}', '\\'.\App\Http\Controllers\CRUDLinkController::class.'@show')->name('show');
    Route::get('/links/{id}/edit', '\\'.\App\Http\Controllers\CRUDLinkController::class.'@edit');
    Route::post('/links/{id}', '\\'.\App\Http\Controllers\CRUDLinkController::class.'@edit')->name('edit');
    Route::delete('/links/{id}', '\\'.\App\Http\Controllers\CRUDLinkController::class.'@delete')->name('delete');

    Route::get('/logout', '\\'.\App\Http\Controllers\AuthController::class.'@logout')->name('logout');
});

Route::get('/{link}', '\\'.\App\Http\Controllers\FollowTheLinkController::class);


