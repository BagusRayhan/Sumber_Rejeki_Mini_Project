Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard'); 
Route::get('persetujuan-pembayaran-pending', [AdminBayarController::class, 'persetujuan'])->name('setuju-bayar-admin');
Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');