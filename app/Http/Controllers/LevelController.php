<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    // Menampilkan Halaman Awal Daftar Level
    public function index()
    {
        // Mendapatkan data untuk breadcrumb
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        // Mendapatkan data untuk halaman
        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        // Menentukan menu aktif
        $activeMenu = 'level';

        // Mengambil data level dari database
        $levels = LevelModel::all();

        // Menampilkan view dengan data yang telah disiapkan
        return view('level.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'levels' => $levels, // Kirim variabel levels ke view
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data level dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');

        return DataTables::of($levels)
            ->addIndexColumn() // Menambahkan kolom indeks
            ->addColumn('aksi', function ($level) {
                $btn = '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi']) // Memberitahu bahwa kolom aksi berisi HTML
            ->make(true);
    }

    // Menampilkan halaman form tambah level
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah level baru'
        ];

        $activeMenu = 'level';

        return view('level.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data level baru
    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function create_ajax()
    {
        // Mengembalikan view untuk form level
        return view('level.create_ajax');
    }

    public function store_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi untuk input level
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:100',
            ];
    
            // Melakukan validasi
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                // Mengembalikan respon jika validasi gagal
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            // Menyimpan data level
            LevelModel::create([
                'level_kode' => $request->level_kode,
                'level_nama' => $request->level_nama,
            ]);
    
            // Mengembalikan respon sukses
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan',
            ]);
        }
    
        return redirect('/');
    }    
    

    // Menampilkan detail level
    public function show(string $id)
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail level'
        ];

        $activeMenu = 'level';

        return view('level.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function show_ajax(string $id)
    {
        // Ambil data level berdasarkan ID
        $level = LevelModel::find($id);

        // Jika data level tidak ditemukan, kirimkan respon error
        if (!$level) {
            return response()->json([
                'status' => false,
                'message' => 'Level tidak ditemukan.'
            ]);
        }

        // Kembalikan view konfirmasi penghapusan level
        return view('level.show_ajax', ['level' => $level]);
    }

    // Menampilkan halaman edit form level
    public function edit(string $id)
    {
        $level = LevelModel::findOrFail($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit_ajax(string $id)
    {
        // Temukan data level berdasarkan ID
        $level = LevelModel::find($id);

        if (!$level) {
            return response()->json(['status' => false, 'message' => 'Data level tidak ditemukan']);
        }

        return view('level.edit_ajax', ['level' => $level]);
    }

    // Menyimpan perubahan data level
    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function update_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|max:20|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|max:100',
            ];

            // Validasi input
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            $level = LevelModel::find($id);

            if ($level) {
                $level->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    // Menghapus data level
    public function destroy(string $id)
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);

            if ($level) {
                $level->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        // Ambil data level berdasarkan ID
        $level = LevelModel::find($id);

        // Jika data level tidak ditemukan, kirimkan respon error
        if (!$level) {
            return response()->json([
                'status' => false,
                'message' => 'Level tidak ditemukan.'
            ]);
        }

        // Kembalikan view konfirmasi penghapusan level
        return view('level.confirm_ajax', ['level' => $level]);
    }

}
