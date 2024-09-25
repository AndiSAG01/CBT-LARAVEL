<?php

use App\Http\Controllers\Admin\CategoryExam;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\Admin\UjianController;
use App\Http\Controllers\Guru\PengajarController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\JadwalUjianController;
use App\Http\Controllers\User\PagesController;
use App\Http\Controllers\User\ProfilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'pages1'])->name('pages1');
Auth::routes();
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('students/chart', [DashboardController::class, 'studentsPerMonth'])->name('students.chart');

    Route::get('/pages-guru', [GuruController::class, 'index'])->name('guru');
    Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/edit/{guru}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/update/{guru}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/delete/{guru}', [GuruController::class, 'destroy'])->name('guru.destroy');

    // Route::resource('kategori', KategoriController::class);

    // Route::resource('CategoryExam', CategoryExam::class);

    // Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
    // Route::get('/soal/create', [SoalController::class, 'create'])->name('soal.create');
    // Route::post('/soal/store', [SoalController::class, 'store'])->name('soal.store');
    // Route::get('/soal/edit/{soal}', [SoalController::class, 'edit'])->name('soal.edit');
    // Route::put('/soal/update/{soal}', [SoalController::class, 'update'])->name('soal.update');
    // Route::delete('/soal/delete/{soal}', [SoalController::class, 'destroy'])->name('soal.destroy');
    // Route::post('/soal/{id}/toggle-publish', [SoalController::class, 'togglePublish'])->name('soal.togglePublish');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/detail/{siswa}', [SiswaController::class, 'detail'])->name('siswa.detail');
    Route::get('/admin/results/category', [SiswaController::class, 'getExamResultsByCategory'])->name('results.category');



    // Route::get('/kelola-ujian', [UjianController::class, 'index'])->name('ujian.index');
    // Route::get('/kelola-ujian/create', [UjianController::class, 'create'])->name('ujian.create');
    // Route::post('/kelola-ujian/store', [UjianController::class, 'store'])->name('ujian.store');
    // Route::get('kelola-ujian/{kategori_id}/{jam_ujian}', [UjianController::class, 'show'])->name('ujian.show');
    // Route::get('kelola-ujian/edit/{id}', [UjianController::class, 'edit'])->name('ujian.edit');
    // Route::put('kelola-ujian/update/{ujian}', [UjianController::class, 'update'])->name('ujian.update');
    // Route::delete('kelola-ujian/delete/{ujian}', [UjianController::class, 'destroy'])->name('ujian.delete');
    // Route::post('/get-siswa-by-class', [UjianController::class, 'getSiswaByClass'])->name('getSiswaByClass');


    Route::get('/admin/hasil-ujian', [DashboardController::class, 'hasil'])->name('ujian.hasil');
    Route::get('/Cetak-Hasil-Ujian', [DashboardController::class, 'cetaksemua'])->name('hasil.cetak');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pengajar', [PengajarController::class, 'index'])->name('Pengajar.index');

    Route::resource('kategori', KategoriController::class);

    Route::resource('CategoryExam', CategoryExam::class);

    Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
    Route::get('/soal/create', [SoalController::class, 'create'])->name('soal.create');
    Route::post('/soal/store', [SoalController::class, 'store'])->name('soal.store');
    Route::get('/soal/edit/{soal}', [SoalController::class, 'edit'])->name('soal.edit');
    Route::put('/soal/update/{soal}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/delete/{soal}', [SoalController::class, 'destroy'])->name('soal.destroy');
    Route::post('/soal/{id}/toggle-publish', [SoalController::class, 'togglePublish'])->name('soal.togglePublish');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::get('/siswa/detail/{siswa}', [SiswaController::class, 'detail'])->name('siswa.detail');
    Route::get('/siswa/laporan', [SiswaController::class, 'laporan'])->name('siswa.laporan');
    Route::get('/Cetak-laporan-siswa', [SiswaController::class, 'cetaklaporan'])->name('siswa.cetak');



    Route::get('/kelola-ujian', [UjianController::class, 'index'])->name('ujian.index');
    Route::get('/kelola-ujian/create', [UjianController::class, 'create'])->name('ujian.create');
    Route::post('/kelola-ujian/store', [UjianController::class, 'store'])->name('ujian.store');
    Route::get('/kelola-ujian/detail/{kategori_id}/{jam_ujian}', [UjianController::class, 'show'])->name('ujian.show');
    Route::get('/kelola-ujian/edit/{id}', [UjianController::class, 'edit'])->name('ujian.edit');
    Route::put('/kelola-ujian/update/{ujian}', [UjianController::class, 'update'])->name('ujian.update');
    Route::delete('/kelola-ujian/delete/{ujian}', [UjianController::class, 'destroy'])->name('ujian.delete');
    Route::post('/get-siswa-by-class', [UjianController::class, 'getSiswaByClass'])->name('getSiswaByClass');


    Route::get('/admin/hasil-ujian', [DashboardController::class, 'hasil'])->name('ujian.hasil');
    Route::get('/Cetak-Hasil-Ujian', [DashboardController::class, 'cetaksemua'])->name('hasil.cetak');
    Route::get('/contoh', [DashboardController::class, 'contoh'])->name('contoh');
});


Route::get('/regis/siswa', [AuthController::class, 'regis'])->name('regis.siswa');
Route::post('/regis/store', [AuthController::class, 'storeRegis'])->name('regis.store');

Route::get('/login/siswa', [AuthController::class, 'login'])->name('login.siswa');
Route::post('/login/store', [AuthController::class, 'storeLogin'])->name('login.store');

Route::middleware(['auth:student', 'siswa'])->group(function () {
    Route::post('/siswa/logout', [AuthController::class, 'logout'])->name('siswa.logout');
    Route::get('/pages/siswa', [PagesController::class, 'index'])->name('pages');
    Route::get('/Jadwal-Ujian', [JadwalUjianController::class, 'index'])->name('jadwal.index');

    Route::get('/exam/{ujian}/soal/{kategori_id?}', [ExamController::class, 'index'])->name('exam.index');
    Route::post('/exam/store', [ExamController::class, 'storeAnswer'])->name('exam.store');


    Route::get('hasil-ujian', [PagesController::class, 'hasil'])->name('hasil.index');
    // Route for showing the exam results by ujianId and kategoriId
    Route::get('/hasil/{ujianId}/{kategoriId}', [PagesController::class, 'show'])->name('hasil.show');

    Route::get('/Profil/{id}', [ProfilController::class, 'profil'])->name('profil.index');
    Route::get('/Profil/edit/{id}', [ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/Profil/update/{id}', [ProfilController::class, 'UpdateProfil'])->name('profil.update');
    Route::put('/Profil/password', [ProfilController::class, 'updatepassword'])->name('profil.updatepassword');
});
