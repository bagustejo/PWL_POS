@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Barang</h3>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary btn-sm float-right">Kembali ke Daftar Barang</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="barang_kode">Kode Barang</label>
                    <input type="text" class="form-control" id="barang_kode" value="{{ $barang->barang_kode }}" readonly>
                </div>
                <div class="form-group">
                    <label for="barang_nama">Nama Barang</label>
                    <input type="text" class="form-control" id="barang_nama" value="{{ $barang->barang_nama }}" readonly>
                </div>
                <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" class="form-control" id="harga_beli" value="{{ number_format($barang->harga_beli, 0, ',', '.') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" value="{{ number_format($barang->harga_jual, 0, ',', '.') }}" readonly>
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" class="form-control" id="kategori" value="{{ $barang->kategori->kategori_nama ?? 'Tidak ada kategori' }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="created_at">Tanggal Dibuat</label>
                    <input type="text" class="form-control" id="created_at" value="{{ $barang->created_at ? $barang->created_at->format('d-m-Y H:i') : 'Belum ada tanggal' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="updated_at">Tanggal Diperbarui</label>
                    <input type="text" class="form-control" id="updated_at" value="{{ $barang->updated_at ? $barang->updated_at->format('d-m-Y H:i') : 'Belum pernah diperbarui' }}" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
