<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\ContentTypes;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade as PDF;

class BarangController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
           'title' => 'Daftar Barang',
           'list' => ['Home','Barang']
        ];

        $page = (object) [
           'title' => 'Daftar barang yang dijual di toko.'
        ];

        $activeMenu = 'barang'; //set menu yang sedang aktif

        $kategori = KategoriModel::all(); //mengambil data kategori untuk filtering

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
   }
   
   public function list(Request $request){
       $barangs = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual')
           -> with('kategori');

           //set data untuk filtering
       if($request->kategori_id){
           $barangs->where('kategori_id', $request->kategori_id);
       }
       
       return DataTables::of($barangs)
       ->addIndexColumn()  
       ->addColumn('aksi', function ($barang) { 
        //           $btn  = '<a href="'.url('/barang/' . $barang->barang_id).'" class="btn btn-info btn-sm">Detail</a> '; 
        //          $btn .= '<a href="'.url('/barang/' . $barang->barang_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> '; 
        //         $btn .= '<form class="d-inline-block" method="POST" action="'. url('/barang/'.$barang->barang_id).'">' 
        //              . csrf_field() . method_field('DELETE') .  
        //              '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';      
        $btn = '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
        $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
        $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';

        return $btn; 
        }) 
        ->rawColumns(['aksi'])
        ->make(true);
   }

   public function create() {
       $breadcrumb = (object) [
           'title' => 'Tambah Barang',
           'list' => ['Home','Barang','Tambah']
       ];

       $page = (object) [
           'title' => 'Tambah barang baru'
       ];

       $kategori = KategoriModel::all();
       $activeMenu = 'barang';

       return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
   }

   public function store(Request $request) {
       $request -> validate ([
           'barang_kode'    => 'required|string|min:3|unique:m_barang,barang_kode',
           'kategori_id'    => 'required|integer',
           'barang_nama'    => 'required|string|max:100',
           'harga_beli'     => 'required|integer',
           'harga_jual'     => 'required|integer'
       ]);

       BarangModel::create([
           'barang_kode'    => $request->barang_kode,
           'kategori_id'    => $request->kategori_id,
           'barang_nama'    => $request->barang_nama,
           'harga_beli'     => $request->harga_beli,
           'harga_jual'     => $request->harga_jual
       ]);

       return redirect('/barang')->with('success', 'Data barang berhasil disimpan.');
   }

   public function show(string $id) {
       $barang = BarangModel::with('kategori')->find($id);
       $breadcrumb = (object) [
           'title' => 'Detail Barang',
           'list'  => ['Home','Barang','Detail']
       ];

       $page = (object) [
           'title' => 'Detail Barang',
       ];

       $activeMenu = 'barang';

       return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page,'barang' => $barang, 'activeMenu' => $activeMenu]);
   }

   public function show_ajax(string $id)
    {
        // Ambil barang berdasarkan ID dan sertakan relasi dengan KategoriModel (atau model lain jika ada)
        $barang = BarangModel::find($id);
        // Kirimkan data barang ke view
        return view('barang.show_ajax', ['barang' => $barang]);
    }

   public function edit(string $id) {
       $barang = BarangModel::find($id);
       $kategori = KategoriModel::all();

       $breadcrumb = (object) [
           'title' => 'Edit Barang',
           'list' => ['Home','Barang','Edit'],
       ];

       $page = (object) [
           'title' => 'Edit Barang'
       ];

       $activeMenu = 'barang';

       return view('barang.edit', ['breadcrumb' => $breadcrumb, 'kategori' => $kategori, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
   }

   public function update(Request $request, string $id) {
       $request -> validate( [ 
           'barang_kode'    => 'required|string|min:3|unique:m_barang,barang_kode',
           'kategori_id'    => 'required|integer',
           'barang_nama'    => 'required|string|max:100',
           'harga_beli'     => 'required|integer',
           'harga_jual'     => 'required|integer'
       ]);

       BarangModel::find($id)->update([
           'barang_kode'    => $request->barang_kode,
           'kategori_id'    => $request->kategori_id,
           'barang_nama'    => $request->barang_nama,
           'harga_beli'     => $request->harga_beli,
           'harga_jual'     => $request->harga_jual
       ]);

       return redirect('/barang')->with('success','Data barang berhasil diubah');

   }

   public function destroy(string $id) {
       $check = BarangModel::find($id);
       if(!$check) {
           return redirect('/barang') -> with('error', 'Data barang tidak ditemukan');
       }

       try {
           BarangModel::destroy($id);

           return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
       } catch (\Illuminate\Database\QueryException $e) {
           return redirect('/barang') -> with('error','Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
       }
   }

   public function create_ajax()
   {
       // Mengambil data kategori untuk digunakan dalam form create barang
       $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
   
       // Membuat breadcrumb untuk tampilan yang lebih terstruktur
       $breadcrumb = (object) [
           'title' => 'Tambah Barang (AJAX)',
           'list' => ['Home', 'Barang', 'Tambah']
       ];
   
       // Mengembalikan view untuk menampilkan form create barang dengan data kategori
       return view('barang.create_ajax', compact('kategori', 'breadcrumb'));
   }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Aturan validasi untuk input barang
            $rules = [
                'kategori_id' => 'required|integer',
                'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'harga_beli' => 'required|numeric|min:1',
                'harga_jual' => 'required|numeric|min:1',
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

            // Menyimpan data barang
            BarangModel::create([
                'kategori_id' => $request->kategori_id,
                'barang_kode' => $request->barang_kode,
                'barang_nama' => $request->barang_nama,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
            ]);

            // Mengembalikan respon sukses
            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil disimpan',
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);  // Eager loading kategori
     
        if (!$barang) {
            return response()->json(['status' => false, 'message' => 'Data barang tidak ditemukan']);
        }
    
        // Mendapatkan kategori list
        $kategori = KategoriModel::select('kategori_id', 'kategori_nama')->get();
    
        return view('barang.edit_ajax', ['barang' => $barang, 'kategori' => $kategori]);
    }
    
    public function update_ajax(Request $request, $id) {
        // Pastikan bahwa ini adalah request AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Definisikan aturan validasi
            $rules = [
                'kategori_id' => 'required|integer',
                'barang_kode' => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|max:100',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric',
            ];
    
            // Jalankan validasi
            $validator = Validator::make($request->all(), $rules);
    
            // Jika validasi gagal, kembalikan pesan error
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }
    
            // Temukan barang berdasarkan ID
            $barang = BarangModel::find($id);
    
            // Jika barang tidak ditemukan, kembalikan pesan error
            if (!$barang) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data barang tidak ditemukan'
                ]);
            }
    
            // Lakukan update data barang
            $barang->update($request->all());
    
            // Kembalikan respons sukses
            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil diupdate'
            ]);
        }
    
        // Jika bukan request AJAX, redirect ke halaman utama atau halaman lain
        return redirect('/');
    }          

    public function confirm_ajax(string $id)
    {
        // Ambil barang berdasarkan ID dan sertakan relasi dengan KategoriModel (atau model lain jika ada)
        $barang = BarangModel::with('kategori')->find($id);

        // Pastikan barang ditemukan
        if (!$barang) {
            return response()->json([
                'status' => false,
                'message' => 'Barang tidak ditemukan.'
            ]);
        }

        // Kirimkan data barang ke view
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // Cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);

            if ($barang) {
                $barang->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data barang berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data barang tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }
    

}        