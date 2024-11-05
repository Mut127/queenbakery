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
                                <h4 class="card-title mb-0">Kelola Pelamar</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addApplicantModal">
                                    <i class="fas fa-user-plus"></i> Tambah Pelamar
                                </button>
                            </div>

                            <!-- Modal Tambah Pelamar -->
                            <div class="modal fade" id="addApplicantModal" tabindex="-1" role="dialog" aria-labelledby="addApplicantModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addApplicantModalLabel">Tambah Pelamar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Biodata Section -->
                                                    <div class="col-md-4">
                                                        <h5><b>Biodata</b></h5>
                                                        <div class="form-group text-center">
                                                            <label for="applicantPhoto" class="d-block">Foto</label>
                                                            <input type="file" class="form-control-file" id="applicantPhoto" name="photo">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="applicantName">Nama</label>
                                                            <input type="text" class="form-control" id="applicantName" name="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="applicantDob">Tempat Tanggal Lahir</label>
                                                            <input type="text" class="form-control" id="applicantDob" name="dob" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="applicantAddress">Alamat</label>
                                                            <input type="text" class="form-control" id="applicantAddress" name="address" required>
                                                        </div>
                                                    </div>

                                                    <!-- Pendidikan Section -->
                                                    <div class="col-md-4">
                                                        <h5><b>Pendidikan</b></h5>
                                                        <div class="form-group">
                                                            <label for="educationField">Riwayat Pendidikan</label>
                                                            <input type="text" class="form-control" id="educationField" name="education" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="institutionName">Nama Instansi</label>
                                                            <input type="text" class="form-control" id="institutionName" name="institution_name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="entryYear">Tahun Masuk</label>
                                                            <input type="text" class="form-control" id="entryYear" name="entry_year" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exitYear">Tahun Keluar</label>
                                                            <input type="text" class="form-control" id="exitYear" name="exit_year" required>
                                                        </div>
                                                    </div>

                                                    <!-- Pengalaman Kerja Section -->
                                                    <div class="col-md-4">
                                                        <h5><b>Pengalaman Kerja</b></h5>
                                                        <div class="form-group">
                                                            <label for="jobPosition">Posisi</label>
                                                            <input type="text" class="form-control" id="jobPosition" name="position" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="companyName">Nama Perusahaan</label>
                                                            <input type="text" class="form-control" id="companyName" name="company_name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="workEntryYear">Tahun Masuk</label>
                                                            <input type="text" class="form-control" id="workEntryYear" name="work_entry_year" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="workExitYear">Tahun Keluar</label>
                                                            <input type="text" class="form-control" id="workExitYear" name="work_exit_year" required>
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
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Tempat Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Pendidikan</th>
                                            <th>Pengalaman Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Tampilkan data pelamar di sini -->
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