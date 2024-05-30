<?php

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

Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('forms');
Route::prefix('dynamic-form-admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'ShowLoginForm'])->name('admin.login.form');
    Route::post('login-action', [\App\Http\Controllers\AuthController::class, 'login'])->name('admin.login.action');
    Route::group(['middleware' => 'auth:admin'], function () {
        //Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/', [\App\Http\Controllers\FormController::class, 'index'])->name('forms.index');
        Route::get('admin/forms/create', [\App\Http\Controllers\FormController::class, 'create'])->name('forms.create');
        Route::post('admin/forms', [\App\Http\Controllers\FormController::class, 'store'])->name('forms.store');
        Route::get('admin/forms/{form}/edit', [\App\Http\Controllers\FormController::class, 'edit'])->name('forms.edit');
        Route::put('admin/forms/{form}', [\App\Http\Controllers\FormController::class, 'update'])->name('forms.update');
        Route::delete('admin/forms/{form}', [\App\Http\Controllers\FormController::class, 'destroy'])->name('forms.destroy');
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('admin.logout');
    });

});
Route::get('forms/{slug}', [\App\Http\Controllers\FrontendController::class, 'show'])->name('forms.show');
Route::post('forms/{id}/submit', [\App\Http\Controllers\FormController::class, 'submit'])->name('forms.submit');
