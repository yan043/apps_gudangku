@extends('layouts')

@section('css')
<style>
    #items_table {
        table-layout: fixed;
        width: 100%;
    }

    #items_table th:nth-child(1), #items_table td:nth-child(1) {
        width: 68%;
    }

    #items_table th:nth-child(2), #items_table td:nth-child(2) {
        width: 20%;
        text-align: center;
    }

    #items_table th:nth-child(3), #items_table td:nth-child(3) {
        width: 12%;
        text-align: center;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>
@endsection

@section('title', 'Penerimaan Barang')

@section('content')

@include('partial.alerts')

<div class="card">
    <h5 class="card-header">Penerimaan Barang</h5>
    <div class="card-body">
        <form action="{{ route('transaction.receipt.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier</label>
                <select name="supplier_id" id="supplier" class="form-control" required>
                    <option value="">Pilih Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="receipt_date" class="form-label">Tanggal Penerimaan</label>
                <input type="date" name="receipt_date" id="receipt_date" class="form-control" required>
            </div>

            <h5>Daftar Barang</h5>
            <table class="table" id="items_table">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th class="action-column">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="items[0][product_id]" class="form-control" required>
                                <option value="">Pilih Barang</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="items[0][qty]" class="form-control qty" required></td>
                        <td><button type="button" class="btn btn-danger remove-row"><i class="bx bx-trash me-1"></i>Hapus</button></td>
                    </tr>
                </tbody>
            </table>

            <div class="action-buttons mt-3">
                <button type="button" id="add_row" class="btn btn-success"><i class="bx bx-plus me-1"></i>Tambah Barang</button>
                <button type="submit" class="btn btn-primary"><i class="bx bx-save me-1"></i>Simpan</button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    let rowCount = 1;

    document.getElementById('add_row').addEventListener('click', function () {
        const table = document.getElementById('items_table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();

        newRow.innerHTML = `
            <td>
                <select name="items[${rowCount}][product_id]" class="form-control" required>
                    <option value="">Pilih Barang</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="items[${rowCount}][qty]" class="form-control qty" required></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="bx bx-trash me-1"></i>Hapus</button></td>
        `;

        rowCount++;
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endsection
