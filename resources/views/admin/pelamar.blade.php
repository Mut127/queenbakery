@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="main-panel">
            <div class="content-wrapper pl-5 " style="background-color: transparent";>
                <!--  <div class="ml-2 mr-2 content-wrapper"> -->
                <div class="row">
                    <div class="col-lg-20 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Kelola Pelamar</h4>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addApplicantModal">
                                        <i class="fas fa-user-plus"></i> Tambah Pelamar
                                    </button>
                                </div>

                                <!-- Modal Tambah Pelamar -->
                                <div class="modal fade" id="addApplicantModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addApplicantModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.pelamar.storePelamar') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addApplicantModalLabel">Tambah Pelamar</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
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
                                                                <input type="file" class="form-control-file"
                                                                    id="applicantPhoto" name="photo">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="applicantName">Nama</label>
                                                                <input type="text" class="form-control"
                                                                    id="applicantName" name="name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="applicantDob">Tempat Tanggal Lahir</label>
                                                                <input type="text" class="form-control" id="applicantDob"
                                                                    name="dob" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="applicantAddress">Alamat</label>
                                                                <input type="text" class="form-control"
                                                                    id="applicantAddress" name="address" required>
                                                            </div>
                                                        </div>

                                                        <!-- Pendidikan Section -->
                                                        <div class="col-md-4">
                                                            <h5><b>Pendidikan</b></h5>
                                                            <div class="form-group">
                                                                <label for="educationField">Riwayat Pendidikan</label>
                                                                <input type="text" class="form-control"
                                                                    id="educationField" name="education" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="institutionName">Nama Instansi</label>
                                                                <input type="text" class="form-control"
                                                                    id="institutionName" name="institution_name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="entryYear">Tahun Masuk</label>
                                                                <input type="text" class="form-control" id="entryYear"
                                                                    name="entry_year" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exitYear">Tahun Keluar</label>
                                                                <input type="text" class="form-control" id="exitYear"
                                                                    name="exit_year" required>
                                                            </div>
                                                        </div>

                                                        <!-- Pengalaman Kerja Section -->
                                                        <div class="col-md-4">
                                                            <h5><b>Pengalaman Kerja</b></h5>
                                                            <div class="form-group">
                                                                <label for="jobPosition">Posisi</label>
                                                                <input type="text" class="form-control" id="jobPosition"
                                                                    name="position" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="companyName">Nama Perusahaan</label>
                                                                <input type="text" class="form-control" id="companyName"
                                                                    name="company_name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="workEntryYear">Tahun Masuk</label>
                                                                <input type="text" class="form-control"
                                                                    id="workEntryYear" name="work_entry_year" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="workExitYear">Tahun Keluar</label>
                                                                <input type="text" class="form-control"
                                                                    id="workExitYear" name="work_exit_year" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Batal</button>
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
                                            @foreach ($pelamars as $applicant)
                                                <tr>
                                                    <td><img src="{{ asset('storage/' . $applicant->photo) }}"
                                                            width="50" height="50" alt="Foto"></td>
                                                    <td>{{ $applicant->name }}</td>
                                                    <td>{{ $applicant->dob }}</td>
                                                    <td>{{ $applicant->address }}</td>
                                                    <td>{{ $applicant->education }}</td>
                                                    <td>{{ $applicant->position }}</td>
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('admin.pelamar', $applicant->id) }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.pelamar.destroyPelamar', $applicant->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete-btn"
                                                                data-id="{{ $applicant->id }}">
                                                                <i class="fas fa-trash-alt"></i> delete
                                                            </button>
                                                        </form>
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

    <!-- Modal Edit Pelamar -->
    <div class="modal fade" id="editApplicantModal" tabindex="-1" role="dialog"
        aria-labelledby="editApplicantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Form Edit -->
                <form id="editApplicantForm" method="POST"
                    action="{{ route('admin.pelamar.updatePelamar', $applicant->id ?? '') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editApplicantModalLabel">Edit Pelamar</h5>
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
                                    <label for="editApplicantPhoto" class="d-block">Foto Lama</label>
                                    <img id="editPreviewPhoto" src="{{ asset('storage/' . ($applicant->photo ?? '')) }}"
                                        alt="Foto Lama" width="100" class="img-thumbnail">
                                    <label for="editApplicantPhoto" class="d-block mt-3">Ganti Foto</label>
                                    <input type="file" class="form-control-file" id="editApplicantPhoto"
                                        name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="editApplicantName">Nama</label>
                                    <input type="text" class="form-control" id="editApplicantName" name="name"
                                        value="{{ $applicant->name ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editApplicantDob">Tempat Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="editApplicantDob" name="dob"
                                        value="{{ $applicant->dob ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editApplicantAddress">Alamat</label>
                                    <input type="text" class="form-control" id="editApplicantAddress" name="address"
                                        value="{{ $applicant->address ?? '' }}" required>
                                </div>
                            </div>

                            <!-- Pendidikan Section -->
                            <div class="col-md-4">
                                <h5><b>Pendidikan</b></h5>
                                <div class="form-group">
                                    <label for="editEducationField">Riwayat Pendidikan</label>
                                    <input type="text" class="form-control" id="editEducationField" name="education"
                                        value="{{ $applicant->education ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editInstitutionName">Nama Instansi</label>
                                    <input type="text" class="form-control" id="editInstitutionName"
                                        name="institution_name" value="{{ $applicant->institution_name ?? '' }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editEntryYear">Tahun Masuk</label>
                                    <input type="text" class="form-control" id="editEntryYear" name="entry_year"
                                        value="{{ $applicant->entry_year ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editExitYear">Tahun Keluar</label>
                                    <input type="text" class="form-control" id="editExitYear" name="exit_year"
                                        value="{{ $applicant->exit_year ?? '' }}" required>
                                </div>
                            </div>

                            <!-- Pengalaman Kerja Section -->
                            <div class="col-md-4">
                                <h5><b>Pengalaman Kerja</b></h5>
                                <div class="form-group">
                                    <label for="editJobPosition">Posisi</label>
                                    <input type="text" class="form-control" id="editJobPosition" name="position"
                                        value="{{ $applicant->position ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editCompanyName">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="editCompanyName" name="company_name"
                                        value="{{ $applicant->company_name ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editWorkEntryYear">Tahun Masuk</label>
                                    <input type="text" class="form-control" id="editWorkEntryYear"
                                        name="work_entry_year" value="{{ $applicant->work_entry_year ?? '' }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="editWorkExitYear">Tahun Keluar</label>
                                    <input type="text" class="form-control" id="editWorkExitYear"
                                        name="work_exit_year" value="{{ $applicant->work_exit_year ?? '' }}" required>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const applicantId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data ini tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form untuk menghapus
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/admin/pelamar/${applicantId}`;
                            form.innerHTML = `
                            @csrf
                            @method('DELETE')
                        `;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection