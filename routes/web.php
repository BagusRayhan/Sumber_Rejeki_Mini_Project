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
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

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
    
// Halaman Admin
Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
Route::get('detailproreq/{id}', [ProjectrequestController::class, 'detailproreq'])->name('detailproreq');
Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');
Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
Route::get('projectselesai', [ProjectrequestController::class, 'projectselesai'])->name('projectselesai');
Route::get('pengaturan', [PengaturanController::class, 'pengaturan'])->name('pengaturan');
Route::post('updatesosmed', [PengaturanController::class, 'updatesosmed'])->name('updatesosmed');
Route::get('revisiproselesai', [ProjectrequestController::class, 'revisiproselesai'])->name('revisiproselesai');
Route::get('editproselesai', [ProjectrequestController::class, 'editproselesai'])->name('editproselesai');
Route::get('project-disetujui', [ProjectDisetujuiController::class, 'disetujui'])->name('project-disetujui-admin');
Route::get('detail-project-disetujui/{id}', [ProjectDisetujuiController::class, 'detailDisetujui'])->name('detail-disetujui-admin');
Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');
Route::get('pembayaran-pending', [AdminBayarController::class, 'pending'])->name('pending-bayar-admin');
Route::get('pembayaran-disetujui', [AdminBayarController::class, 'disetujui'])->name('setuju-bayar-admin');


//harja
Route::get('pembayaran-digital/getrekening/{id}', [AdminBayarController::class, 'getRekening'])->name('getRekening');