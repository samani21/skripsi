<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerobatController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KapusController;
use App\Http\Controllers\KartuController;
use App\Http\Controllers\KpusController;
use App\Http\Controllers\MedisController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ObatkeluarController;
use App\Http\Controllers\ObatmasukController;
use App\Http\Controllers\OperatroController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SuratController;
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
    return view('/home');
});

Route::get('/berita', function () {
    return view('/berita');
});


Route::get('login', function () {
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
Route::get('lupa', [AuthController::class, 'reset'])->name('lupa');
Route::post('resetpassword/{id}', [AuthController::class, 'resetpassword'])->name('reset.action');


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
        Route::resource('kapus', 'App\Http\Controllers\KapusController');
        Route::get('/email/verify/need-verification',[KapusController::class,'index'])->middleware('auth')->name('verification.notice');
        //menu sidebar
        Route::get('dashboard/dashboard', [KapusController::class,'dashboard'])->name('kapus/dashboard/dashboard');
    });
    Route::group(['middleware' => ['cek_login:operator']], function () {
        Route::resource('operator', 'App\Http\Controllers\OperatroController');
        Route::get('/email/verify/need-verification',[OperatroController::class,'index'])->middleware('auth')->name('verification.notice');
        //menu sidebar
        Route::get('dashboard/dashboard', [OperatroController::class,'dashboard'])->name('operator/dashboard/dashboard');
    });
});

//pegawai
Route::get('pegawai/pegawai', [PegawaiController::class,'index'])->name('pegawai/pegawai');//data pegawai
Route::get('pegawai/tambah_pegawai', [PegawaiController::class, 'create'])->name('pegawai/tambah_pegawai');//tambah data pegawai
Route::post('pegawai/tambah_pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');//proses tambah data pegawai
Route::get('pegawai/edit_pegawai/{id}',[PegawaiController::class,'editpegawai'])->name('pegawai/edit_pegawai');//edit data pegawai
Route::post('updatepegawai/{id}',[PegawaiController::class,'updatepegawai'])->name('updatepegawai');//update data pergawai
Route::get('pegawai/hapus_pegawai/{id}', [PegawaiController::class,'destroy'])->name('hapus_pegawai');//hapus data pegawai

//pengguna
Route::get('pengguna/pengguna', [PenggunaController::class,'index'])->name('pengguna/pengguna');//data pengguna
Route::get('pengguna/edit_pengguna/{id}',[PenggunaController::class,'editpengguna'])->name('pengguna/edit_pengguna');//edit data pengguna
Route::post('updatepengguna/{id}',[PenggunaController::class,'updatepengguna'])->name('updatepengguna');//update data pengguna
Route::get('pengguna/hapus_pengguna/{id}', [PenggunaController::class,'destroy'])->name('hapus_pegawai');//hapus data pengguna

//petugas
Route::get('petugas/petugas', [JadwalController::class,'index'])->name('petugas/petugas');//jadwal petugas

Route::get('petugas/tambah_jaga/{id}', [JadwalController::class, 'create'])->name('petugas/tambah_jaga'); //tambah jaga
Route::post('petugas/tambah_jaga', [JadwalController::class, 'store'])->name('jaga.store'); //jadwal jaga
Route::get('petugas/selesai/{id_jadwal}',[JadwalController::class,'selesai'])->name('petugas/selesai');//selesai jaga
Route::post('updatejadwal/{id}',[JadwalController::class,'updatejadwal'])->name('updatejadwal');//perbarui jadwal

Route::get('petugas/dokter', [PetugasController::class,'data_dokter'])->name('petugas/dokter');//data dokter
Route::get('petugas/tambah_dokter', [PetugasController::class, 'dokter'])->name('petugas/tambah_dokter');//tambah dokter
Route::get('petugas/edit_dokter/{id}',[PetugasController::class,'editdokter'])->name('petugas/edit_dokter');//edit dokter

Route::get('petugas/perawat', [PetugasController::class,'data_perawat'])->name('petugas/perawat');//data perawat
Route::get('petugas/tambah_perawat', [PetugasController::class, 'perawat'])->name('petugas/tambah_perawat');//tambah perawat
Route::get('petugas/edit_perawat/{id}',[PetugasController::class,'editperawat'])->name('petugas/edit_perawat');//edit perawat

Route::post('updatepetugas/{id}',[PetugasController::class,'updatepetugas'])->name('updatepetugas');//update dokter dan perawat
Route::get('petugas/hapus_petugas/{id}', [PetugasController::class,'destroy'])->name('hapus_petugas');//hapus dokter dan perawat
Route::post('petugas/tambah_petugas', [PetugasController::class, 'store'])->name('petugas.store');// tambah dokter dan perawat

Route::get('pegawai/selesai_pegawai/{id}', [PegawaiController::class,'selesai'])->name('selesai');//hapus data kapus
Route::post('selesai_pegawai/{id}',[PegawaiController::class,'updateselesai'])->name('selesai_pegawai');//update data kapus

//pasien
Route::get('pasien/pasien', [PasienController::class, 'index'])->name('pasien/pasien');//data pasien
Route::get('pasien/tambah_pasien', [PasienController::class, 'create'])->name('pasien/tambah_pasien');//tambah pasien
Route::post('pasien/tambah_pasien', [PasienController::class, 'store'])->name('pasien.store');//proses tambah pasien
Route::get('pasien/edit_pasien/{id}',[PasienController::class,'editpasien'])->name('pasien/edit_pasien');//edit pasien
Route::post('updatepasien/{id}',[PasienController::class,'updatepasien'])->name('updatepasien');//update pasien
Route::get('pasien/hapus_pasien/{id}', [PasienController::class,'destroy'])->name('hapus_pasien');//hapus pasien

Route::get('pasien/detail/id={id}&pasien_id={pasien_id}',[PasienController::class,'detail'])->name('pasien/detail');//data lengkap pasien

Route::get('pasien/daftar/{id}', [BerobatController::class, 'create'])->name('pasien/daftar');//daftar pasien berobat
Route::post('pasien/daftar/{id}', [BerobatController::class, 'store'])->name('tambah.store');//proses pasien berobat
Route::get('pasien/detail/rekam_medis/berobat={id}&rekammedis={pasien_id}',[MedisController::class,'rekam'])->name('medis/rekam_medis');//data rekam medis pasien


//rekam medis
Route::get('medis/medis', [BerobatController::class, 'index'])->name('medis/medis');//data pasien berobat
Route::get('medis/rekam_medis/berobat={id}&rekammedis={pasien_id}',[MedisController::class,'rekam'])->name('medis/rekam_medis');//data rekam medis pasien
Route::post('selesai/{id}',[MedisController::class,'selesai'])->name('selesai_rm');//selesai pemeriksaan
Route::get('medis/rekam_medis/hapus_resep/{id}', [MedisController::class,'hapus_resep'])->name('hapus_resep');//hapus resep
Route::post('selesai_resep/berobat={id}&pasien={id_pasien}',[MedisController::class,'selesai_resep'])->name('selesai_resep');//selesai pemeriksaan

Route::get('medis/periksa_fisik/{id}',[MedisController::class,'periksa'])->name('medis/periksa_fisik');//pemeriksaan fisik
Route::post('medis/periksa_fisik/{id}',[MedisController::class,'store'])->name('fisik.store');//proses pemeriksaan fisik

Route::get('medis/edit_fisik/medis={id}&pasien={berobat_id}',[MedisController::class,'edit_fisik'])->name('medis/edit_fisik');//edit pemeriksaan fisik
Route::post('updatefisik/medis={id}',[MedisController::class,'update'])->name('updatefisik');// update pemeriksaan fisik

Route::get('medis/periksa_diagnosa/berobat={id}&pasien{pasien}',[MedisController::class,'diagnosa'])->name('medis/diagnosa');//tambah diagnosa
Route::post('medis/periksa_diagnosa/{id}',[MedisController::class,'diagnosa_store'])->name('diagnosa.store');//proses tambah diagnosa
Route::get('medis/rekam_medis/hapus_diagnosa/{id}', [MedisController::class,'hapus_diagnosa'])->name('hapus_diagnosa');//hapus diagnosa

Route::get('medis/periksa_obat/berobat={id}&pasien{pasien}',[MedisController::class,'obat'])->name('medis/periksa_obat');//resep
Route::post('medis/periksa_obat/{id}',[MedisController::class,'obat_store'])->name('resep.store');//tambah resep
Route::post('medis/hapus_resep/{id}',[MedisController::class,'hapus_resep'])->name('hapus_resep');//hapus 

Route::get('medis/surat_sakit/pasien={id}&rekammedis={medis}&berobat={berobat}', [SuratController::class, 'surat_sakit'])->name('medis/sakit');//buat surat sakit
Route::post('medis/surat_sakit/berobat={berobat}', [SuratController::class, 'sakit'])->name('surat.sakit');//proses surat sakit 

Route::get('medis/surat_sehat/pasien={id}&rekammedis={medis}&berobat={berobat}', [SuratController::class, 'surat_sehat'])->name('medis/sehat');//buat surat sehat
Route::post('medis/surat_sehat/berobat={berobat}', [SuratController::class, 'sakit'])->name('surat.sehat');//proses surat sehat 

//obat
Route::get('obat/obat', [ObatController::class, 'index'])->name('obat/obat');//data obat
Route::get('obat/tambah_obat', [ObatController::class, 'create'])->name('obat/tambah_obat');//tambah data obat
Route::post('obat/tambah_obat', [ObatController::class, 'store'])->name('obat.store');//proses tambah obat
Route::get('obat/edit_obat/{id}',[ObatController::class,'editobat'])->name('obat/edit_obat');//edit obat
Route::post('updateobat/{id}',[ObatController::class,'updateobat'])->name('updateobat');//update obat
Route::get('obat/hapus_obat/{id}', [ObatController::class,'destroy'])->name('hapus_obat');//hapus obat

//obat masuk
Route::get('obat/masuk', [ObatController::class, 'obat_masuk'])->name('obat/obat_masuk');//data obat masuk
Route::get('obat/tambah_stok', [ObatmasukController::class, 'create'])->name('obat/tambah_stok');//tambah stok obat masuk
Route::post('obat/tambah_stok', [ObatmasukController::class, 'stok_store'])->name('stok.store');//proses tambah stok obat masuk
Route::get('obat/edit_stok/{id}',[ObatmasukController::class,'editstok'])->name('obat/edit_stok');//edit obat masuk
Route::get('obat/hapus_masuk/{id}', [ObatmasukController::class,'destroy'])->name('hapus_masuk');//hapus obat masuk
Route::post('updatestok/{id}', [ObatmasukController::class, 'updatestok'])->name('updatestok');//update obat masuik
// Route::post('obat/edit_stok/{id}', [StokobatController::class, 'stok_edit'])->name('edit.store');

//obat keluar
Route::get('obat/obatkeluar', [ObatController::class, 'keluar'])->name('obat/obatkeluar');//data obat keluar

//kapuskesmas
Route::get('kapuskes/kapuskes',[KpusController::class, 'index'])->name('kapuskes/kapuskes');
Route::get('kapuskes/tambah_kapus',[KpusController::class, 'create'])->name('kapuskes/tambah_kapus');
Route::post('kapuskes/tambah_kapus',[KpusController::class, 'store'])->name('kapus.store');
Route::get('kapuskes/edit_kapus/{id}',[KpusController::class,'editkapus'])->name('kapus/edit_kapus');//edit data kapus
Route::post('updatekapus/{id}',[KpusController::class,'updatekapus'])->name('updatekapus');//update data kapus
Route::get('kapuskes/hapus_kapus/{id}', [KpusController::class,'destroy'])->name('hapus_kapus');//hapus data kapus
Route::get('kapuskes/selesai_kapus/{id}', [KpusController::class,'selesai'])->name('selesai');//hapus data kapus
Route::post('updateselesai/{id}',[KpusController::class,'updateselesai'])->name('updateselesai');//update data kapus

//cek riwayat berobat
Route::get('riwayat/riwayat', [RiwayatController::class,'index'])->name('riwayat/riwayat');//data pegawai
Route::get('riwayat/rekam_medis/berobat={id}&rekammedis={pasien_id}',[RiwayatController::class,'rekam'])->name('riwayat/rekam_medis');//data rekam medis pasien

//halaman resep
Route::get('resep/resep', [ObatkeluarController::class, 'index'])->name('resep/resep');//data resep

//laporan
Route::get('laporan/pegawai', [PegawaiController::class, 'laporan'])->name('laporan/pegawai');//laporan data pegawai
Route::get('laporan/pasien', [PasienController::class, 'laporan'])->name('laporan/pasien');//laporan data pasien
Route::get('laporan/jadwal', [JadwalController::class, 'laporan_jadwal'])->name('laporan/jadwal');//laporan jadwal petugas
Route::get('laporan/medis', [BerobatController::class, 'laporan'])->name('laporan/medis');//laporan data pasien berobat
Route::get('laporan/obat', [ObatController::class, 'laporan'])->name('laporan/obat');//laporan data obat
Route::get('laporan/obat_masuk', [ObatController::class, 'laporan_masuk'])->name('laporan/obat_masuk');//laporan data obat masuk
Route::get('laporan/obat_keluar', [ObatController::class, 'laporan_keluar'])->name('laporan/obat_keluar');//laporan data obat keluar
Route::get('laporan/petugas', [PetugasController::class, 'laporan'])->name('laporan/petugas');//laporan data petugas
Route::get('laporan/kapus', [KpusController::class, 'laporan'])->name('laporan/kapus');//laporan data kapus
Route::get('laporan/biaya', [BiayaController::class, 'laporan'])->name('laporan/biaya');//laporan data biaya

//cetak
Route::get('pegawai/cetak', [PegawaiController::class, 'cetak_pegawai'])->name('pegawai/cetak');//cetak pegawai
Route::get('petugas/cetak', [PetugasController::class, 'cetak_petugas'])->name('petugas/cetak');//cetak petugas
Route::get('petugas/cetak_jadwal', [JadwalController::class, 'cetak_jadwal'])->name('petugas/cetak_jadwal');//cetak jadwal petugas
Route::get('pasien/cetak_pasien', [PasienController::class, 'cetak_pasien'])->name('pasien/cetak_pasien');//cetak pasien
Route::get('medis/cetak_medis', [BerobatController::class, 'cetak_medis'])->name('medis/cetak_medis');//cetak pasien berobat
Route::get('obat/cetak_obat', [ObatController::class, 'cetak_obat'])->name('obat/cetak_obat');//cetak obat
Route::get('obat/cetak_obatmasuk', [ObatController::class, 'cetak_obatmasuk'])->name('obat/cetak_obatmasuk');//cetak obat masuk
Route::get('obat/cetak_obatkeluar', [ObatController::class, 'cetak_obatkeluar'])->name('obat/cetak_obatkeluar');//cetak obat keluar
Route::get('medis/cetak_rm/pasien={id}&rekammedis={pasien_id}',[MedisController::class,'cetak_rm'])->name('medis/cetak_rm');//cetal rekam medis pasien
Route::get('medis/cetak_sakit/pasien={id}&rekammedis={medis}',[SuratController::class,'cetak_sakit'])->name('medis/cetak_sakit');//cetak surat sakit
Route::get('medis/cetak_sehat/pasien={id}&rekammedis={medis}',[SuratController::class,'cetak_sehat'])->name('medis/cetak_sehat');//cetak surat sakit
Route::get('pasien/detail/cetak_kartu/{id}', [PasienController::class, 'cetak_kartu'])->name('pasien/cetak_kartu');//cetak kartu berobat
Route::get('kapuskes/cetak', [KpusController::class, 'cetak_kapus'])->name('kapuskes/cetak');//cetak kartu berobat
Route::get('biaya/cetak', [BiayaController::class, 'cetak_biaya'])->name('biaya/cetak');//cetak kartu berobat