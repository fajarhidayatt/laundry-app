<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\OutletController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
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

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin');

        Route::resource('outlet', OutletController::class);
        Route::resource('user', UserController::class);
        Route::resource('member', MemberController::class);
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    })
    ->prefix('cashier')
    ->group(function () {
        Route::redirect('/', '/cashier/transaction');

        Route::get('/transaction', [TransactionController::class, 'index']);
        Route::get('/transaction/find', [TransactionController::class, 'find']);
        Route::get('/transaction/{memberId}/create', [TransactionController::class, 'create']);
        Route::post('/transaction', [TransactionController::class, 'store']);
        Route::get('/transaction/{id}/success', [TransactionController::class, 'success']);
        Route::get('/transaction/confirmation', [TransactionController::class, 'confirmation']);
        Route::get('/transaction/{id}/payment', [TransactionController::class, 'payment']);
        Route::put('/transaction/{id}', [TransactionController::class, 'deal']);
        Route::get('/transaction/{id}/done', [TransactionController::class, 'done']);
        Route::get('/transaction/{id}', [TransactionController::class, 'show']);

        Route::resource('member', CashierMemberController::class);
        Route::resource('packet', PacketController::class);
    });
