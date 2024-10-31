@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('supplier.update', $supplier->supplier_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="supplier_kode">Kode Supplier</label>
                <input type="text" name="supplier_kode" class="form-control" value="{{ $supplier->supplier_kode }}" required>
            </div>
            <div class="form-group">
                <label for="supplier_nama">Nama Supplier</label>
                <input type="text" name="supplier_nama" class="form-control" value="{{ $supplier->supplier_nama }}" required>
            </div>
            <div class="form-group">
                <label for="supplier_alamat">Alamat Supplier</label>
                <input type="text" name="supplier_alamat" class="form-control" value="{{ $supplier->supplier_alamat }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
