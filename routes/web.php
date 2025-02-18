<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', function() { return redirect('/admin/login'); });

Route::get('/admin', function() { return redirect('/admin/login'); });

Route::get('/admin/login', [AdminController::class, 'loginPage'])->name('admin.loginPage');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'auth:web'], function(){

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/view-customers', [AdminController::class, 'customers'])->name('admin.customers');

    Route::get('/admin/add-customer', [AdminController::class, 'addCustomer'])->name('admin.add-customer');

    Route::post('/admin/save-customer', [AdminController::class, 'saveCustomer'])->name('admin.save-customer');

    Route::get('/admin/view-transaction/{id}', [AdminController::class, 'viewTransaction'])->name('admin.view-transaction');

});
