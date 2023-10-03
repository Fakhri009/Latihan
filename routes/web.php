<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KapsterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PelayananController;


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

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::put('/update-profile', [UserController::class, 'update'])->name('update.profile');
    Route::get('/edit-password', [UserController::class, 'editPassword'])->name('ubah-password');
    Route::patch('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
});

Route::group(['middleware' => ['auth', 'checkRole:customer']], function () {
    Route::get('/customer/dashboard', [HomeController::class, 'customer'])->name('customer.dashboard');

});
Route::group(['middleware' => ['auth', 'checkRole:kapster']], function () {
    Route::get('/kapster/dashboard', [HomeController::class, 'kapster'])->name('kapster.dashboard');

});
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::resource('produk', ProdukController::class);
    Route::resource('pelayanan', PelayananController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('laporan', LaporanController::class);
    Route::resource('kapster', KapsterController::class);
    Route::resource('user', UserController::class);
    Route::resource('barang', BarangController::class);
});



//Route::get('/upload', 'UploadController@upload');
//Route::post('/upload/proses', 'UploadController@proses_upload');