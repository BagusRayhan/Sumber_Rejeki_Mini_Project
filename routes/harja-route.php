Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');
Route::get('persetujuan-pembayaran-pending', [AdminBayarController::class, 'persetujuan'])->name('setuju-bayar-admin');
Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');

<!-- client  -->
Route::get('revisibutton', [SelesaiController::class, 'revisibutton'])->name('revisibutton');


<!-- route baru -->
Route::post('postsignup', [AuthController::class, 'signupsave'])->name('postsignup');
Route::post('postlogin', [AuthController::class, 'login'])->name('postlogin');
Route::get('/', [AuthController::class, 'index'])->name('login');




Route::middleware('auth')->group(function(){

Route::get('indexclient', [IndexcController::class, 'indexclient'])->name('indexclient');
Route::get('drequestclient', [IndexcController::class, 'drequestclient'])->name('drequestclient');
Route::get('createproreq', [IndexcController::class, 'createproreq'])->name('createproreq');
Route::post('simpanpro', [IndexcController::class, 'simpan'])->name('simpanpro');
Route::get('requestclient', [IndexcController::class, 'requestclient'])->name('requestclient');
Route::get('editproreq/{id}', [IndexcController::class, 'editproreq'])->name('editproreq');
Route::put('updateproreq/{id}', [IndexcController::class, 'update'])->name('updateproreq');
Route::get('setujuclient', [SetujuController::class, 'setujuclient'])->name('setujuclient');
Route::get('selesaiclient', [SelesaiController::class, 'selesaiclient'])->name('selesaiclient');
Route::get('revisiclient', [SelesaiController::class, 'revisiclient'])->name('revisiclient');
Route::get('ditolakclient', [TolakController::class, 'ditolakclient'])->name('ditolakclient');
Route::get('bayarclient', [BayarController::class, 'bayarclient'])->name('bayarclient');
Route::get('bayar2client', [BayarController::class, 'bayar2client'])->name('bayar2client');
Route::get('detailsetujui', [SetujuController::class, 'detailsetujui'])->name('detailsetujui');
Route::get('revisiselesai', [SelesaiController::class, 'revisiselesai'])->name('revisiselesai');
Route::get('revisibutton', [SelesaiController::class, 'revisibutton'])->name('revisibutton');
Route::get('detail-revisi-client', [SelesaiController::class, 'detail'])->name('detail-revisi-client');
});


Route::get('logout', [AuthController::class, 'logout'])->name('logout');




Route::post('updatekebijakan', [PengaturanController::class, 'updatekebijakan'])->name('updatekebijakan');

//harja
Route::get('pembayaran-digital/getrekening/{id}', [AdminBayarController::class, 'getRekening'])->name('getRekening');


// route baru kebijakan

Route::get('kebijakan', [PengaturanController::class, 'kebijakan'])->name('kebijakan');
