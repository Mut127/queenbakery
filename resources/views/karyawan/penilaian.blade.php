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
                                <h4 class="card-title mb-0">Penilaian Kinerja</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addPerformanceModal">
                                    <i class="fas fa-plus"></i> Tambah Penilaian
                                </button>
                            </div>

                            <!-- Modal Tambah Penilaian -->
                            <div class="modal fade" id="addPerformanceModal" tabindex="-1" role="dialog" aria-labelledby="addPerformanceModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addPerformanceModalLabel">Tambah Penilaian</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="date">Tanggal</label>
                                                            <input type="date" class="form-control" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="name">Nama</label>
                                                            <input type="text" class="form-control" id="name" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="description">Deskripsi</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="score">Penilaian</label>
                                                            <select class="form-control" id="score" name="score" required>
                                                                <option value="">Pilih Penilaian</option>
                                                                <option value="Buruk">Buruk</option>
                                                                <option value="Cukup">Cukup</option>
                                                                <option value="Baik">Baik</option>
                                                                <option value="Baik Sekali">Baik Sekali</option>
                                                            </select>
                                                        </div>                                                        
                                                    </div>
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
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Penilaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop data penilaian kinerja dari database -->
                                            <tr>
                                                <td>5-11-2024</td>
                                                <td>Alice</td>
                                                <td>Displin, Kerja sesuai jobdesc</td>
                                                <td>Baik Sekali</td>
                                                <td>
                                                    <div class="d-inline-flex align-items-center">
                                                        <!-- Edit Button -->
                                                        <a href="#" class="btn btn-sm btn-outline-secondary edit-user mr-1 mb-2" data-toggle="modal" data-target="#editUserModal" data-id="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 640 512">
                                                                <path fill="#FFB200" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8 4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                                            </svg>
                                                        </a>
    
                                                        <!-- Delete Button -->
                                                        <form action="" method="POST" class="delete-form mt-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 448 512">
                                                                    <path fill="#FF0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit Penilaian -->
                                            <div class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Penilaian</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="month">Bulan</label>
                                                                            <input type="month" class="form-control" name="month" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="date">Tanggal</label>
                                                                            <input type="date" class="form-control" name="date" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Nama</label>
                                                                            <input type="text" class="form-control" name="name" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="description">Deskripsi</label>
                                                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="score">Penilaian</label>
                                                                            <select class="form-control" id="score" name="score" required>
                                                                                <option value="Buruk">Buruk</option>
                                                                                <option value="Cukup">Cukup</option>
                                                                                <option value="Baik">Baik</option>
                                                                                <option value="Baik Sekali">Baik Sekali</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
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