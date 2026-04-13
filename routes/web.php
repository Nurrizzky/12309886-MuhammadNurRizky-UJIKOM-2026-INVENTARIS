<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowedController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/not-found', [NotFoundController::class, 'index'])->name('404');

Route::middleware('IsNotLogin')->group(function (){
    Route::get('/', function () {
        return view('landing');
    })->name('landing');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login-auth', [AuthController::class, 'login'])->name('login');
});

Route::middleware('IsLogin')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('IsAdmin')->group(function (){
        Route::prefix('/admin')->name('admin.')->group(function () {

            // dahsboard
            Route::get('/dashboard', [DashboardController::class, 'dashboardAdmin'])->name('dashboard');
    
            // categories
            Route::resource('categories', CategoriesController::class)->only('index', 'create', 'store', 'edit', 'update');
    
            // items
            Route::get('/items/export', [ItemsController::class, 'export'])->name('items.export');
            Route::resource('items', ItemsController::class)->only('index', 'create', 'store', 'edit', 'update', 'show');
    
            // Users
            Route::get('/users/admin/export', [UserController::class, 'exportAdmin'])->name('users.export.admin');
            Route::get('/users/staff/export', [UserController::class, 'exportStaff'])->name('users.export.staff');
            Route::get('/users/admin', [UserController::class, 'indexAdmin'])->name('users.admin');
            Route::get('/users/{id}/delete/admin', [UserController::class, 'destroyAdmin'])->name('users.destroy.admin');
            Route::get('/users/{id}/delete/staff', [UserController::class, 'destroyStaff'])->name('users.destroy.staff');
            Route::get('/users/staff', [UserController::class, 'indexStaff'])->name('users.staff');
            Route::get('/users/{id}/edit', [UserController::class, 'editAdmin'])->name('users.admin.edit');
            Route::patch('/users/{id}/update', [UserController::class, 'updateAdmin'])->name('users.admin.update');
            Route::get('/users/create/admin', [UserController::class, 'createAdmin'])->name('users.create.admin');
            Route::get('/users/create/staff', [UserController::class, 'createStaff'])->name('users.create.staff');
            Route::post('/users/store/admin', [UserController::class, 'storeAdmin'])->name('users.store.admin');
            Route::post('/users/store/staff', [UserController::class, 'storeStaff'])->name('users.store.staff');
            Route::get('/users/{id}/reset-password-staff', [UserController::class, 'resetStaff'])->name('users.reset.password.staff');
    
        });
    });

    Route::middleware('IsStaff')->group(function () {
        Route::prefix('/staff')->name('staff.')->group(function () {

            // dashboard
            Route::get('/dashboard', [DashboardController::class, 'dashboardStaff'])->name('dashboard');

            // Users
            Route::get('/users/{id}/edit', [UserController::class, 'editStaff'])->name('users.edit');
            Route::patch('/users/{id}/store', [UserController::class, 'updateStaff'])->name('users.update');
        
            // Items
            Route::get('/items', [ItemsController::class, 'itemsStaff'])->name('items');
        
            // Lending
            Route::get('/lending/export', [LendingController::class, 'export'])->name('export.lending');
            Route::post('/lending/returned/{id}', [LendingController::class, 'returned'])->name('lending.returned');
            Route::resource('lending', LendingController::class)->only('index', 'create', 'store', 'destroy');
        
       });
    });


});