<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectrequestController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\IndexcController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\SetujuController;
use App\Http\Controllers\TolakController;
use App\Http\Controllers\AdminBayarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectDisetujuiController;
use App\Http\Controllers\PengaturanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login Register

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('postlogin', [AuthController::class, 'login'])->name('postlogin');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('postsignup', [AuthController::class, 'signupsave'])->name('postsignup');
Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::get('kebijakan', [AuthController::class, 'kebijakan'])->name('kebijakan');
Route::get('kebijakan', [PengaturanController::class, 'kebijakan'])->name('kebijakan');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function(){

    //Halaman Client
    Route::get('indexclient', [IndexcController::class, 'indexclient'])->name('indexclient');
    Route::get('drequestclient', [IndexcController::class, 'drequestclient'])->name('drequestclient');
    Route::get('createproreq', [IndexcController::class, 'createproreq'])->name('createproreq');
    Route::get('showproj', [IndexcController::class, 'showproj'])->name('showproj');
    Route::post('simpanpro', [IndexcController::class, 'simpann'])->name('simpanpro');
    Route::post('simpanfitur/{id}', [IndexcController::class, 'simpannn'])->name('simpanfitur');
  
    // Menampilkan form modal
Route::get('fitur/{id}/edit', [IndexcController::class, 'showFormModal'])->name('fituredit');

// Memperbarui fitur
    Route::put('updatefitur/{id}', [IndexcController::class, 'updateFitur'])->name('updatefitur');

    Route::get('requestclient', [IndexcController::class, 'requestclient'])->name('requestclient');
    Route::get('editproreq/{id}', [IndexcController::class, 'editproreq'])->name('editproreq');
    Route::put('updateproreq/{id}', [IndexcController::class, 'update'])->name('updateproreq');
    Route::post('simpandesk', [IndexcController::class, 'simpand'])->name('simpandesk');
    Route::get('setujuclient', [ProjectDisetujuiController::class, 'disetujuiClient'])->name('setujuclient');
    Route::get('selesaiclient', [SelesaiController::class, 'selesaiclient'])->name('selesaiclient');
    Route::get('revisiclient', [SelesaiController::class, 'revisiclient'])->name('revisiclient');
    Route::get('ditolakclient', [TolakController::class, 'ditolakclient'])->name('ditolakclient');
    Route::get('bayarclient', [BayarController::class, 'bayarclient'])->name('bayarclient');
    Route::get('bayar2client', [BayarController::class, 'bayar2client'])->name('bayar2client');
    Route::get('detailsetujui/{id}', [ProjectDisetujuiController::class, 'detailDisetujuiClient'])->name('detailsetujui');
    Route::post('detailsetujui', [ProjectDisetujuiController::class, 'projectChatClient'])->name('project-chat-client');
    Route::get('revisiselesai', [SelesaiController::class, 'revisiselesai'])->name('revisiselesai');
    Route::get('revisibutton', [SelesaiController::class, 'revisibutton'])->name('revisibutton');
    Route::get('detail-revisi-client/{id}', [SelesaiController::class, 'detail'])->name('detail-revisi-client');
    Route::delete('/destroy/{id}', [TolakController::class, 'destroy'])->name('destroy');
    Route::delete('destroyfitur/{id}', [IndexcController::class, 'destroyfitur'])->name('destroyfitur');
});

Route::middleware('admin')->group(function(){
    // Halaman Admin
    Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::put('/admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
    Route::get('detailproreq/{id}', [ProjectrequestController::class, 'detailproreq'])->name('detailproreq');
    Route::put('simpanharga/{id}', [ProjectrequestController::class, 'simpanharga'])->name('simpanharga');
    Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
    Route::get('projectselesai', [ProjectrequestController::class, 'projectselesai'])->name('projectselesai');
    Route::resource('projectselesai' , App\Http\Controllers\ProjectselesaiController::class);
    Route::get('pengaturan', [PengaturanController::class, 'pengaturan'])->name('pengaturan');
    Route::post('updatesosmed', [PengaturanController::class, 'updatesosmed'])->name('updatesosmed');
    Route::post('updatekebijakan', [PengaturanController::class, 'updatekebijakan'])->name('updatekebijakan');
    Route::get('revisiproselesai', [ProjectrequestController::class, 'revisiproselesai'])->name('revisiproselesai');
    Route::get('editproselesai', [ProjectrequestController::class, 'editproselesai'])->name('editproselesai');
    Route::get('project-disetujui', [ProjectDisetujuiController::class, 'disetujui'])->name('project-disetujui-admin');
    Route::get('detail-project-disetujui/{id}', [ProjectDisetujuiController::class, 'detailDisetujui'])->name('detail-disetujui-admin');
    Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');
    Route::get('pembayaran-pending', [AdminBayarController::class, 'pending'])->name('pending-bayar-admin');
    Route::put('pembayaran-pending', [AdminBayarController::class, 'setujuiPembayaran'])->name('setujui-pembayaran');
    Route::get('pembayaran-disetujui', [AdminBayarController::class, 'disetujui'])->name('setuju-bayar-admin');
    Route::post('detail-project-disetujui', [ProjectDisetujuiController::class, 'projectChat'])->name('project-chat');
    Route::post('pembayaran-digital/update-bank', [AdminBayarController::class, 'updateBank'])->name('update-bank');
    Route::post('pembayaran-digital', [AdminBayarController::class, 'updateEWallet'])->name('update-ewallet');

});