<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectrequestController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\IndexcController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\SetujuController;
use App\Http\Controllers\TolakController;


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
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');

// Halaman Client
Route::get('indexclient', [IndexcController::class, 'indexclient'])->name('indexclient');
Route::get('drequestclient', [IndexcController::class, 'drequestclient'])->name('drequestclient');
Route::get('createproreq', [IndexcController::class, 'createproreq'])->name('createproreq');
Route::get('requestclient', [IndexcController::class, 'requestclient'])->name('requestclient');
Route::get('setujuclient', [SetujuController::class, 'setujuclient'])->name('setujuclient');
Route::get('selesaiclient', [SelesaiController::class, 'selesaiclient'])->name('selesaiclient');
Route::get('ditolakclient', [TolakController::class, 'ditolakclient'])->name('ditolakclient');
Route::get('bayarclient', [BayarController::class, 'bayarclient'])->name('bayarclient');

// Halaman Admin
Route::get('indexa', [IndexaController::class, 'indexa'])->name('indexa');
Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');