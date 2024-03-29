<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\TolakController;
use App\Http\Controllers\IndexcController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminBayarController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProjectrequestController;
use App\Http\Controllers\ProjectDisetujuiController;

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
Route::get('/', [WelcomeController::class, 'index'])->name('welcome')->middleware('redirect.auth');
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('redirect.auth');
Route::post('postlogin', [AuthController::class, 'login'])->name('postlogin');
Route::get('register', [AuthController::class, 'register'])->name('register')->middleware('redirect.auth');
Route::post('postsignup', [AuthController::class, 'signupsave'])->name('postsignup');
Route::get('email-verification', [AuthController::class, 'verifEmail'])->name('email-verification');
Route::get('wrong-account', [AuthController::class, 'wrongAccount'])->name('wrong-account');
Route::get('resend-code', [AuthController::class, 'resendCode'])->name('resend-code');
Route::post('email-verification/verif', [AuthController::class, 'verifEmailStore'])->name('email-verification.post');
Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot')->middleware('redirect.auth');
Route::get('kebijakan', [PengaturanController::class, 'kebijakan'])->name('kebijakan');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['resetpassword'])->group(function () {
    Route::get('forgot-password', [AuthController::class, 'forgotPasswordRequest'])->name('password.request')->middleware('redirect.auth');
    Route::post('forgot-password', [AuthController::class, 'forgotPasswordEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordToken'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPasswordUpdate'])->name('password.update');
});

Route::middleware(['web', 'auth'])->group(function() {
    //Halaman Client
    Route::get('indexclient', [IndexcController::class, 'indexclient'])->name('indexclient');
    Route::get('notifclient/{id}', [IndexcController::class, 'notifRedirectClient'])->name('notifclient');
    Route::delete('client/delete-notif', [IndexcController::class, 'readAllNotifClient'])->name('read-all-notif-client');
    Route::put('client/update-profile', [IndexcController::class, 'updateProfile'])->name('client.updateProfile');
    Route::get('drequestclient', [IndexcController::class, 'drequestclient'])->name('drequestclient');
    Route::get('createproreq', [IndexcController::class, 'createproreq'])->name('createproreq');
    Route::get('showproj', [IndexcController::class, 'showproj'])->name('showproj');
    Route::post('simpanpro', [IndexcController::class, 'simpann'])->name('simpanpro');
    Route::post('simpanfitur/{id}', [IndexcController::class, 'simpannn'])->name('simpanfitur');
    Route::get('fitur/{id}/edit', [IndexcController::class, 'showFormModal'])->name('fituredit');
    Route::put('updatefitur/{id}', [IndexcController::class, 'updateFitur'])->name('updatefitur');
    Route::get('ambildata/{id}', [IndexcController::class, 'ambildata'])->name('ambildata');
    Route::get('editproreq/{id}', [IndexcController::class, 'editproreq'])->name('editproreq');
    Route::put('updateproreq', [IndexcController::class, 'update'])->name('updateproreq');
    Route::post('simpandesk', [IndexcController::class, 'simpand'])->name('simpandesk');
    Route::get('setujuclient', [ProjectDisetujuiController::class, 'disetujuiClient'])->name('setujuclient');
    Route::put('refund-request-client/{id}', [ProjectDisetujuiController::class, 'refundRequestClient'])->name('refund-request-client');
    Route::put('cancel-revision', [ProjectDisetujuiController::class, 'cancelRevisionClient'])->name('cancel-revision');
    Route::get('selesaiclient', [SelesaiController::class, 'selesaiclient'])->name('selesaiclient');
    Route::get('revisiclient', [SelesaiController::class, 'revisiclient'])->name('revisiclient');
    Route::get('ditolakclient', [TolakController::class, 'ditolakclient'])->name('ditolakclient');
    Route::get('bayarclient', [BayarController::class, 'bayarclient'])->name('bayarclient');
    Route::get('bayar2client', [BayarController::class, 'bayar2client'])->name('bayar2client');
    Route::post('ambilrek', [BayarController::class, 'ambilrek'])->name('ambilrek');
    Route::put('update-status-bayar/{id}', [BayarController::class, 'updatebayar'])->name('update-status-bayar');
    Route::put('update-status-bayarakhir/{id}', [BayarController::class, 'updatebayarakhir'])->name('update-status-bayarakhir');
    Route::put('update-status-bayarrevisi/{id}', [BayarController::class, 'updatebayarrevisi'])->name('update-status-bayarrevisi');
    Route::get('detailsetujui/{id}', [ProjectDisetujuiController::class, 'detailDisetujuiClient'])->name('detailsetujui');
    Route::post('update-progresss', [ProjectrequestController::class, 'updateProgressrange'])->name('update-progress');
    Route::get('downloadsuppdocsclient/{dokumen?}', [ProjectrequestController::class, 'downloadSuppDocs'])->name('download-suppdocs-client');
    Route::get('get-progress', [ProjectDisetujuiController::class, 'getProgress'])->name('get-progress');
    Route::post('detailsetujui', [ProjectDisetujuiController::class, 'projectChatClient'])->name('project-chat-client');
    Route::get('revisiselesai', [SelesaiController::class, 'revisiselesai'])->name('revisiselesai');
    Route::get('revisibutton/{id}', [SelesaiController::class, 'revisibutton'])->name('revisibutton');
    Route::get('detail-revisi-client/{id}', [SelesaiController::class, 'detail'])->name('detail-revisi-client');
    Route::post('accept-revision', [SelesaiController::class, 'acceptRevision'])->name('accept-revision');
    Route::post('reject-revision', [SelesaiController::class, 'rejectRevision'])->name('reject-revision');
    Route::post('ajukan-revisi-client', [SelesaiController::class, 'ajukanRevisi'])->name('ajukan-revisi-client');
    Route::put('update-status/{id}', [SelesaiController::class, 'updatestatus'])->name('update-status');
    Route::put('update-statuss/{id}', [SelesaiController::class, 'updatestatuss'])->name('update-statuss');
    Route::delete('destroy/{id}', [TolakController::class, 'destroy'])->name('destroy');
    Route::delete('destroy1/{id}', [TolakController::class, 'destroy1'])->name('destroy1');
    Route::delete('destroyfitur/{id}', [IndexcController::class, 'destroyfitur'])->name('destroyfitur');
    Route::delete('destroyrequest', [IndexcController::class, 'destroyRequest'])->name('destroy-pending-request');
    Route::delete('deleteproj/{id}', [BayarController::class, 'deleteproj'])->name('deleteproj');
    Route::delete('delete-all', [BayarController::class, 'deleteAll'])->name('delete-all');
});

Route::middleware(['admin'])->group(function(){
    // Halaman Admin
    Route::get('notif-redirect/{id}', [AdminController::class, 'notifRedirect'])->name('notif-redirect');
    Route::delete('admin/delete-notif', [AdminController::class, 'readAllNotif'])->name('read-all-notif');
    Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::get('client-list', [AdminController::class, 'clientList'])->name('client-list');
    Route::put('client-list/banned', [AdminController::class, 'bannedClient'])->name('banned-client');
    Route::put('client-list/unbanned', [AdminController::class, 'unbannedClient'])->name('unbanned-client');
    Route::get('team-management', [TeamController::class, 'teamManagement'])->name('team-management');
    Route::put('admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
    Route::get('detailproreq/{id}', [ProjectrequestController::class, 'detailproreq'])->name('detailproreq');
    Route::get('downloadsuppdocs/{dokumen?}', [ProjectrequestController::class, 'downloadSuppDocs'])->name('download-suppdocs');
    Route::put('simpanharga/{id}', [ProjectrequestController::class, 'simpanharga'])->name('simpanharga');
    Route::put('simpanfiturr/{id}', [ProjectrequestController::class, 'simpanfiturr'])->name('simpanfiturr');
    Route::put('alasantolak', [ProjectrequestController::class, 'alasantolak'])->name('alasantolak');
    Route::put('update-proreq/{id}', [ProjectrequestController::class, 'updateproreqa'])->name('update-proreq');
    Route::get('search', [ProjectrequestController::class, 'search'])->name('search');
    Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
    Route::get('projectselesai', [ProjectrequestController::class, 'projectselesai'])->name('projectselesai');
    Route::put('projectselesai/send-config', [ProjectrequestController::class, 'webConfig'])->name('send-config');
    Route::get('pengaturan', [PengaturanController::class, 'pengaturan'])->name('pengaturan');
    Route::post('updatesosmed', [PengaturanController::class, 'updatesosmed'])->name('updatesosmed');
    Route::post('updatekebijakan', [PengaturanController::class, 'updatekebijakan'])->name('updatekebijakan');
    Route::post('updateaboutus', [PengaturanController::class, 'updateAboutUs'])->name('update-aboutus');
    Route::post('add-faq', [PengaturanController::class, 'addFAQ'])->name('add-faq');
    Route::post('edit-faq', [PengaturanController::class, 'editFAQ'])->name('edit-faq');
    Route::delete('faq/delete/{faq_id}', [PengaturanController::class, 'deleteFAQ'])->name('delete-faq');
    Route::get('revisiproselesai/{id}', [ProjectrequestController::class, 'revisiproselesai'])->name('revisiproselesai');
    Route::get('editproselesai/{id}', [ProjectrequestController::class, 'editproselesai'])->name('editproselesai');
    Route::post('updateproreq-admin/{id}', [ProjectrequestController::class, 'updateProreq'])->name('updateproreq-admin');
    Route::post('savefitur/{id}', [ProjectrequestController::class, 'savefitur'])->name('savefitur');
    Route::put('update-fitur/{id}', [ProjectrequestController::class, 'updatefitur'])->name('update-fitur');
    Route::delete('destroy-fitur', [ProjectrequestController::class, 'destroyfitur'])->name('destroy-fitur');
    Route::get('project-disetujui', [ProjectDisetujuiController::class, 'disetujui'])->name('project-disetujui-admin');
    // Route::delete('project-disetujui', [ProjectDisetujuiController::class, 'deleteLateProject'])->name('delete-late-project');
    Route::get('detail-project-disetujui/{id}', [ProjectDisetujuiController::class, 'detailDisetujui'])->name('detail-disetujui-admin');
    Route::post('update-project-selesai', [ProjectDisetujuiController::class, 'doneProject'])->name('done-project');
    Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');
    Route::put('pay-refund', [AdminBayarController::class, 'payRefund'])->name('pay-refund');
    Route::get('refund-admin', [AdminBayarController::class, 'pengajuanRefund'])->name('refund-admin');
    Route::get('pembayaran-pending', [AdminBayarController::class, 'pending'])->name('pending-bayar-admin');
    Route::post('setujui-pembayaran/{id}', [AdminBayarController::class, 'setujuiPembayaran'])->name('setujui-pembayaran');
    Route::post('tolak-pembayaran/{id}', [AdminBayarController::class, 'tolakPembayaran'])->name('tolak-pembayaran');
    Route::get('pembayaran-disetujui', [AdminBayarController::class, 'disetujui'])->name('setuju-bayar-admin');
    Route::post('detail-project-disetujui', [ProjectDisetujuiController::class, 'projectChat'])->name('project-chat');
    Route::put('update-status-fitur/{id}', [ProjectDisetujuiController::class, 'updateStatusFitur'])->name('update-status-fitur');
    Route::put('estimasi-project', [ProjectDisetujuiController::class, 'upEstimasi'])->name('estimasi-project');
    Route::post('pembayaran-digital/update-bank', [AdminBayarController::class, 'updateBank'])->name('update-bank');
    Route::post('pembayaran-digital', [AdminBayarController::class, 'updateEWallet'])->name('update-ewallet');
    Route::post('statusfitur', [ProjectDisetujuiController::class, 'statusFitur'])->name('status-fitur');
    Route::post('allstatusfitur', [ProjectDisetujuiController::class, 'allStatusFitur'])->name('all-status-fitur');
    Route::post('save-progress', [ProjectDisetujuiController::class, 'saveProgress'])->name('save.progress');
    Route::delete('delete-history-project', [AdminBayarController::class, 'deleteProjectHistory'])->name('delete-history-project');
});
