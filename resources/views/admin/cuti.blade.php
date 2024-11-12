@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Persetujuan Cuti Karyawan</h4>
                            <p class="card-description">
                                Daftar pengajuan cuti karyawan untuk persetujuan.
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Karyawan</th>
                                            <th>Jenis Cuti</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Berakhir</th>
                                            <th>Jumlah Hari</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Contoh data statis -->
                                        <tr>
                                            <td>John Doe</td>
                                            <td>Tahunan</td>
                                            <td>2024-12-01</td>
                                            <td>2024-12-05</td>
                                            <td>5</td>
                                            <td>Liburan keluarga</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>
                                                <button class="btn btn-success btn-sm">Setujui</button>
                                                <button class="btn btn-danger btn-sm">Tolak</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>Sakit</td>
                                            <td>2024-11-20</td>
                                            <td>2024-11-22</td>
                                            <td>3</td>
                                            <td>Sakit demam</td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>
                                                <button class="btn btn-success btn-sm">Setujui</button>
                                                <button class="btn btn-danger btn-sm">Tolak</button>
                                            </td>
                                        </tr>
                                        <!-- Tambahkan data statis lainnya jika diperlukan -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection