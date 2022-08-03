<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
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

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::resource('unit', UnitController::class)
    ->except('create', 'show', 'edit');
Route::get('transaction', [TransactionController::class, 'index'])
    ->name('transaction.index');
Route::post('transaction', [TransactionController::class, 'store'])
    ->name('transaction.store');
Route::patch('transaction', [TransactionController::class, 'update'])
    ->name('transaction.update');
Route::delete('transaction', [TransactionController::class, 'destroy'])
    ->name('transaction.destroy');
Route::get('transaction/add-item-cart', [TransactionController::class, 'addItemCart'])
    ->name('transaction.addItemCart');
Route::get('list-transaction', [TransactionController::class, 'getListTransaction'])
    ->name('transaction.getListTransaction');

Route::get('list-transaction/invoice/{id}', [TransactionController::class, 'invoice'])
    ->name('transaction.invoice');
