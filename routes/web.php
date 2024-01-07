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
Route::get('/login', [AuthController::class, 'index'])->name('login.view')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin');

        Route::resource('outlet', AdminOutletController::class, ['as' => 'admin']);
        Route::resource('user', AdminUserController::class, ['as' => 'admin']);
        Route::resource('member', AdminMemberController::class, ['as' => 'admin']);

        Route::get('/report', [AdminReportController::class, 'index'])->name('admin.report.index');
    });

Route::redirect('/kasir', '/cashier');
Route::prefix('cashier')
    ->middleware(['auth', 'role:kasir'])
    ->group(function () {
        Route::redirect('/', '/cashier/transaction');

        /// transaction index
        Route::get('/transaction', [CashierTransactionController::class, 'index'])->name('cashier.transaction.index');

        /// transaction detail
        Route::get('/transaction/{id}/detail', [CashierTransactionController::class, 'show'])->name('cashier.transaction.show');
        Route::put('/transaction/{id}/status', [CashierTransactionController::class, 'updateStatus'])->name('cashier.transaction.update-status');

        /// transaction create proccess
        Route::get('/transaction/find', [CashierTransactionController::class, 'find'])->name('cashier.transaction.find');
        Route::get('/transaction/{memberId}/create', [CashierTransactionController::class, 'create'])->name('cashier.transaction.create');
        Route::post('/transaction', [CashierTransactionController::class, 'store'])->name('cashier.transaction.store');
        Route::get('/transaction/{id}/success', [CashierTransactionController::class, 'success'])->name('cashier.transaction.success');

        /// transaction confirmation proccess
        Route::get('/transaction/confirmation', [CashierTransactionController::class, 'confirmation'])->name('cashier.transaction.confirmation');
        Route::get('/transaction/{id}/payment', [CashierTransactionController::class, 'payment'])->name('cashier.transaction.payment');
        Route::put('/transaction/{id}', [CashierTransactionController::class, 'deal'])->name('cashier.transaction.deal');
        Route::get('/transaction/{id}/done', [CashierTransactionController::class, 'done'])->name('cashier.transaction.done');

        Route::resource('member', CashierMemberController::class, ['as' => 'cashier']);
        Route::resource('packet', CashierPacketController::class, ['as' => 'cashier']);

        Route::get('/report', [CashierReportController::class, 'index'])->name('cashier.report.index');
    });

Route::prefix('owner')
    ->middleware(['auth', 'role:owner'])
    ->group(function () {
        Route::get('/', [OwnerDashboardController::class, 'index'])->name('owner');
        Route::get('/report', [OwnerReportController::class, 'index'])->name('owner.report.index');
        Route::get('/transaction/{id}/detail', [OwnerTransactionController::class, 'detail'])->name('owner.transaction.detail');
    });
