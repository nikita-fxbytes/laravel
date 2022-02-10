<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [CustomerController::class, 'index']);
Route::resource('customer', CustomerController::class);
Route::get('customers/trash', [CustomerController::class, 'trash'])->name('customer.trash');
Route::post('customers/{id}/restore', [CustomerController::class, 'restore'])->name('customer.restore');
Route::delete('customers/{id}/forceDelete',[CustomerController::class, 'delete'])->name('customer.delete');
Route::post('customers/restoreall', [CustomerController::class, 'restoreAll'])->name('customer.restoreall');
Route::delete('customers/deleteall', [CustomerController::class, 'deleteAll'])->name('customer.deleteall');
Route::delete('customers/trashall', [CustomerController::class, 'trashAll'])->name('customer.trashall');
Route::post('customers/{id}/active', [CustomerController::class, 'active'])->name('customer.active');
Route::get('changestatus', [CustomerController::class, 'changeStatus'])->name('changestatus');
Auth::routes();

Route::get('/', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');

