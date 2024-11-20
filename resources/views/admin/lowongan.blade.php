@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Kelola Lowongan</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addJobModal">
                                    <i class="fas fa-plus"></i> Tambah Lowongan
                                </button>
                            </div>

                            <!-- Modal Tambah Lowongan -->
                            <div class="modal fade" id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="addJobModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.storeLowongan') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addJobModalLabel">Tambah Lowongan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="jobName">Nama Lowongan</label>
                                                    <input type="text" class="form-control" id="jobName" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jobCategory">Kategori</label>
                                                    <select class="form-control" id="jobCategory" name="kategori_id" required>
                                                        @foreach ($kategorilokers as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="postDate">Tanggal Post</label>
                                                    <input type="date" class="form-control" id="postDate" name="tgl_awal" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deadlineDate">Tanggal Deadline</label>
                                                    <input type="date" class="form-control" id="deadlineDate" name="tgl_dl" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jobDescription">Deskripsi</label>
                                                    <textarea class="form-control" id="jobDescription" name="deskripsi" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Lowongan</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Post</th>
                                            <th>Tanggal Deadline</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lowongans as $lowongan)
                                        <tr>
                                            <td>{{ $lowongan->name }}</td>
                                            <td>{{ $lowongan->kategoriloker->name }}</td> <!-- Mengambil nama kategori -->
                                            <td>{{ $lowongan->tgl_awal }}</td>
                                            <td>{{ $lowongan->tgl_dl }}</td>
                                            <td>{{ $lowongan->deskripsi }}</td>
                                            <td>
                                                <div class="d-inline-flex align-items-center">
                                                    <!-- Edit Button -->
                                                    <a href="#" class="btn btn-sm btn-outline-secondary edit-user mr-1 mb-2" data-toggle="modal" data-target="#editUserModal" data-id="{{ $lowongan->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.destroyLowongan', $lowongan->id) }}" method="POST" class="delete-form mt-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-2">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection