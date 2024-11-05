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
                                                    <input type="text" class="form-control" id="jobName" name="job_name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jobCategory">Kategori</label>
                                                    <input type="text" class="form-control" id="jobCategory" name="category" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="postDate">Tanggal Post</label>
                                                    <input type="date" class="form-control" id="postDate" name="post_date" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deadlineDate">Tanggal Deadline</label>
                                                    <input type="date" class="form-control" id="deadlineDate" name="deadline_date" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jobDescription">Deskripsi</label>
                                                    <textarea class="form-control" id="jobDescription" name="description" rows="3" required></textarea>
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
                                        <!-- Tampilkan data lowongan di sini -->
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