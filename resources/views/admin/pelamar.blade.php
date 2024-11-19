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
                                                        <button class="btn btn-sm btn-outline-secondary"
                                                            data-toggle="modal" data-target="#editApplicantModal"
                                                            data-id="{{ $applicant->id }}"
                                                            data-name="{{ $applicant->name }}"
                                                            data-dob="{{ $applicant->dob }}"
                                                            data-address="{{ $applicant->address }}"
                                                            data-education="{{ $applicant->education }}"
                                                            data-position="{{ $applicant->position }}"
                                                            data-photo="{{ $applicant->photo }}">
                                                            <i class="fas fa-pencil-alt"></i>Edit
                                                        </button>

                                                        <!-- Delete Button -->
                                                        <form
                                                            action="{{ route('admin.pelamar.destroyPelamar', $applicant->id) }}"
                                                            method="POST" class="delete-form mt-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-outline-danger mr-1 mb-2">
                                                                <i class="fas fa-trash-alt"></i>Delete
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
                <!-- Form ini diubah menjadi generic karena data akan diisi menggunakan JavaScript -->
                <form id="editApplicantForm" method="POST" action="">
                    @method('PUT')
                    @csrf
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
                                    <label for="editApplicantPhoto" class="d-block">Foto</label>
                                    <input type="file" class="form-control-file" id="editApplicantPhoto"
                                        name="photo">
                                </div>
                                <div class="form-group">
                                    <label for="editApplicantName">Nama</label>
                                    <input type="text" class="form-control" id="editApplicantName" name="name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editApplicantDob">Tempat Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="editApplicantDob" name="dob"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editApplicantAddress">Alamat</label>
                                    <input type="text" class="form-control" id="editApplicantAddress" name="address"
                                        required>
                                </div>
                            </div>

                            <!-- Pendidikan Section -->
                            <div class="col-md-4">
                                <h5><b>Pendidikan</b></h5>
                                <div class="form-group">
                                    <label for="editEducationField">Riwayat Pendidikan</label>
                                    <input type="text" class="form-control" id="editEducationField" name="education"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editInstitutionName">Nama Instansi</label>
                                    <input type="text" class="form-control" id="editInstitutionName"
                                        name="institution_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="editEntryYear">Tahun Masuk</label>
                                    <input type="text" class="form-control" id="editEntryYear" name="entry_year"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editExitYear">Tahun Keluar</label>
                                    <input type="text" class="form-control" id="editExitYear" name="exit_year"
                                        required>
                                </div>
                            </div>

                            <!-- Pengalaman Kerja Section -->
                            <div class="col-md-4">
                                <h5><b>Pengalaman Kerja</b></h5>
                                <div class="form-group">
                                    <label for="editJobPosition">Posisi</label>
                                    <input type="text" class="form-control" id="editJobPosition" name="position"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editCompanyName">Nama Perusahaan</label>
                                    <input type="text" class="form-control" id="editCompanyName" name="company_name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="editWorkEntryYear">Tahun Masuk</label>
                                    <input type="text" class="form-control" id="editWorkEntryYear"
                                        name="work_entry_year" required>
                                </div>
                                <div class="form-group">
                                    <label for="editWorkExitYear">Tahun Keluar</label>
                                    <input type="text" class="form-control" id="editWorkExitYear"
                                        name="work_exit_year" required>
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
    <script>
        $('#editApplicantModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var id = button.data('id'); // Mengambil ID dari data-id
            var name = button.data('name');
            var dob = button.data('dob');
            var address = button.data('address');
            var education = button.data('education');
            var position = button.data('position');
            var photo = button.data('photo');

            var modal = $(this);

            // Isi form dengan data pelamar
            modal.find('#editApplicantName').val(name);
            modal.find('#editApplicantDob').val(dob);
            modal.find('#editApplicantAddress').val(address);
            modal.find('#editEducationField').val(education);
            modal.find('#editJobPosition').val(position);
            modal.find('#editApplicantPhoto').val(photo); // Anda bisa menyesuaikan foto jika diperlukan

            // Update action form dengan ID yang sesuai
            modal.find('#editApplicantForm').attr('action', '/admin/pelamar/' +
            id); // Sesuaikan URL dengan ID pelamar
        });
    </script>
@endsection