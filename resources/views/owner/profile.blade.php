@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="">
        <div class="row">
            <!-- Konten Utama -->
            <div class="col-lg-12"> <!-- Menggunakan offset untuk menyelaraskan dengan sidebar -->

                <!-- Admin Information and Profile Update Form -->
                <div class="row">
                    <!-- Admin Information -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Account Information</h4>
                                <p><strong>Name:</strong> John Doe</p>
                                <p><strong>Email:</strong> johndoe@example.com</p>
                                <p><strong>Bio:</strong> Lorem ipsum dolor sit amet.</p>
                                <p><strong>Picture:</strong> <img src="profile.jpg" alt="Profile Picture"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Update Form -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Profile</h4>
                                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" value="John Doe" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input disabled type="email" id="email" name="email" class="form-control" value="johndoe@example.com" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea id="bio" name="bio" class="form-control">Lorem ipsum dolor sit amet.</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="picture">Profile Picture</label>
                                        <input type="file" id="picture" name="picture" class="form-control-file">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->

@endsection