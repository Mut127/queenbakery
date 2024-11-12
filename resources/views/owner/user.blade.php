@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-6 mr-2 content-wrapper">
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
                                        <form id="addUserForm" method="post" action="{{ route('sesi.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="userName">Name</label>
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="userEmail">Email</label>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="userNumber">No Telpon</label>
                                                    <input id="number" type="number" class="form-control @error('number') is-invalid @enderror" name="number" required autocomplete="new-number">

                                                    @error('number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="userPassword">Password</label>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    <i class="eye-icon bi bi-eye-slash-fill" id="togglePassword" onclick="togglePasswordVisibility()" style="position: absolute; right: 24px; top: 50%; transform: translateY(-50%);"></i>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>

                                                    @enderror

                                                </div>
                                                <div class="form-group">
                                                    <label for="userRole">Role</label>
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
                                            <td>{{ $user->usertpe }}</td>
                                            <td>{{ Str::limit($user->email, 20) }}</td>
                                            <td>{{ $user->number }}</td>
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
                                        @endforeach

                                        <!-- Edit User Modal -->
                                        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="editUserForm" action="" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="">
                                                            <div class="form-group">
                                                                <label for="editUserName">Name</label>
                                                                <input type="text" class="form-control" id="editUserName" name="name" value="" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editUserEmail">Email</label>
                                                                <input type="email" class="form-control" id="editUserEmail" name="email" value="" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editUserRole">Role</label>
                                                                <select class="form-control" id="editUserRole" name="role" required>
                                                                    <option value="Admin">Admin</option>
                                                                    <option value="Editor">Editor</option>
                                                                    <option value="Viewer">Viewer</option>
                                                                    <!-- Add more options as needed -->
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editUserPicture">Profile Picture</label>
                                                                <input type="file" class="form-control-file" id="editUserPicture" name="picture">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
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

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

@endsection