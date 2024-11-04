@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('user/create_ajax')}}')" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif 
        @if (session('eror'))
            <div class="alert alert-danger">{{ session('eror') }}</div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="">- Semua -</option>
                            @foreach($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Level Pengguna</small>
                    </div>
                </div>
            </div>
        </div>
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

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
function modalAction(url = ''){
    $('#myModal').load(url,function(){
        $('#myModal').modal('show');
    });
}

var dataUser;
$(document).ready(function() {
    dataUser = $('#table_user').DataTable({
        // Enable server-side processing for better performance and large datasets
        serverSide: true,
        ajax: {
            url: "{{ url('user/list') }}",
            dataType: "json",
            type: "POST",
            data: function (d) {
                d.level_id = $('#level_id').val();
            }
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
                searchable: false,
                className: 'text-center' 
            }
        ]
    });

    $('#level_id').on('change', function(){
        dataUser.ajax.reload();
    });

});
</script>
@endpush