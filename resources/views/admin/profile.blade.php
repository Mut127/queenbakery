@extends('layouts.app')

@section('content')

<!-- partial:partials/_navbar.html -->

<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_settings-panel.html -->

    <!-- partial -->

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="content-wrapper">
                <div class="row">
                    <!-- Admin Information -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Admin Information</h4>
                                <p><strong>Name:</strong> </p>
                                <p><strong>Email:</strong> </p>
                                <p><strong>Bio:</strong></p>
                                <p><strong>Picture:</strong></p>


                            </div>
                        </div>
                    </div>

                    <!-- Profile Update Form -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Profile</h4>
                                <form action="{{ route('admin.profile.update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input disabled type="email" id="email" name="email"
                                            class="form-control" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea id="bio" name="bio"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="picture">Profile Picture</label>
                                        <input type="file" id="picture" name="picture"
                                            class="form-control-file">
                                    </div>
                                    <!-- Add more fields (image upload, etc.) as needed -->

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

<!-- container-scroller -->

@endsection