@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="main-panel">
            <div class="ml-6 mr-2 content-wrapper">
                @if (session('success_delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('success_delete') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success_edit'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('success_edit') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Pegawai</h4>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addUserModal">
                                        <i class="fas fa-user-plus"></i> Add Pegawai
                                    </button>
                                </div>

                                <!-- Add User Modal -->
                                <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addUserModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form id="addUserForm" method="post" action="{{ route('owner.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') }}" required
                                                            autocomplete="name" autofocus>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required
                                                            autocomplete="email">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="number">No Telpon</label>
                                                        <input id="number" type="number"
                                                            class="form-control @error('number') is-invalid @enderror"
                                                            name="number" required autocomplete="new-number">
                                                        @error('number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group position-relative">
                                                        <label for="password">Password</label>
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" required autocomplete="new-password">
                                                        <i class="eye-icon bi bi-eye-slash-fill" id="togglePassword"
                                                            onclick="togglePasswordVisibility()"
                                                            style="position: absolute; right: 24px; top: 73%; transform: translateY(-50%); cursor: pointer;"></i>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usertype">Role</label>
                                                        <select id="usertype" style="height:50px"
                                                            class="form-control @error('usertype') is-invalid @enderror"
                                                            name="usertype" required>
                                                            <option value="">-- Select Role --</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="owner">Owner</option>
                                                            <option value="karyawan">Karyawan</option>
                                                        </select>
                                                        @error('usertype')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <!-- Users Table -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ Str::limit($user->name, 20) }}</td>
                                            <td>{{ $user->usertype }}</td>
                                            <td>{{ Str::limit($user->email, 20) }}</td>
                                            <td>{{ $user->number }}</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <!-- Detail button -->
                                                    <a href="#"
                                                        class="btn btn-sm btn-info view-user mr-2"
                                                        data-toggle="modal"
                                                        data-target="#detailUserModal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-number="{{ $user->number }}"
                                                        data-usertype="{{ $user->usertype }}"
                                                        data-image="{{ $user->profile_image }}">
                                                        Detail
                                                    </a>

                                                    <!-- Edit Button -->
                                                    <a href="#"
                                                        class="btn btn-sm btn-warning edit-user mr-2"
                                                        data-toggle="modal"
                                                        data-target="#editUserModal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-number="{{ $user->number }}"
                                                        data-usertype="{{ $user->usertype }}">
                                                        Edit
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('owner.destroy', $user->id) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                            Hapus
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

                <!-- Edit User Modal -->
                <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
                    aria-labelledby="editUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form id="editUserForm" method="POST" action="">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="editName">Name</label>
                                        <input id="editName" type="text" class="form-control" name="name"
                                            required autocomplete="name" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="editEmail">Email</label>
                                        <input id="editEmail" type="email" class="form-control" name="email"
                                            required autocomplete="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="editNumber">No Telpon</label>
                                        <input id="editNumber" type="number" class="form-control" name="number"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="editUsertype">Role</label>
                                        <select id="editUsertype" class="form-control" name="usertype" required>
                                            <option value="">-- Select Role --</option>
                                            <option value="admin">Admin</option>
                                            <option value="owner">Owner</option>
                                            <option value="karyawan">Karyawan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- detail modal -->
                <div class="modal fade" id="detailUserModal" tabindex="-1" role="dialog"
                    aria-labelledby="detailUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailUserModalLabel">Detail Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <strong>Profile</strong>
                                    </div>
                                    <div class="col-8" id="detailImage">
                                        <!-- Gambar akan ditampilkan di sini -->
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <strong>Nama</strong>
                                    </div>
                                    <div class="col-8" id="detailName"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <strong>Email</strong>
                                    </div>
                                    <div class="col-8" id="detailEmail"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <strong>No Telepon</strong>
                                    </div>
                                    <div class="col-8" id="detailNumber"></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <strong>Jabatan</strong>
                                    </div>
                                    <div class="col-8" id="detailUsertype"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Ketika modal edit akan ditampilkan
            $('#editUserModal').on('show.bs.modal', function(event) {
                // Ambil tombol yang memicu modal
                var button = $(event.relatedTarget);

                // Ambil data dari atribut data-*
                var userId = button.data('id');
                var name = button.data('name');
                var email = button.data('email');
                var number = button.data('number');
                var usertype = button.data('usertype');

                // Debug untuk memastikan data terambil
                console.log('User Data:', {
                    userId,
                    name,
                    email,
                    number,
                    usertype
                });

                // Update action URL form
                var actionUrl = "{{ route('owner.update', ':id') }}".replace(':id', userId);
                $('#editUserForm').attr('action', actionUrl);

                // Isi form dengan data user
                var modal = $(this);
                modal.find('#editName').val(name);
                modal.find('#editEmail').val(email);
                modal.find('#editNumber').val(number);
                modal.find('#editUsertype').val(usertype);

                // Debug untuk memastikan data terisi
                console.log('Form Values:', {
                    name: modal.find('#editName').val(),
                    email: modal.find('#editEmail').val(),
                    number: modal.find('#editNumber').val(),
                    usertype: modal.find('#editUsertype').val()
                });
            });

            // Tambahan: Ketika modal ditutup, reset form
            $('#editUserModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#detailUserModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var profile_image = button.data('image');
                var name = button.data('name');
                var email = button.data('email');
                var number = button.data('number');
                var usertype = button.data('usertype');

                var modal = $(this);

                // Perbaikan untuk menampilkan gambar
                if (profile_image) {
                    modal.find('#detailImage').html('<img src="/images/profile/' + profile_image +
                        '" class="img-fluid" alt="Profile Image">');
                } else {
                    modal.find('#detailImage').html('No image available');
                }

                modal.find('#detailName').text(name);
                modal.find('#detailEmail').text(email);
                modal.find('#detailNumber').text(number);
                modal.find('#detailUsertype').text(usertype);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").alert('close');
            }, 3000); // 3000 ms = 3 detik
        });
    </script>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.getElementById("togglePassword");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("bi-eye-slash-fill");
                toggleIcon.classList.add("bi-eye-fill");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("bi-eye-fill");
                toggleIcon.classList.add("bi-eye-slash-fill");
            }
        }
    </script>
@endsection
