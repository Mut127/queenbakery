@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card shadow-sm border-light">
                        <div class="card-body">
                            <h4 class="card-title mb-3 text-center">Rekap Kehadiran Karyawan</h4>
                            <p class="card-description text-center text-muted">
                                Daftar kehadiran karyawan untuk bulan berjalan.
                            </p>

                            <!-- Form filter bulan dan tahun -->
                            <div class="d-flex justify-content-center mb-4">
                                <form method="GET" action="{{ route('owner.absensi') }}" class="d-flex align-items-center">
                                    <select name="bulan" class="form-control form-control-sm mr-2" style="width: 150px;" onchange="this.form.submit()">
                                        @foreach(range(1, 12) as $bulanOption)
                                        <option value="{{ $bulanOption }}" @if($bulanOption==$bulan) selected @endif>
                                            {{ \Carbon\Carbon::create()->month($bulanOption)->format('F') }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <select name="tahun" class="form-control form-control-sm" style="width: 120px;" onchange="this.form.submit()">
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
                                <table class="table table-hover table-bordered table-striped">
                                    <thead class="thead-light">
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
                                        @foreach($kehadiran as $kehadiranItem)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($kehadiranItem->tanggal)->timezone('Asia/Jakarta')->format('d F Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kehadiranItem->date)->timezone('Asia/Jakarta')->format('H:i:s') }}</td>
                                            <td>{{ $kehadiranItem->user->name }}</td>
                                            <td>{{ $kehadiranItem->status }}</td>
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
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                             <!-- Jika Tidak Ada Data -->
                             @if ($kehadiran->isEmpty())
                             <div class="text-center mt-3">
                                 <p class="text-muted">Tidak ada data daftar kehadiran karyawan</p>
                             </div>
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection