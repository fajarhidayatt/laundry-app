<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MemberController;
use App\Http\Controllers\admin\OutletController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\UserController;
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
