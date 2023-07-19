<?php

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

Route::middleware(['resetpassword'])->group(function () {
    Route::get('/forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
        })->name('password.update');
});

Route::middleware(['web', 'auth'])->group(function(){

    //Halaman Client
    Route::get('indexclient', [IndexcController::class, 'indexclient'])->name('indexclient');
    Route::get('notifclient/{id}', [IndexcController::class, 'notifRedirectClient'])->name('notifclient');
    Route::delete('client/delete-notif', [IndexcController::class, 'readAllNotifClient'])->name('read-all-notif-client');
    Route::put('/client/update-profile', [IndexcController::class, 'updateProfile'])->name('client.updateProfile');
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
    Route::get('downloadsuppdocsclient/{dokumen?}', [ProjectrequestController::class, 'downloadSuppDocs'])->name('download-suppdocs-client');
    Route::post('detailsetujui', [ProjectDisetujuiController::class, 'projectChatClient'])->name('project-chat-client');
    Route::get('revisiselesai', [SelesaiController::class, 'revisiselesai'])->name('revisiselesai');
    Route::get('revisibutton/{id}', [SelesaiController::class, 'revisibutton'])->name('revisibutton');
    Route::get('detail-revisi-client/{id}', [SelesaiController::class, 'detail'])->name('detail-revisi-client');
    Route::post('accept-revision', [SelesaiController::class, 'acceptRevision'])->name('accept-revision');
    Route::post('reject-revision', [SelesaiController::class, 'rejectRevision'])->name('reject-revision');
    Route::post('ajukan-revisi-client', [SelesaiController::class, 'ajukanRevisi'])->name('ajukan-revisi-client');
    Route::put('update-status/{id}', [SelesaiController::class, 'updatestatus'])->name('update-status');
    Route::put('update-statuss/{id}', [SelesaiController::class, 'updatestatuss'])->name('update-statuss');
    Route::delete('/destroy/{id}', [TolakController::class, 'destroy'])->name('destroy');
    Route::delete('destroyfitur/{id}', [IndexcController::class, 'destroyfitur'])->name('destroyfitur');
    Route::delete('destroyrequest', [IndexcController::class, 'destroyRequest'])->name('destroy-pending-request');
    Route::delete('deleteproj/{id}', [BayarController::class, 'deleteproj'])->name('deleteproj');
    Route::delete('/delete-all', [BayarController::class, 'deleteAll'])->name('delete-all');

});

Route::middleware('admin')->group(function(){
    // Halaman Admin
    Route::get('notif-redirect/{id}', [AdminController::class, 'notifRedirect'])->name('notif-redirect');
    Route::delete('admin/delete-notif', [AdminController::class, 'readAllNotif'])->name('read-all-notif');
    Route::get('admin', [AdminController::class, 'index'])->name('admin-dashboard');
    Route::put('/admin/update-profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
    Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
    Route::get('detailproreq/{id}', [ProjectrequestController::class, 'detailproreq'])->name('detailproreq');
    Route::get('downloadsuppdocs/{dokumen?}', [ProjectrequestController::class, 'downloadSuppDocs'])->name('download-suppdocs');
    Route::put('simpanharga/{id}', [ProjectrequestController::class, 'simpanharga'])->name('simpanharga');
    Route::put('simpanfiturr/{id}', [ProjectrequestController::class, 'simpanfiturr'])->name('simpanfiturr');
    Route::put('alasantolak', [ProjectrequestController::class, 'alasantolak'])->name('alasantolak');
    Route::put('/update-proreq/{id}', [ProjectrequestController::class, 'updateproreqa'])->name('update-proreq');
    Route::get('search', [ProjectrequestController::class, 'search'])->name('search');
    Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');
    Route::get('projectselesai', [ProjectrequestController::class, 'projectselesai'])->name('projectselesai');
    Route::get('pengaturan', [PengaturanController::class, 'pengaturan'])->name('pengaturan');
    Route::post('updatesosmed', [PengaturanController::class, 'updatesosmed'])->name('updatesosmed');
    Route::post('updatekebijakan', [PengaturanController::class, 'updatekebijakan'])->name('updatekebijakan');
    Route::get('revisiproselesai/{id}', [ProjectrequestController::class, 'revisiproselesai'])->name('revisiproselesai');
    Route::get('editproselesai/{id}', [ProjectrequestController::class, 'editproselesai'])->name('editproselesai');
    Route::post('updateproreq-admin/{id}', [ProjectrequestController::class, 'updateProreq'])->name('updateproreq-admin');
    Route::post('savefitur/{id}', [ProjectrequestController::class, 'savefitur'])->name('savefitur');
    Route::put('update-fitur/{id}', [ProjectrequestController::class, 'updatefitur'])->name('update-fitur');
    Route::delete('destroy-fitur', [ProjectrequestController::class, 'destroyfitur'])->name('destroy-fitur');
    Route::get('project-disetujui', [ProjectDisetujuiController::class, 'disetujui'])->name('project-disetujui-admin');
    Route::get('detail-project-disetujui/{id}', [ProjectDisetujuiController::class, 'detailDisetujui'])->name('detail-disetujui-admin');
    Route::post('update-project-selesai', [ProjectDisetujuiController::class, 'doneProject'])->name('done-project');
    Route::get('pembayaran-digital', [AdminBayarController::class, 'pembayaranDigital'])->name('bayar-digital-admin');
    Route::get('pembayaran-pending', [AdminBayarController::class, 'pending'])->name('pending-bayar-admin');
    Route::post('/setujui-pembayaran/{id}', [AdminBayarController::class, 'setujuiPembayaran'])->name('setujui-pembayaran');
    Route::post('/tolak-pembayaran/{id}', [AdminBayarController::class, 'tolakPembayaran'])->name('tolak-pembayaran');
    Route::get('pembayaran-disetujui', [AdminBayarController::class, 'disetujui'])->name('setuju-bayar-admin');
    Route::post('detail-project-disetujui', [ProjectDisetujuiController::class, 'projectChat'])->name('project-chat');
    Route::put('/update-status-fitur/{id}', [ProjectDisetujuiController::class, 'updateStatusFitur'])->name('update-status-fitur');
    Route::put('estimasi-project', [ProjectDisetujuiController::class, 'upEstimasi'])->name('estimasi-project');
    Route::post('pembayaran-digital/update-bank', [AdminBayarController::class, 'updateBank'])->name('update-bank');
    Route::post('pembayaran-digital', [AdminBayarController::class, 'updateEWallet'])->name('update-ewallet');
    Route::post('statusfitur', [ProjectDisetujuiController::class, 'statusFitur'])->name('status-fitur');
    Route::post('allstatusfitur', [ProjectDisetujuiController::class, 'allStatusFitur'])->name('all-status-fitur');
});
