<?php

use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\jenis;
use App\Models\Products;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\CartController;



// Route landing page
Route::get('/', [HomeController::class, 'index'])->name('home.main');
Route::get('/products', [HomeController::class, 'products'])->name('home.products.index');
Route::get('/articles', [HomeController::class, 'articles'])->name('home.articles.index');
Route::get('/products/{slug}', [HomeController::class, 'productsShow'])->name('home.products.show');
Route::get('/articles/{slug}', [HomeController::class, 'articlesShow'])->name('home.articles.show');
Route::get('/products/jenis/{id}', [HomeController::class, 'productsjenis'])->name('home.products.jenis');
Route::get('/information', [HomeController::class, 'information'])->name('home.information.index');
Route::get('/information/{slug}', [HomeController::class, 'informationShow'])->name('home.information.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact.index');
Route::post('/contact', [HomeController::class, 'contactStore'])->name('home.contact.store');
Route::get('/team', [HomeController::class, 'team'])->name('home.team.index');




//Route halaman admin (sudah kita buat sebelumnya)
Route::middleware(['auth'])->name('admin.')->group(function () {
    //route untuk dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admin/articles', ArticleController::class); // manajemen artikel

    // Rute profil user yang login
    Route::get('admin/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('admin/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('admin/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// Produk (Frontend)
Route::prefix('products')->name('home.products.')->group(function () {
    Route::get('/', [HomeController::class, 'products'])->name('index');
    Route::get('/{slug}', [HomeController::class, 'productsShow'])->name('show');
    Route::get('/categories/{id}', [HomeController::class, 'productsTypes'])->name('types');
});


// Routes untuk Keranjang (Frontend)
Route::prefix('cart')->name('cart.')->group(function () {
    // Tambahkan middleware 'auth' di sini
    Route::post('/add/{product:slug}', [CartController::class, 'addToCart'])->name('add')->middleware('auth');
    Route::get('/', [CartController::class, 'showCart'])->name('show');
    Route::post('/update/{slug}', [CartController::class, 'updateCart'])->name('update');
    Route::delete('/remove/{slug}', [CartController::class, 'removeCart'])->name('remove');
});

// Routes untuk Checkout (Frontend)
// Checkout juga harus memerlukan autentikasi
Route::prefix('checkout')->name('checkout.')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'checkout'])->name('index');
    Route::post('/process', [CartController::class, 'processCheckout'])->name('process');
    Route::get('/success/{orderNumber}', [CartController::class, 'checkoutSuccess'])->name('success');
});



// Route hanya untuk admin
Route::middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    // Semua rute di dalam grup ini akan memerlukan otentikasi dan peran 'admin'
    Route::resource('admin/users', UserController::class); // manajemen user
    Route::resource('admin/categories', CategoryController::class); // manajemen kategori
    Route::resource('admin/jenis', JenisController::class)->parameters(['jenis' => 'jenis']); // manajemen jenis
    Route::resource('admin/products', ProductController::class); // manajemen products
    Route::resource('admin/information', InformationController::class); // manajemen kategori

    // Manajemen Pesanan
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit']);
    Route::put('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    // Manajemen Pesanan
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit']);
    Route::put('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // route untuk inbox
    Route::get('admin/inbox', [InboxController::class, 'index'])->name('inbox.index');
    Route::put('admin/inbox/{inbox}/toggle-status', [InboxController::class, 'toggleStatus'])->name('inbox.toggleStatus');
    Route::delete('admin/inbox/{inbox}', [InboxController::class, 'destroy'])->name('inbox.destroy');
});
