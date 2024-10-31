@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm float-right">Tambah Barang</a>
    </div>
    <div class="card-body">
        <table id="table-barang" class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data akan diisi melalui DataTables -->
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
<!-- Tambahkan CSS jika diperlukan -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#table-barang').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('barang.list') }}", // Pastikan URL ini benar
                type: "POST",
                data: function (d) {
                    d._token = "{{ csrf_token() }}"; // CSRF token untuk keamanan
                }
            },
            columns: [
                { 
                    data: 'DT_RowIndex', 
                    name: 'DT_RowIndex', 
                    className: 'text-center', 
                    orderable: false, 
                    searchable: false 
                },
                { 
                    data: 'kategori.kategori_nama', 
                    name: 'kategori.kategori_nama' 
                },
                { 
                    data: 'barang_kode', 
                    name: 'barang_kode' 
                },
                { 
                    data: 'barang_nama', 
                    name: 'barang_nama' 
                },
                { 
                    data: 'harga_beli', 
                    name: 'harga_beli' 
                },
                { 
                    data: 'harga_jual', 
                    name: 'harga_jual' 
                },
                { 
                    data: 'aksi', 
                    name: 'aksi', 
                    orderable: false, 
                    searchable: false, 
                    className: 'text-center' 
                }
            ]
        });
    });
</script>
@endpush
