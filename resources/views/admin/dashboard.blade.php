@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="main-panel">
        <div class="row">
            <!-- Dashboard Utama -->
            <div class="col-lg-12"> <!-- Menggunakan offset untuk menyelaraskan dengan sidebar -->

                <!-- Toko dan Statistik Penjualan -->
                <div class="row">
                    <!-- Informasi Toko -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Informasi Toko</h4>
                                <p><strong>Nama Toko:</strong> Queen Bakery</p>
                                <p><strong>Alamat:</strong> Jl. Ahmad Yani No.32-34, Purbalingga</p>
                                <p><strong>Email:</strong> queenbakery@gmail.com</p>
                                <p><strong>Logo:</strong> <img src="logo.jpg" alt="Queen Bakery" width="100"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Penjualan -->
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Statistik Penjualan</h4>
                                <p><strong>Penjualan Bulan Ini:</strong> Rp 50,000,000</p>
                                <p><strong>Pesanan Baru:</strong> 25</p>
                                <p><strong>Produk Terlaris:</strong> Roti Coklat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Produk -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daftar Produk</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Roti Coklat</td>
                                            <td>Roti</td>
                                            <td>Rp 10,000</td>
                                            <td>50</td>
                                            <td><a href="#" class="btn btn-primary btn-sm">Edit</a></td>
                                        </tr>
                                        <tr>
                                            <td>Kue Keju</td>
                                            <td>Kue</td>
                                            <td>Rp 20,000</td>
                                            <td>30</td>
                                            <td><a href="#" class="btn btn-primary btn-sm">Edit</a></td>
                                        </tr>
                                        <!-- Tambahkan produk lain sesuai kebutuhan -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifikasi Pesanan -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Notifikasi Pesanan Terbaru</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">Pesanan #1234 oleh Budi - Roti Tawar, 2 pcs</li>
                                    <li class="list-group-item">Pesanan #1235 oleh Siti - Kue Keju, 1 pcs</li>
                                    <li class="list-group-item">Pesanan #1236 oleh Andi - Roti Coklat, 3 pcs</li>
                                    <!-- Tambahkan notifikasi lain sesuai kebutuhan -->
                                </ul>
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