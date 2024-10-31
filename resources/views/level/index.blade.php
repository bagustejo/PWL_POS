@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <a href="{{ url('level/create') }}" class="btn btn-primary btn-sm float-right">Tambah Level</a>
    </div>
    <div class="card-body">
        <table id="table-level" class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Level</th>
                    <th>Nama Level</th>
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
@endpush

@push('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table-level').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('level/list') }}", // Endpoint untuk pengolahan server-side
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
                    data: 'level_kode', 
                    name: 'level_kode' 
                },
                { 
                    data: 'level_nama', 
                    name: 'level_nama' 
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
