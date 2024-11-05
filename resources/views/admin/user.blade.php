@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->


    <!-- partial -->


    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
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
                                        <form id="addUserForm" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control" id="userName" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="userEmail">Email</label>
                                                    <input type="email" class="form-control" id="userEmail" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="userRole">Role</label>
                                                    <select class="form-control" id="userRole" name="role" required>
                                                        <option value="">Select Role</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Editor">Editor</option>
                                                        <option value="Viewer">Viewer</option>
                                                        <!-- Add more options as needed -->
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="userPicture">Profile Picture</label>
                                                    <input type="file" class="form-control-file" id="userPicture" name="picture">
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
                                            <th>Profile Picture</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td class="py-1">

                                                <img src="" alt="Profile Picture" class="img-fluid rounded" style="max-width: 50px; height: auto;">

                                            </td>

                                            <td>nama</td>
                                            <td>email</td>
                                            <td>
                                                <span class="badge">
                                                    role
                                                </span>
                                            </td>
                                            <td>date</td>
                                            <td>
                                                <div class="d-inline-flex align-items-center">
                                                    <!-- Edit Button -->
                                                    <a href="#" class="btn btn-sm btn-outline-secondary edit-user mr-1 mb-2" data-toggle="modal" data-target="#editUserModal" data-id="">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="" method="POST" class="delete-form mt-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                        </tr>

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