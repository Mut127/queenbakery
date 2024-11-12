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
                                        <tr>
                                            <td></td>
                                            <td>Kim</td>
                                            <td>Daegu, 30-12-1995</td>
                                            <td>Daegu</td>
                                            <td>S1 Tata Boga</td>
                                            <td>5 Tahun</td>
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