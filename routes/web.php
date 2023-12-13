<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\OutletController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\UserController;

use App\Http\Controllers\Cashier\MemberController as CashierMemberController;
use App\Http\Controllers\Cashier\PacketController;
use App\Http\Controllers\Cashier\TransactionController;
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

Route::prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');

        Route::resource('outlet', OutletController::class);
        Route::resource('user', UserController::class);
        Route::resource('member', MemberController::class);
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    });

Route::prefix('cashier')
    ->group(function () {
        /// transaction menu index
        Route::get('/transaction', [TransactionController::class, 'index']);
        /// transaction find member
        Route::get('/transaction/find', [TransactionController::class, 'find']);
        /// transaction create view
        Route::get('/transaction/{memberId}/create', [TransactionController::class, 'create']);
        /// transaction store data
        Route::post('/transaction', [TransactionController::class, 'store']);
        /// success create transaction
        Route::get('/transaction/{id}/success', [TransactionController::class, 'success']);
        /// find confirmation transaction
        Route::get('/transaction/confirmation', [TransactionController::class, 'confirmation']);
        /// transaction payment
        Route::get('/transaction/{id}/payment', [TransactionController::class, 'payment']);
        /// transaction payment proccess
        Route::put('/transaction/{id}', [TransactionController::class, 'deal']);
        /// transaction done
        Route::get('/transaction/{id}/done', [TransactionController::class, 'done']);
        /// transaction detail
        Route::get('/transaction/{id}', [TransactionController::class, 'show']);

        Route::resource('member', CashierMemberController::class);
        Route::resource('packet', PacketController::class);
    });
