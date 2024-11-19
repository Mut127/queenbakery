@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="main-panel">
        <div class="row">
            <!-- Konten Utama -->
            <div class="col-lg-12">

                <!-- Admin Information and Profile Update Form -->
                <div class="row">
                    <!-- Admin Information -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Admin Information</h4>
                                <!-- Menampilkan data pengguna yang sedang login -->
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                                <p><strong>No Telepon:</strong> {{ Auth::user()->number }}</p>
                                <p><strong>Jabatan:</strong> {{ Auth::user()->usertype}}</p>
                                <p><strong>Picture:</strong>
                                    @if (Auth::user()->profile_picture)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" width="100">
                                    @else
                                    <img src="default-profile.jpg" alt="Default Profile Picture" width="100">
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Update Form -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Profile</h4>
                                <!-- Form untuk mengupdate profil pengguna -->
                                <form action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') <!-- Untuk method PUT saat update -->

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input disabled type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="number">No Telepon</label>
                                        <input type="number" id="number" name="number" class="form-control" value="{{ Auth::user()->number }}" required>
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