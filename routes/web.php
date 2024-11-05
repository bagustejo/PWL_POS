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
Route::get('register', [AuthController::class, 'registerForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {

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
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);
        Route::get('/ajax', [UserController::class, 'store_ajax']);
        Route::get('/{id}', [UserController::class, 'show']);
        // Menampilkan detail pengguna berdasarkan ID. Method show() pada UserController akan dipanggil.
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);
        Route::get('/{id}/edit', [UserController::class, 'edit']);
        // Menampilkan form untuk mengedit pengguna berdasarkan ID. Method edit() pada UserController akan dipanggil.
        Route::put('/{id}', [UserController::class, 'update']);
        // Memperbarui data pengguna berdasarkan ID. Method update() pada UserController akan dipanggil.
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        // Menghapus pengguna berdasarkan ID. Method destroy() pada UserController akan dipanggil.
    });



    Route::group(['prefix' => 'level'], function () {
        // Semua route di dalam ini akan memiliki prefix 'level'

        Route::get('/', [LevelController::class, 'index']);
        // Menampilkan halaman awal daftar level. Method index() pada LevelController akan dipanggil.

        Route::post('/list', [LevelController::class, 'list']);
        // Mendapatkan data level dalam bentuk JSON untuk ditampilkan dalam datatable. Method list() pada LevelController akan dipanggil.

        Route::get('/create', [LevelController::class, 'create']);
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
        // Menampilkan form untuk menambahkan level baru. Method create() pada LevelController akan dipanggil.

        Route::post('/', [LevelController::class, 'store']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);
        // Menyimpan data level baru ke dalam database. Method store() pada LevelController akan dipanggil.

        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        // Menampilkan detail level berdasarkan ID. Method show() pada LevelController akan dipanggil.

        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        // Menampilkan form untuk mengedit level berdasarkan ID. Method edit() pada LevelController akan dipanggil.

        Route::put('/{id}', [LevelController::class, 'update']);
        // Memperbarui data level berdasarkan ID. Method update() pada LevelController akan dipanggil.

        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);

        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);

        Route::delete('/{id}', [LevelController::class, 'destroy']);
        // Menghapus level berdasarkan ID. Method destroy() pada LevelController akan dipanggil.
    });



    Route::prefix('kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::get('/create_ajax', [KategoriController::class, 'create'])->name('kategori.create_ajax');
        Route::post('/', [KategoriController::class, 'store'])->name('kategori.store');
        Route::post('/ajax', [KategoriController::class, 'store'])->name('kategori.store_ajax');
        Route::get('/{id}', [KategoriController::class, 'show']); //menampilkan detail data kategori?
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']); 
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax'])->name('kategori.edit_ajax');
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax'])->name('kategori.update_ajax');
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::post('/list', [KategoriController::class, 'list'])->name('kategori.list'); // Untuk DataTables
    });



    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index');
        Route::get('/create', [SupplierController::class, 'create'])->name('create');
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax'])->name('create_ajax');
        Route::post('/', [SupplierController::class, 'store'])->name('store');
        Route::post('/store_ajax', [SupplierController::class, 'store_ajax'])->name('store_ajax');
        Route::get('/{supplier}', [SupplierController::class, 'show'])->name('show');
        Route::get('/{supplier}/show_ajax', [SupplierController::class, 'show_ajax'])->name('show_ajax');
        Route::get('/{supplier}/edit', [SupplierController::class, 'edit'])->name('edit');
        Route::put('/{supplier}', [SupplierController::class, 'update'])->name('update');
        Route::get('/{supplier}/edit_ajax', [SupplierController::class, 'edit_ajax'])->name('edit_ajax');
        Route::put('/{supplier}/update_ajax', [SupplierController::class, 'update_ajax'])->name('update_ajax');
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy');
        Route::post('/list', [SupplierController::class, 'list'])->name('list');
    });



    Route::prefix('barang')->name('barang.')->group(function () {
        Route::get('/', [BarangController::class, 'index'])->name('index');
        Route::post('/list', [BarangController::class, 'list'])->name('list');
        Route::get('/create', [BarangController::class, 'create'])->name('create');
        Route::get('/create_ajax', [BarangController::class, 'create_ajax'])->name('create_ajax');
        Route::post('/', [BarangController::class, 'store'])->name('store');
        Route::post('/store_ajax', [BarangController::class, 'store_ajax'])->name('store_ajax');
        Route::get('/{barang}', [BarangController::class, 'show'])->name('show');
        Route::get('/{barang}/show_ajax', [BarangController::class, 'show_ajax'])->name('show_ajax');
        Route::get('/{barang}/edit', [BarangController::class, 'edit'])->name('edit');
        Route::put('/{barang}', [BarangController::class, 'update'])->name('update');
        Route::get('/{barang}/edit_ajax', [BarangController::class, 'edit_ajax'])->name('edit_ajax');
        Route::put('/{barang}/update_ajax', [BarangController::class, 'update_ajax'])->name('update_ajax');
        Route::delete('/{barang}', [BarangController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
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


