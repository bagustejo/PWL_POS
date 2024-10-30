@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif 
        @if (session('eror'))
            <div class="alert alert-danger">{{ session('eror') }}</div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
$(document).ready(function() {
    $('#table_user').DataTable({
        // Enable server-side processing for better performance and large datasets
        serverSide: true,
        ajax: {
            url: "{{ url('user/list') }}",
            type: "POST"
        },
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex', // Optional, for column search
                className: 'text-center',
                orderable: false,
                searchable: false
            },
            {
                data: 'username',
                name: 'username'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'level.level_nama',
                name: 'level.level_nama',
                orderable: false,
                searchable: false
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
@endpush