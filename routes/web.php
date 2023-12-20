<?php

/// Auth Controller
use App\Http\Controllers\AuthController;

/// Admin Controller
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OutletController as AdminOutletController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

/// Cashier Controller
use App\Http\Controllers\Cashier\TransactionController as CashierTransactionController;
use App\Http\Controllers\Cashier\MemberController as CashierMemberController;
use App\Http\Controllers\Cashier\PacketController as CashierPacketController;
use App\Http\Controllers\Cashier\ReportController as CashierReportController;

/// Owner Controller
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\ReportController as OwnerReportController;
use App\Http\Controllers\Owner\TransactionController as OwnerTransactionController;

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

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index']);

        Route::resource('outlet', AdminOutletController::class);
        Route::resource('user', AdminUserController::class);
        Route::resource('member', AdminMemberController::class);

        Route::get('/report', [AdminReportController::class, 'index']);
    });

Route::redirect('/kasir', '/cashier');
Route::prefix('cashier')
    ->middleware(['auth', 'role:kasir'])
    ->group(function () {
        Route::redirect('/', '/cashier/transaction');

        /// transaction index
        Route::get('/transaction', [CashierTransactionController::class, 'index']);

        /// transaction detail
        Route::get('/transaction/{id}/detail', [CashierTransactionController::class, 'show']);
        Route::put('/transaction/{id}/status', [CashierTransactionController::class, 'updateStatus']);

        /// transaction create proccess
        Route::get('/transaction/find', [CashierTransactionController::class, 'find']);
        Route::get('/transaction/{memberId}/create', [CashierTransactionController::class, 'create']);
        Route::post('/transaction', [CashierTransactionController::class, 'store']);
        Route::get('/transaction/{id}/success', [CashierTransactionController::class, 'success']);

        /// transaction confirmation proccess
        Route::get('/transaction/confirmation', [CashierTransactionController::class, 'confirmation']);
        Route::get('/transaction/{id}/payment', [CashierTransactionController::class, 'payment']);
        Route::put('/transaction/{id}', [CashierTransactionController::class, 'deal']);
        Route::get('/transaction/{id}/done', [CashierTransactionController::class, 'done']);

        Route::resource('member', CashierMemberController::class);
        Route::resource('packet', CashierPacketController::class);

        Route::get('/report', [CashierReportController::class, 'index']);
    });

Route::prefix('owner')
    ->middleware(['auth', 'role:owner'])
    ->group(function () {
        Route::get('/', [OwnerDashboardController::class, 'index']);
        Route::get('/report', [OwnerReportController::class, 'index']);
        Route::get('/transaction/{id}/detail', [OwnerTransactionController::class, 'detail']);
    });
