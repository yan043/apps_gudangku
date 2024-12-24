@extends('layouts')

@section('css')
@endsection

@section('title', 'Transaksi Stok')

@section('content')
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Barang</th>
            <th>Stok Awal</th>
            <th>Total Pembelian</th>
            <th>Total Penerimaan</th>
            <th>Stok Tersedia</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->initial_stock }}</td>
                <td>{{ $product->total_purchase ?? 0 }}</td>
                <td>{{ $product->total_receipt ?? 0 }}</td>
                <td>{{ $product->available_stock }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
@endsection
