@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit Kategori</h3>
    </div>
    <div class="card-body">
        <form action="{{ url('kategori/' . $kategori->kategori_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kategori_kode">Kode Kategori</label>
                <input type="text" name="kategori_kode" id="kategori_kode" class="form-control @error('kategori_kode') is-invalid @enderror" value="{{ old('kategori_kode', $kategori->kategori_kode) }}" required>
                @error('kategori_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kategori_nama">Nama Kategori</label>
                <input type="text" name="kategori_nama" id="kategori_nama" class="form-control @error('kategori_nama') is-invalid @enderror" value="{{ old('kategori_nama', $kategori->kategori_nama) }}" required>
                @error('kategori_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ url('kategori') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
