@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            @if(session('success_delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success_delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_reject'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success_reject') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_save'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success_save') }}
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
                                            <th>Aksi</th>
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
                                                @if($cutiItem->status == 'Pending')
                                                <form action="{{ route('owner.cuti.approve', $cutiItem->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-success btn-sm" style="font-size: 10px;">Setujui</button>
                                                </form>
                                                <form action="{{ route('owner.cuti.reject', $cutiItem->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-danger btn-sm" style="font-size: 10px;">Tolak</button>
                                                </form>
                                                @else
                                                <button class="btn btn-success btn-sm" disabled style="font-size: 10px;">Setujui</button>
                                                <button class="btn btn-danger btn-sm" disabled style="font-size: 10px;">Tolak</button>
                                                @endif
                                                <form action="{{ route('owner.cuti.destroy', $cutiItem->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" style="font-size: 10px;" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')">Hapus</button>
                                                </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 3000); // 3000 ms = 3 detik
    });
</script>