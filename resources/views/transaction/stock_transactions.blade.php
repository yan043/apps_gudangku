@extends('layouts')

@section('css')
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
<style>
    #table-detail tbody tr {
        line-height: 1.1;
    }

    #table-detail tbody td {
        padding: 2px 4px;
    }

    #table-detail thead th {
        padding: 4px 6px;
    }

    .dt-buttons .btn {
        height: 38px;
        line-height: 1.5;
        font-size: 0.875rem;
    }

    .dataTables_filter input {
        height: 38px;
        padding: 6px 10px;
        font-size: 0.875rem;
    }

    table.dataTable td, table.dataTable th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('title', 'Transaksi Stok')

@section('content')
<div class="card">
    <h5 class="card-header">Manajemen User</h5>

    <div class="table-responsive">
        <table class="table" id="table-detail">
            <thead class="table-light">
                <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nama Barang</th>
                <th class="text-center">Stok Awal</th>
                <th class="text-center">Total Pembelian</th>
                <th class="text-center">Total Penerimaan</th>
                <th class="text-center">Stok Tersedia</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0 text-center">
                @foreach ($data as $numb => $value)
                    <tr>
                        <td>{{ ++$numb }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->quantity }}</td>
                        <td>{{ $value->total_purchase ?? 0 }}</td>
                        <td>{{ $value->total_receipt ?? 0 }}</td>
                        <td>{{ $value->available_stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#table-detail').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            columnDefs: [
                { width: "100px", targets: 4 }
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'Semuanya']
            ],
            language: {
                lengthMenu: "Tampilkan _MENU_ entri",
                zeroRecords: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Tidak ada entri tersedia",
                infoFiltered: "(difilter dari total _MAX_ entri)",
                search: "Cari:",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                },
            }
        });
    });
</script>
@endsection

