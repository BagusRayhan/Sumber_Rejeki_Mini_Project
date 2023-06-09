<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectrequestController;

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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::get('forgot', [AuthController::class, 'forgot'])->name('forgot');

Route::get('projectreq', [ProjectrequestController::class, 'projectreq'])->name('projectreq');

Route::get('indexclient', [IndexcController::class, 'indexclient'])->name('indexclient');
Route::get('clientproreq', [ClientproreqController::class, 'clientproreq'])->name('clientproreq');

Route::get('admin', function () {
    return view('Admin.index');
});