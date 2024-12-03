@extends('layouts.app')
@section('content')
    <div class="container-fluid p-4">
        <!-- Full-screen Dashboard -->
        <div class="main-panel">
            <div class="row">
                <div class="col-12">
                    <!-- Welcome Banner -->
                    <div class="jumbotron text-center bg-primary text-white p-4 rounded-lg shadow-sm">
                        <h1 class="display-4">Selamat Datang, {{ Auth::user()->name }}</h1>
                        <p class="lead">di Queen Bakery</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Toko dan Lokasi Toko -->
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg rounded-lg border-0 d-flex flex-column" style="height: 100%">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                            <h4 class="card-title mb-4"><i class="fas fa-store fa-2x text-primary"></i> Informasi Toko</h4>
                            <p class="h5"><strong>Nama Toko:</strong> Queen Bakery</p>
                            <p class="h5"><strong>Alamat:</strong> Jl. Ahmad Yani No.32-34</p>
                            <p class="h5"><strong>Email:</strong> 
                            <a href="mailto:queenbakery@gmail.com" class="text-decoration-none text-dark">queenbakery@gmail.com</a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg rounded-lg border-0 d-flex flex-column" style="height: 100%">
                        <div class="card-body p-0">
                            <h4 class="card-title text-center py-3">
                                <i class="fas fa-map-marked-alt fa-2x text-primary"></i> Lokasi Toko
                            </h4>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.6645384671524!2d109.35243547365727!3d-7.39143567276469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6558355325bf75%3A0x1a86b1abf68edabd!2sQueen%20Bakery%20Purbalingga!5e0!3m2!1sen!2sus!4v1733233140108!5m2!1sen!2sus" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection