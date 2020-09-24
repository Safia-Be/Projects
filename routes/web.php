<?php

use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::get('/items',[ItemsController::class, 'index'])->name('items');
Route::get('/items/create',[ItemsController::class, 'createItem']);
Route::post('/items/select',[ItemsController::class, 'selectItem']);
Route::post('/items/unselect',[ItemsController::class, 'unselectItem']);
