<?php

use App\Models\Blog;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Core\BlogController;
use App\Http\Controllers\Core\BeritaController;
use App\Http\Controllers\Core\DashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    // Ambil data blog dan berita terbaru
    $blogs = Blog::latest()->take(6)->get();
    $berita = Berita::latest()->take(6)->get();

    // Format data blog
    $blogs->transform(function ($blog) {
        $html = Storage::disk('local')->exists($blog->content_path)
            ? Storage::disk('local')->get($blog->content_path)
            : '';
        $blog->preview = Str::limit(strip_tags($html), 200, '...');
        $blog->thumbnail_url = asset('storage/' . $blog->thumbnail_path);
        return $blog;
    });

    // Format data berita
    $berita->transform(function ($item) {
        $html = Storage::disk('local')->exists($item->content_path)
            ? Storage::disk('local')->get($item->content_path)
            : '';
        $item->preview = Str::limit(strip_tags($html), 200, '...');
        $item->thumbnail_url = asset('storage/' . $item->thumbnail_path);
        return $item;
    });

    // Kirim ke view
    return view('main.main', compact('blogs', 'berita'));
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
        
        Route::get('/main/{id}', [BlogController::class, 'show'])->name('blog.detail.main');
        Route::get('/main', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/main/search', [BlogController::class, 'search'])->name('blog.search');
    });

    Route::middleware(['CheckRole:admin,super admin'])->prefix('berita')->group(function () {   
          Route::get('/', [BeritaController::class, 'index'])->name('show-berita');
        Route::get('/create', [BeritaController::class, 'showCreate'])->name('show-berita-create');
        Route::post('/create/new', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
        Route::get('/{id}', [BeritaController::class, 'show'])->name('berita.detail');

     });
});

  Route::get('/blog/main/{id}', [BlogController::class, 'showBlogDetail'])->name('blog.detail.main');
  Route::get('/blog/main', [BlogController::class, 'indexBlog'])->name('blog.index');
  Route::get('/search', [BlogController::class, 'search'])->name('blog.search');

 Route::get('/berita/main', [BeritaController::class, 'indexBerita'])->name('berita.index');
 Route::get('/berita', [BeritaController::class, 'index'])->name('berita.search');
 Route::get('/berita/{id}', [BeritaController::class, 'detailBerita'])->name('berita.detail.main');
