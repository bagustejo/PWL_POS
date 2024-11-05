<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\SupplierModel;
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

// Pattern untuk parameter ID harus berupa angka
Route::pattern('id', '[0-9]+');

// Routes untuk autentikasi login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postregister'])->name('register');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

    Route::get('/', [WelcomeController::class, 'index']);

    Route::middleware(['authorize:ADM'])->group(function () {
        // Semua route di dalam ini akan memiliki prefix 'user'
        Route::get('/user', [UserController::class, 'index']);
        // Menampilkan halaman awal daftar pengguna. Method index() pada UserController akan dipanggil.
        Route::post('/user/list', [UserController::class, 'list']);
        // Mendapatkan data pengguna dalam bentuk JSON untuk ditampilkan dalam datatable. Method list() pada UserController akan dipanggil.
        Route::get('/user/create', [UserController::class, 'create']);
        // Menampilkan form untuk menambahkan pengguna baru. Method create() pada UserController akan dipanggil.
        Route::post('/user', [UserController::class, 'store']);
        // Menyimpan data pengguna baru ke dalam database. Method store() pada UserController akan dipanggil.
        Route::get('/user/create_ajax', [UserController::class, 'create_ajax']);
        Route::get('/user/ajax', [UserController::class, 'store_ajax']);
        Route::get('/user/{id}', [UserController::class, 'show']);
        // Menampilkan detail pengguna berdasarkan ID. Method show() pada UserController akan dipanggil.
        Route::get('/user/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/user/{id}/edit', [UserController::class, 'edit']);
        // Menampilkan form untuk mengedit pengguna berdasarkan ID. Method edit() pada UserController akan dipanggil.
        Route::put('/user/{id}', [UserController::class, 'update']);
        // Memperbarui data pengguna berdasarkan ID. Method update() pada UserController akan dipanggil.
        Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/user/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/user/{id}', [UserController::class, 'destroy']);
        // Menghapus pengguna berdasarkan ID. Method destroy() pada UserController akan dipanggil.
    });



    Route::middleware(['authorize:ADM'])->group(function () {
        // Semua route di dalam ini akan memiliki prefix 'level'

        Route::get('/level', [LevelController::class, 'index']);
        Route::post('/level/list', [LevelController::class, 'list']);

        Route::get('level/create', [LevelController::class, 'create']);
        Route::get('level/create_ajax', [LevelController::class, 'create_ajax']);

        Route::post('/level', [LevelController::class, 'store']);
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']);

        Route::get('/level/{id}', [LevelController::class, 'show']);
        Route::get('/level/{id}/show_ajax', [LevelController::class, 'show_ajax']);

        Route::get('/level/{id}/edit', [LevelController::class, 'edit']);

        Route::put('/level/{id}', [LevelController::class, 'update']);

        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']);

        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);

        Route::delete('/level/{id}', [LevelController::class, 'destroy']);
    });



    Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create'])->name('kategori.create_ajax');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::post('/kategori/ajax', [KategoriController::class, 'store'])->name('kategori.store_ajax');
        Route::get('/kategori/{id}', [KategoriController::class, 'show']); //menampilkan detail data kategori?
        Route::get('/kategori/{id}/show_ajax', [KategoriController::class, 'show_ajax']); 
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax'])->name('kategori.edit_ajax');
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax'])->name('kategori.update_ajax');
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::post('/kategori/list', [KategoriController::class, 'list'])->name('kategori.list'); // Untuk DataTables
    });



    Route::middleware(['authorize:ADM,MNG'])->group(function() {
        Route::get('/supplier', [SupplierController::class, 'index'])->name('index');
        Route::get('/supplier/create', [SupplierController::class, 'create'])->name('create');
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax'])->name('create_ajax');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('store');
        Route::post('/supplier/store_ajax', [SupplierController::class, 'store_ajax'])->name('store_ajax');
        Route::get('/supplier/{id}', [SupplierController::class, 'show'])->name('show');
        Route::get('/supplier/{id}/show_ajax', [SupplierController::class, 'show_ajax'])->name('show_ajax');
        Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit'])->name('edit');
        Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('update');
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax'])->name('edit_ajax');
        Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax'])->name('update_ajax');
        Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('destroy');
        Route::post('/supplier/list', [SupplierController::class, 'list'])->name('list');
    });



    Route::middleware(['authorize:ADM,MNG,STF'])->group(function() {
        Route::get('/barang', [BarangController::class, 'index']);
        Route::post('/barang/list', [BarangController::class, 'list']);
        Route::get('/barang/create', [BarangController::class, 'create']);
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/barang', [BarangController::class, 'store']);
        Route::post('/barang/store_ajax', [BarangController::class, 'store_ajax']);
        Route::get('/barang/{id}', [BarangController::class, 'show']);
        Route::get('/barang/{id}/show_ajax', [BarangController::class, 'show_ajax']);
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/barang/{id}', [BarangController::class, 'update']);
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']);
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
    });

});

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


