@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Detail Kategori</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-secondary mt-1" href="{{ url('kategori') }}">Kembali</a>
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/' . $kategori->kategori_id . '/edit') }}">Edit</a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="kategori_kode">Kode Kategori:</label>
            <p>{{ $kategori->kategori_kode }}</p>
        </div>
        <div class="form-group">
            <label for="kategori_nama">Nama Kategori:</label>
            <p>{{ $kategori->kategori_nama }}</p>
        </div>
    </div>
</div>
@endsection
