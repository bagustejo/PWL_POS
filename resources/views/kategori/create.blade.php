@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Kategori</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-secondary mt-1" href="{{ url('kategori') }}">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('kategori') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kategori_kode">Kode Kategori</label>
                <input type="text" name="kategori_kode" id="kategori_kode" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kategori_nama">Nama Kategori</label>
                <input type="text" name="kategori_nama" id="kategori_nama" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
