<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CategoryController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\AuthController;

// ==========================================
// RUTE PUBLIK (Halaman Depan / Bebas Akses)
// ==========================================

// Rute jebakan untuk middleware auth bawaan Laravel
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute Detail Event (Modul 9)
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [TicketController::class, 'ticket'])->name('ticket');

Route::get('/profil', function() {
    return view('profil');
});

Route::get('/katalog', function() {
    return view('katalog');
});

Route::get('/bantuan', function() {
    return view('bantuan');
});


// ==========================================
// RUTE ADMINISTRATOR (Panel Admin)
// ==========================================

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Rute Auth (Login & Logout) - Bebas diakses tanpa perlu login
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // 🔒 MENGAMANKAN ROUTE ADMINISTRASI DI BALIK TEMBOK (MIDDLEWARE) 🔒
    Route::middleware(['auth', 'admin'])->group(function () {
        
        // Halaman Dashboard Utama Admin
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Halaman Laporan Transaksi
        Route::get('transactions', [DashboardController::class, 'transactionsAdmin'])->name('transactions.index');
        
        // Fitur Kelola CRUD 
        Route::resource('events', EventAdminController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('partners', PartnerController::class);

        Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
        
    }); // <-- Penutup group middleware
}); // <-- Penutup group prefix admin (Biasanya ini yang tidak sengaja terhapus)

Route::get('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/payment/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');

Route::get('/success/{order_id}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');