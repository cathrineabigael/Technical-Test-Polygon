<?php

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/dasbor', function () {
    //     return view('cashflow.dashboard');
    // })->name('dashboard');


    // Route::get('/catat', function () {
    //     return 'ea';
    // })->name('formcatat');

    Route::get('/dasbor', [TransactionController::class, 'dashboard'])->name('dashboard');
    Route::get('/catat', [TransactionController::class, 'formcatat'])->name('formcatat');
    Route::post('/simpan_transaksi', [TransactionController::class, 'store'])->name('transaction.add');
    Route::post('/catat/category', [TransactionController::class, 'get_type'])->name('transaction.category');
    Route::post('/dashboard/incomepercategory', [TransactionController::class, 'incomepercategory'])->name('dashboard.incomepercategory');
    Route::post('/dashboard/expensepercategory', [TransactionController::class, 'expensepercategory'])->name('dashboard.expensepercategory');
    Route::get('/daftar/pemasukan', [TransactionController::class, 'indexincome'])->name('transaction.income');
    Route::get('/daftar/pengeluaran', [TransactionController::class, 'indexexpense'])->name('transaction.expense');
    Route::post('/delete_income', [TransactionController::class, 'delete_data_ajax_income'])->name('income.delete_data');
    Route::post('/verif_income', [TransactionController::class, 'verif_data_ajax_income'])->name('income.verif');
    Route::post('/delete_expense', [TransactionController::class, 'delete_data_ajax_expense'])->name('expense.delete_data');
    Route::post('/verif_expense', [TransactionController::class, 'verif_data_ajax_expense'])->name('expense.verif');
});
