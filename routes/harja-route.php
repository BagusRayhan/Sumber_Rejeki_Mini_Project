Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');
Route::get('persetujuan-pembayaran-pending', [AdminBayarController::class, 'persetujuan'])->name('setuju-bayar-admin');
Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');

<!-- client  -->
Route::get('revisibutton', [SelesaiController::class, 'revisibutton'])->name('revisibutton');


<!-- route baru -->
Route::post('postsignup', [AuthController::class, 'signupsave'])->name('postsignup');
Route::post('postlogin', [AuthController::class, 'login'])->name('postlogin');
Route::get('/', [AuthController::class, 'index'])->name('login');
