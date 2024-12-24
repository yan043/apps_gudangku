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

@section('title', 'Produk / Barang')

@section('content')

@include('partial.alerts')

<div class="card">
    <h5 class="card-header">Daftar Produk / Barang
        <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-bs-toggle="modal" data-bs-target="#addProducts">
            <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah
        </button>
    </h5>

    <div class="modal fade" id="addProducts" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addProductsTitle">Tambah Barang</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('master.products.store') }}">
              @csrf
              <input type="hidden" name="id" value="new">
              <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="address" class="form-label">Kategori</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $ctg)
                                <option value="{{ $ctg->id }}">{{ $ctg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="code" class="form-label">Kode</label>
                        <input type="text" id="code" name="code" maxlength="10" class="form-control text-center" placeholder="Masukan Kode Barang" />
                    </div>
                    <div class="col mb-0">
                        <label for="name" class="form-label">Nama Barang</label>
                        <input type="text" id="name" name="name" class="form-control text-center" placeholder="Masukan Nama Produk / Barang" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="quantity" class="form-label">Qty</label>
                        <input type="number" id="quantity" name="quantity" class="form-control text-center" placeholder="Masukan Qty" />
                    </div>
                    <div class="col mb-0">
                        <label for="unit" class="form-label">Satuan</label>
                        <input type="text" id="unit" name="unit" class="form-control text-center" placeholder="Masukan Satuan" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="purchase_price" class="form-label">Harga Beli</label>
                        <input type="number" id="purchase_price" name="purchase_price" class="form-control text-center" placeholder="Masukan Harga Beli" />
                    </div>
                    <div class="col mb-0">
                        <label for="selling_price" class="form-label">Harga Jual</label>
                        <input type="number" id="selling_price" name="selling_price" class="form-control text-center" placeholder="Masukan Harga Jual" />
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                  Close
                </button>

                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
    </div>

    <div class="table-responsive">
      <table class="table" id="table-detail">
        <thead class="table-light">
          <tr>
            <th class="text-center">Kategori</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Satuan</th>
            <th class="text-center">Harga Beli</th>
            <th class="text-center">Harga Jual</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach ($data as $k => $v)
        <tr>
            <td class="text-center">{{ $v->category_name }}</td>
            <td class="text-center">{{ $v->code }}</td>
            <td class="text-center">{{ $v->name }}</td>
            <td class="text-center">{{ $v->quantity }}</td>
            <td class="text-center">{{ $v->unit }}</td>
            <td class="text-center">{{ $v->purchase_price }}</td>
            <td class="text-center">{{ $v->selling_price }}</td>
            <td>
                <a style="color: white" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addProducts-{{ $v->id }}" href="{{ route('master.products.store') }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>

                <div class="modal fade" id="addProducts-{{ $v->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addProductsTitle-{{ $v->id }}">Edit Barang - {{ $v->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('master.products.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $v->id }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="address" class="form-label">Kategori</label>
                                        <select id="category_id" name="category_id" class="form-select">
                                            <option value="" disabled selected>Pilih Kategori</option>
                                            @foreach ($categories as $ctg)
                                                <option value="{{ $ctg->id }}" {{ $v->category_id == $ctg->id ? 'selected' : '' }}>
                                                    {{ $ctg->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="code" class="form-label">Kode</label>
                                        <input type="text" id="code" name="code" maxlength="10" class="form-control text-center" placeholder="Masukan Kode Barang" value="{{ $v->code }}" />
                                    </div>
                                    <div class="col mb-0">
                                        <label for="name" class="form-label">Nama Barang</label>
                                        <input type="text" id="name" name="name" class="form-control text-center" placeholder="Masukan Nama Produk / Barang" value="{{ $v->name }}" />
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="quantity" class="form-label">Qty</label>
                                        <input type="number" id="quantity" name="quantity" class="form-control text-center" placeholder="Masukan Qty" value="{{ $v->quantity }}" />
                                    </div>
                                    <div class="col mb-0">
                                        <label for="unit" class="form-label">Satuan</label>
                                        <input type="text" id="unit" name="unit" class="form-control text-center" placeholder="Masukan Satuan" value="{{ $v->unit }}" />
                                    </div>
                                </div>
                                <div class="row g-2">
                                    <div class="col mb-0">
                                        <label for="purchase_price" class="form-label">Harga Beli</label>
                                        <input type="number" id="purchase_price" name="purchase_price" class="form-control text-center" placeholder="Masukan Harga Beli" value="{{ $v->purchase_price }}" />
                                    </div>
                                    <div class="col mb-0">
                                        <label for="selling_price" class="form-label">Harga Jual</label>
                                        <input type="number" id="selling_price" name="selling_price" class="form-control text-center" placeholder="Masukan Harga Jual" value="{{ $v->selling_price }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <a style="color: white; cursor: pointer;" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}" data-url="{{ route('master.products.destroy', ['id' => $v->id]) }}"><i class="bx bx-trash me-1"></i>Delete</a>
            </td>
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
                { width: "100px", targets: 7 }
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

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const url = this.getAttribute('data-url');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>
@endsection
