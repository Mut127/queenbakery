@extends('layouts.app')
@section('content')
<div class="container-fluid p-4">
    <!-- Full-screen Dashboard -->
    <div class="main-panel">
        <!-- Welcome Banner -->
        <div class="row">
            <div class="col-12">
                <div class="jumbotron text-center bg-primary text-white p-5 rounded-lg shadow-sm">
                    <h1 class="display-4">Welcome, {{ Auth::user()->name }}!</h1>
                    <hr class="my-4 border-light">
                    <p>Baking Your Day Brighter!</p>
                </div>
            </div>
        </div>

        <!-- Informasi Toko, Lokasi Toko, dan Jumlah Pegawai -->
        <div class="row mt-4">
            <!-- Informasi Toko -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-lg rounded-lg border-0 h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-4">Visi</h4>

                        <!-- Visi Text -->
                        <p class="h5"><strong></strong> Menjadi toko roti terkemuka yang dikenal dengan kualitas terbaik, </p>
                        <p class="h5"><strong></strong> inovasi rasa, dan pelayanan yang ramah, </p>
                        <p class="h5"><strong></strong> untuk memberikan kebahagiaan dan kehangatan di setiap produk yang kami buat.</p>
                        <br>
                        <h4 class="card-title mb-4">Misi</h4>
                        <p class="h5"><strong></strong> Menawarkan produk roti dan kue berkualitas tinggi dengan bahan-bahan pilihan, aman, dan sehat.</p>
                        <p class="h5"><strong></strong> Selalu berinovasi dengan menghadirkan varian produk yang menarik dan sesuai dengan selera pelanggan. </p>
                        <p class="h5"><strong></strong> Menjadi bagian dari komunitas dengan mendukung kegiatan sosial dan lingkungan sekitar</p>
                    </div>
                </div>

            </div>

            <!-- Lokasi Toko -->
            <div class="col-lg-4 mb-4 d-flex flex-column">
                <div class="card shadow-lg rounded-lg border-0 mb-4 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <h4 class="card-title mb-4"><i class="fas fa-users fa-2x text-primary"></i> Jumlah Pegawai</h4>
                        <p class="h1 text-primary font-weight-bold">
                            {{ \App\Models\User::count() }}
                        </p>
                        <p class="h5">Pegawai Aktif</p>
                    </div>
                </div>

                <div class="card shadow-lg rounded-lg border-0 h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-4">Jam kerja</h4>
                        <p class="h5"><strong>Hari:</strong> Senin - Minggu</p>
                        <p class="h5"><strong>Waktu:</strong> 07.30 - 21.00 WIB</p>
                    </div>
                </div>


            </div>


            <!-- Jumlah Pegawai (Positioned below Informasi Toko and Lokasi Toko) -->
            <div class="col-lg-4 mb-4 d-flex flex-column">

                <!-- Additional Content or Box for more details if needed -->
                <div class="card shadow-lg rounded-lg border-0 h-100">
                    <div class="card-body p-0">
                        <h4 class="card-title text-center py-3">
                            <i class="fas fa-map-marked-alt fa-2x text-primary"></i> Lokasi Toko
                        </h4>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.6645384671524!2d109.35243547365727!3d-7.39143567276469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6558355325bf75%3A0x1a86b1abf68edabd!2sQueen%20Bakery%20Purbalingga!5e0!3m2!1sen!2sus!4v1733233140108!5m2!1sen!2sus"
                                width="400" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection