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
                                            <th>Aksi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cuti as $cutiItem)
                                        <tr>
                                            <td>{{ $cutiItem->user->name }}</td>
                                            <td>{{ $cutiItem->jenis }}</td>
                                            <td>{{ $cutiItem->tgl_awal }}</td>
                                            <td>{{ $cutiItem->tgl_akhir }}</td>
                                            <td>{{ $cutiItem->jml_cuti }}</td>
                                            <td>{{ $cutiItem->ket }}</td>
                                            <td>
                                                @if($cutiItem->status == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                                @elseif($cutiItem->status == 'Disetujui')
                                                <span class="badge badge-success">Disetujui</span>
                                                @elseif($cutiItem->status == 'Ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($cutiItem->trashed()) <!-- Jika data sudah dihapus (soft delete) -->
                                                <form action="{{ route('cuti.restore', $cutiItem->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">Aktifkan</button>
                                                </form>
                                                @else <!-- Jika data belum dihapus -->
                                                @if($cutiItem->status == 'Pending') <!-- Hanya muncul untuk status Pending -->
                                                <form action="{{ route('cuti.cancel', $cutiItem->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button class="btn btn-warning btn-sm">Batalkan</button>
                                                </form>
                                                @endif
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