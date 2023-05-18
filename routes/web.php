<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

// Route::get('/', function () {
//     return view('maps');
// });

Route::get('google-map', [GoogleController::class, 'index']);


//login
Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
// Route::get('register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

//daftar akun
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_action'])->name('register.action');
Route::get('/email/verify/{id}/{hash}',[VerificationController::class,'verify'])->middleware('auth','signed')->name('verification.verify');
Route::get('/email/verify/{id}/{hash}',[VerificationController::class,'rekam'])->middleware('auth','signed')->name('verification.verify');
Route::get('/email/verify/{id}/{hash}',[VerificationController::class,'apotek'])->middleware('auth','signed')->name('verification.verify');
Route::get('/email/verify/resend-verification',[VerificationController::class,'send'])->middleware('auth','throttle:6,1')->name('verification.send');
Route::get('verifikasi', [AuthController::class, 'verifikasi'])->name('verifikasi');

//login berdasarkn level
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', 'App\Http\Controllers\AdminController');
        Route::get('/email/verify/need-verification',[AdminController::class,'index'])->middleware('auth')->name('verification.notice');
        //menu sidebar
        Route::get('dashboard/dashboard', [AdminController::class,'dashboard'])->name('dashboard/dashboard');

    });
    Route::group(['middleware' => ['cek_login:rekam_medis']], function () {
        Route::resource('rekam_medis', 'App\Http\Controllers\RekammedisController');
        Route::get('/email/verify/need-verification',[RekammedisController::class,'index'])->middleware('auth')->name('verification.notice');
        //menu sidebar
        Route::get('dashboard/dashboard', [RekammedisController::class,'dashboard'])->name('rekam_medis/dashboard/dashboard');
    });
    Route::group(['middleware' => ['cek_login:apotek']], function () {
        Route::resource('apotek', 'App\Http\Controllers\ApotekController');
        Route::get('/email/verify/need-verification',[ApotekController::class,'index'])->middleware('auth')->name('verification.notice');
        //menu sidebar
        Route::get('dashboard/dashboard', [ApotekController::class,'dashboard'])->name('apotek/dashboard/dashboard');
    });
    Route::group(['middleware' => ['cek_login:kapus']], function () {
        Route::resource('kapus', 'App\Http\Controllers\ApotekController');
        Route::get('/email/verify/need-verification',[KapusController::class,'index'])->middleware('auth')->name('verification.notice');
        //menu sidebar
        Route::get('dashboard/dashboard', [KapusController::class,'dashboard'])->name('kapus/dashboard/dashboard');
    });
});

//pegawai
Route::get('pegawai/pegawai', [PegawaiController::class,'index'])->name('pegawai/pegawai');
Route::get('pegawai/tambah_pegawai', [PegawaiController::class, 'create'])->name('pegawai/tambah_pegawai');
Route::post('pegawai/tambah_pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('pegawai/edit_pegawai/{id}',[PegawaiController::class,'editpegawai'])->name('pegawai/edit_pegawai');
Route::post('updatepegawai/{id}',[PegawaiController::class,'updatepegawai'])->name('updatepegawai');
Route::get('pegawai/hapus_pegawai/{id}', [PegawaiController::class,'destroy'])->name('hapus_pegawai');

//petugas
Route::get('petugas/petugas', [JadwalController::class,'index'])->name('petugas/petugas');//jadwal petugas
Route::get('petugas/dokter', [PetugasController::class,'data_dokter'])->name('petugas/dokter');//data dokter
Route::get('petugas/perawat', [PetugasController::class,'data_perawat'])->name('petugas/perawat');//data dokter
Route::get('petugas/tambah_dokter', [PetugasController::class, 'dokter'])->name('petugas/tambah_dokter');
Route::get('petugas/tambah_perawat', [PetugasController::class, 'perawat'])->name('petugas/tambah_perawat');
Route::post('petugas/tambah_petugas', [PetugasController::class, 'store'])->name('petugas.store');
Route::get('petugas/edit_dokter/{id}',[PetugasController::class,'editdokter'])->name('petugas/edit_dokter');
Route::get('petugas/edit_perawat/{id}',[PetugasController::class,'editperawat'])->name('petugas/edit_perawat');
Route::post('updatepetugas/{id}',[PetugasController::class,'updatepetugas'])->name('updatepetugas');
Route::get('petugas/hapus_petugas/{id}', [PetugasController::class,'destroy'])->name('hapus_petugas');





// Route::get('dashboard/dashboard', function(){
//     return view('dashboard/dashboard');
// })->name('dashboard/dashboard');