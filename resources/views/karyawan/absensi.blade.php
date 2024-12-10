@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">

<div class="container-scroller">
    <div class="">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card shadow border-light">
                        <div class="card-body">
                            <h4 class="card-title text-center text-primary mb-4">Rekap Kehadiran Karyawan</h4>
                            <p class="text-center text-muted">Daftar kehadiran karyawan untuk bulan berjalan.</p>

                            <!-- Form Filter Bulan dan Tahun -->
                            <div class="d-flex justify-content-center mb-4">
                                <form method="GET" action="{{ route('karyawan.absensi') }}" class="form-inline">
                                    <label for="bulan" class="mr-2 text-muted">Bulan:</label>
                                    <select name="bulan" id="bulan" class="form-control form-control-sm mr-3" onchange="this.form.submit()">
                                        @foreach(range(1, 12) as $bulanOption)
                                            <option value="{{ $bulanOption }}" @if($bulanOption == $bulan) selected @endif>
                                                {{ \Carbon\Carbon::create()->month($bulanOption)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <label for="tahun" class="mr-2 text-muted">Tahun:</label>
                                    <select name="tahun" id="tahun" class="form-control form-control-sm" onchange="this.form.submit()">
                                        @foreach(range(now()->year - 2, now()->year) as $tahunOption)
                                            <option value="{{ $tahunOption }}" @if($tahunOption == $tahun) selected @endif>
                                                {{ $tahunOption }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>

                            <!-- Tabel Absensi -->
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Nama Karyawan</th>
                                            <th>Status Kehadiran</th>
                                            <th>Keterangan</th>
                                            <th>Bukti Izin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kehadiran as $kehadiranItem)
                                        <tr class="text-center">
                                            <td>{{ \Carbon\Carbon::parse($kehadiranItem->tanggal)->format('d F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kehadiranItem->date)->format('H:i:s') }}</td>
                                            <td>{{ $kehadiranItem->user->name }}</td>
                                            <td>
                                                <span class="badge badge-{{ $kehadiranItem->status == 'Hadir' ? 'success' : 'warning' }}">
                                                    {{ $kehadiranItem->status }}
                                                </span>
                                            </td>
                                            <td>{{ $kehadiranItem->ket ?? '-' }}</td>
                                            <td>
                                                @if ($kehadiranItem->image_path)
                                                <a href="{{ asset('storage/' . $kehadiranItem->image_path) }}" target="_blank" class="btn btn-sm btn-success">
                                                    <i class="mdi mdi-eye"></i> Lihat Bukti
                                                </a>
                                                @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Tidak ada data daftar kehadiran karyawan.</td>
                                        </tr>
                                        @endforelse
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

<!-- CSS Langsung -->
<style>
    .table-striped > tbody > tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: black;
    }

    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    h4.card-title {
        font-weight: bold;
    }

    thead.thead-light th {
        background-color: #e9ecef;
        font-weight: bold;
    }
</style>
@endsection
