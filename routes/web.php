<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Core\BlogController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Core\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('main.main');
})->name('main');


Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show-register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('show-login');
    Route::post('/register/handle', [AuthController::class, 'handleRegister'])->name('handle-register');
    Route::post('/login/handle', [AuthController::class, 'handleLogin'])->name('handle-login');
});

Route::get('/logout', [AuthController::class, 'handleLogout'])->name('handle-logout');

Route::middleware(['CheckRole:admin,super admin'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'showDashboard'])->name('show-dashboard');

  
    // Route::get('/blog/{id}', [DashboardController::class, 'showDashboard'])->name('show-blog-detail');
  
    // Route::get('/blog/create/handle', [DashboardController::class, 'showDashboard'])->name('show-dashboard');
    // Route::get('/blog/update/{id}', [DashboardController::class, 'showDashboard'])->name('show-dashboard');
    // Route::get('/blog/delete/{id}', [DashboardController::class, 'showDashboard'])->name('show-dashboard');
    Route::delete('/dashboard/admin/{id}/delete', [DashboardController::class, 'deleteAdmin'])->name('delete-admin');
    Route::get('/berita', [DashboardController::class, 'showBerita'])->name('show-berita');
    Route::get('/admin_management', [DashboardController::class, 'showAdminManagement'])->name('show-admin-management');
    Route::get('/admin_management/user/{id}', [DashboardController::class, 'showAdminDetails'])->name('show-admin-detail');
    Route::post('/admin_management/user/{user:email}/handlestatus', [DashboardController::class, 'changeStatus'])->name('change-admin-status');
   
    Route::middleware(['CheckRole:admin,super admin'])->prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'showBlog'])->name('show-blog');
        Route::get('/create', [DashboardController::class, 'showCreateBlog'])->name('show-create-blog');
        Route::post('/create/new', [BlogController::class, 'storeBlog'])->name('store-blog');
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::get('/{id}', [BlogController::class, 'showDetail'])->name('blog.detail');
        Route::put('{id}/update', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('{id}/delete', [BlogController::class, 'destroy'])->name('blog.destroy');

    });
});