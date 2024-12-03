@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-6 mr-2 content-wrapper">
            @if(session('success_delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success_delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_edit'))
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
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addUserModal">
                                    <i class="fas fa-user-plus"></i> Add Pegawai
                                </button>
                            </div>

                            <!-- Add User Modal -->
                            <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form id="addUserForm" method="post" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">No Telpon</label>
                                                    <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" required autocomplete="new-number">
                                                    @error('number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    <i class="eye-icon bi bi-eye-slash-fill" id="togglePassword" onclick="togglePasswordVisibility()" style="position: absolute; right: 24px; top: 50%; transform: translateY(-50%);"></i>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="usertype">Role</label>
                                                    <select id="usertype" style="height:50px" class="form-control @error('usertype') is-invalid @enderror" name="usertype" required>
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
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                                                <div class="d-inline-flex align-items-center">
                                                    <!-- detail button -->
                                                    <a href="#"
                                                        class="btn btn-sm btn-outline-info view-user mr-1 mb-2"
                                                        data-toggle="modal"
                                                        data-target="#detailUserModal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-number="{{ $user->number }}"
                                                        data-usertype="{{ $user->usertype }}"
                                                        data-image="{{ $user->profile_image }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 576 512">
                                                            <path fill="#0dcaf0" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                        </svg>
                                                    </a>
                                                    <!-- Edit Button -->
                                                    <a href="#"
                                                        class="btn btn-sm btn-outline-secondary edit-user mr-1 mb-2"
                                                        data-toggle="modal"
                                                        data-target="#editUserModal"
                                                        data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-number="{{ $user->number }}"
                                                        data-usertype="{{ $user->usertype }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 640 512">
                                                            <path fill="#FFB200" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8 4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                                        </svg>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.destroy', $user->id) }}" method="POST" class="delete-form mt-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 448 512">
                                                                <path fill="#FF0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM32 128H416c17.7 0 32 14.3 32 32v320c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32zm32 32v320h352V160H64z" />
                                                            </svg>
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

            <!-- Edit User Modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
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
                                    <input id="editName" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="editEmail">Email</label>
                                    <input id="editEmail" type="email" class="form-control" name="email" required autocomplete="email">
                                </div>
                                <div class="form-group">
                                    <label for="editNumber">No Telpon</label>
                                    <input id="editNumber" type="number" class="form-control" name="number" required>
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
            <div class="modal fade" id="detailUserModal" tabindex="-1" role="dialog" aria-labelledby="detailUserModalLabel" aria-hidden="true">
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
            var actionUrl = "{{ route('admin.update', ':id') }}".replace(':id', userId);
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
                modal.find('#detailImage').html('<img src="/images/profile/' + profile_image + '" class="img-fluid" alt="Profile Image">');
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


@endsection