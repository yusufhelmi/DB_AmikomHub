<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\PartnerController;

Route::delete('/admin/partners/{partner}', [PartnerController::class, 'destroy'])->name('admin.partners.destroy');
Route::get('/admin/partners/create', [PartnerController::class, 'create'])->name('admin.partners.create');
Route::post('/admin/partners', [PartnerController::class, 'store'])->name('admin.partners.store');
Route::get('/admin/partners', [PartnerController::class, 'index'])->name('admin.partners.index');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/1', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::get('/my-ticket', [TicketController::class, 'ticket'])->name('ticket');


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [DashboardController::class, 'indexAdmin'])->name('events.index');
    Route::get('/transactions', [DashboardController::class, 'transactionsAdmin'])->name('transactions.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', EventAdminController::class);
});

Route::get('/profil', function() {
    return view('profil');
});

Route::get('/katalog', function() {
    return view('katalog');
});

Route::get('/bantuan', function() {
    return view('bantuan');
});

