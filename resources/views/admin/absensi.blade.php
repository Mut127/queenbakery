@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Konten Utama -->
        <main class="flex-fill">
            <div class="body-content">
                <h4 class="text-center mt-4">Rekap Kehadiran</h4>
                <div class="d-flex align-items-center justify-content-center mb-3">
                    <button class="btn btn-primary me-2">&lt;</button>
                    <span class="btn btn-outline-secondary mx-3">Oktober</span>
                    <button class="btn btn-primary ms-2">&gt;</button>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped">
                        <thead class="thead-light"> <!-- Mengganti kelas thead-dark menjadi thead-light -->
                            <tr>
                                <th class="bg-white">Tanggal</th> <!-- Menambahkan kelas bg-white -->
                                <th class="bg-white">Nama</th> <!-- Menambahkan kelas bg-white -->
                                <th class="bg-white">Status</th> <!-- Menambahkan kelas bg-white -->
                                <th class="bg-white">Keterangan</th> <!-- Menambahkan kelas bg-white -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1/10/2024</td>
                                <td>Muthia Khanza</td>
                                <td><span class="badge bg-success">Hadir</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2/10/2024</td>
                                <td>Muthia Khanza</td>
                                <td><span class="badge bg-warning text-dark">Izin</span></td>
                                <td>Sakit</td>
                            </tr>
                            <tr>
                                <td>3/10/2024</td>
                                <td>Muthia Khanza</td>
                                <td><span class="badge bg-success">Hadir</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4/10/2024</td>
                                <td>Muthia Khanza</td>
                                <td><span class="badge bg-success">Hadir</span></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5/10/2024</td>
                                <td>Muthia Khanza</td>
                                <td><a href="{{ route('admin.kehadiran') }}" class="text-primary">Kehadiran</a></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection