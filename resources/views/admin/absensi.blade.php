@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Rekap Kehadiran Karyawan</h4>
                            <p class="card-description">
                                Daftar kehadiran karyawan untuk bulan berjalan.
                            </p>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <button class="btn btn-primary me-2">&lt;</button>
                                <span class="btn btn-outline-secondary mx-3">{{ now()->format('F Y') }}</span>
                                <button class="btn btn-primary ms-2">&gt;</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Nama Karyawan</th>
                                            <th>Status Kehadiran</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kehadiran as $kehadiranItem)
                                        <tr>
                                            <td>{{ $kehadiranItem->tanggal }}</td>
                                            <td>{{ $kehadiranItem->date }}</td>
                                            <td>{{ $kehadiranItem->user->name }}</td>
                                            <td>
                                                {{ $kehadiranItem->status }}
                                            </td>
                                            <td>{{ $kehadiranItem->ket ?? '-' }}</td>
                                        </tr>
                                        @endforeach
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