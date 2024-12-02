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
                                <!-- Form filter bulan dan tahun -->
                                <form method="GET" action="{{ route('admin.absensi') }}">
                                    <select name="bulan" class="form-control d-inline" style="width: 150px;" onchange="this.form.submit()">
                                        @foreach(range(1, 12) as $bulanOption)
                                        <option value="{{ $bulanOption }}" @if($bulanOption==$bulan) selected @endif>
                                            {{ \Carbon\Carbon::create()->month($bulanOption)->format('F') }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <select name="tahun" class="form-control d-inline" style="width: 120px;" onchange="this.form.submit()">
                                        @foreach(range(now()->year - 2, now()->year) as $tahunOption)
                                        <option value="{{ $tahunOption }}" @if($tahunOption==$tahun) selected @endif>
                                            {{ $tahunOption }}
                                        </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>

                            <!-- Tabel absensi -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Nama Karyawan</th>
                                            <th>Status Kehadiran</th>
                                            <th>Keterangan</th>
                                            <th>Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kehadiran as $kehadiranItem)
                                        <tr>
                                            <td>{{ $kehadiranItem->tanggal }}</td>
                                            <td>{{ $kehadiranItem->date }}</td>
                                            <td>{{ $kehadiranItem->user->name }}</td>
                                            <td>{{ $kehadiranItem->status }}</td>
                                            <td>{{ $kehadiranItem->ket ?? '-' }}</td>
                                            <td>
                                                @if ($kehadiranItem->image_path)
                                                <a href="{{ asset('storage/' . $kehadiranItem->image_path) }}"
                                                    target="_blank"
                                                    class="btn btn-sm btn-success">
                                                    Lihat Bukti
                                                </a>
                                                @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                                @endif
                                            </td>
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