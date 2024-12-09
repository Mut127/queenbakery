@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            @if(session('success_cancel'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success_cancel') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_request'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success_request') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Persetujuan Cuti Karyawan</h4>
                            <p class="card-description">
                                Daftar pengajuan cuti karyawan untuk persetujuan.
                            </p>
                            <div class="table-responsive" style="max-width: 100%; overflow-x: auto;">
                                <table class="table table-striped table-sm" style="width: 100%; max-width: 800px; margin: auto;">
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
                            <!-- Jika Tidak Ada Data -->
                            @if ($cuti->isEmpty())
                            <div class="text-center mt-3">
                                <p class="text-muted">Tidak ada data persetujuan cuti</p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 3000); // 3000 ms = 3 detik
    });
</script>