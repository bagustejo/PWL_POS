<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
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

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);
*/

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    // Semua route di dalam ini akan memiliki prefix 'user'

    Route::get('/', [UserController::class, 'index']);
    // Menampilkan halaman awal daftar pengguna. Method index() pada UserController akan dipanggil.

    Route::post('/list', [UserController::class, 'list']);
    // Mendapatkan data pengguna dalam bentuk JSON untuk ditampilkan dalam datatable. Method list() pada UserController akan dipanggil.

    Route::get('/create', [UserController::class, 'create']);
    // Menampilkan form untuk menambahkan pengguna baru. Method create() pada UserController akan dipanggil.

    Route::post('/', [UserController::class, 'store']);
    // Menyimpan data pengguna baru ke dalam database. Method store() pada UserController akan dipanggil.

    Route::get('/{id}', [UserController::class, 'show']);
    // Menampilkan detail pengguna berdasarkan ID. Method show() pada UserController akan dipanggil.

    Route::get('/{id}/edit', [UserController::class, 'edit']);
    // Menampilkan form untuk mengedit pengguna berdasarkan ID. Method edit() pada UserController akan dipanggil.

    Route::put('/{id}', [UserController::class, 'update']);
    // Memperbarui data pengguna berdasarkan ID. Method update() pada UserController akan dipanggil.

    Route::delete('/{id}', [UserController::class, 'destroy']);
    // Menghapus pengguna berdasarkan ID. Method destroy() pada UserController akan dipanggil.
});