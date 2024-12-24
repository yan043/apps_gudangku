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

@section('title', 'Manajemen User')

@section('content')

@include('partial.alerts')

<div class="card">
    <h5 class="card-header">Manajemen User
      <button type="button" class="btn btn-sm rounded-pill btn-secondary" data-bs-toggle="modal" data-bs-target="#addUser">
        <span class="tf-icons bx bx-plus"></span>&nbsp; Tambah
      </button>
    </h5>

    <div class="modal fade" id="addUser" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addUserTitle">Tambah User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ route('settings.employee.store') }}">
            @csrf
            <input type="hidden" name="id" value="new">
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="number" id="nik" name="nik" maxlength="11" class="form-control" placeholder="Masukan NIK" />
                    </div>
                    <div class="col mb-0">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Masukan Nama Lengkap" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="gender" class="form-label">Jenis Kelamin</label>
                        <select id="gender" name="gender" class="form-select">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col mb-0">
                        <label for="level_id" class="form-label">Level</label>
                        <select id="level_id" name="level_id" class="form-select">
                            <option value="" disabled selected>Pilih Level</option>
                            @foreach ($level as $lvl)
                                <option value="{{ $lvl->id }}">{{ ucwords(str_replace('_', ' ', $lvl->name)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0">
                        <label for="phone" class="form-label">Nomor Telepon</label>
                        <input type="number" id="phone" name="phone" maxlength="15" class="form-control" placeholder="Masukan Nomor Telepon" />
                    </div>
                    <div class="col mb-0">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" id="password" name="password" class="form-control" placeholder="Masukan Password" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
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
            <th class="text-center">NIK</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Level</th>
            <th class="text-center">Alamat</th>
            <th class="text-center">No Telepon</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0 text-center">
        @foreach ($data as $k => $v)
          <tr>
                <td>{{ $v->nik }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->gender }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $v->level_name)) }}</td>
                <td>{{ $v->address }}</td>
                <td>{{ $v->phone }}</td>
                <td>
                    <a style="color: white" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editEmployee-{{ $v->id }}" href="{{ route('settings.employee.store') }}"><i class="bx bx-edit-alt me-1"></i>Edit</a>

                    <div class="modal fade" id="editEmployee-{{ $v->id }}" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="editEmployeeTitle-{{ $v->id }}">Edit Kategori - {{ $v->id }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="/settings/employee/store">
                            @csrf
                            <input type="hidden" name="id" value="{{ $v->id }}">
                                <div class="modal-body">
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="number" id="nik" name="nik" maxlength="11" class="form-control" placeholder="Masukan NIK" value="{{ $v->nik }}" />
                                        </div>
                                        <div class="col mb-0">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Masukan Nama Lengkap" value="{{ $v->name }}" />
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="gender" class="form-label">Jenis Kelamin</label>
                                            <select id="gender" name="gender" class="form-select">
                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" {{ $v->gender == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="Perempuan" {{ $v->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col mb-0">
                                            <label for="level_id" class="form-label">Level</label>
                                            <select id="level_id" name="level_id" class="form-select">
                                                <option value="" disabled selected>Pilih Level</option>
                                                @foreach ($level as $lvl)
                                                <option value="{{ $lvl->id }}" {{ $v->level_id == $lvl->id ? 'selected' : '' }}>
                                                    {{ ucwords(str_replace('_', ' ', $lvl->name)) }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-0">
                                            <label for="phone" class="form-label">Nomor Telepon</label>
                                            <input type="number" id="phone" name="phone" maxlength="15" class="form-control" placeholder="Masukan Nomor Telepon" value="{{ $v->phone }}" />
                                        </div>
                                        <div class="col mb-0">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" id="password" name="password" class="form-control" placeholder="Ganti Password Baru" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="address" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="address" name="address" rows="3">{{ $v->address }}</textarea>
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

                    <a style="color: white; cursor: pointer;" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}" data-url="{{ route('settings.employee.destroy', ['id' => $v->id]) }}"><i class="bx bx-trash me-1"></i>Delete</a>
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
