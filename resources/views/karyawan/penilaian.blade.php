@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="">
        <div class="ml-2 mr-2 content-wrapper">


            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penilaian Kinerja</h4>

                            <!-- Tabel Penilaian -->
                            <table class="table table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Pegawai</th>
                                        <th>Catatan</th>
                                        <th>Penilaian</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kinerjas as $kinerja)
                                    <tr>
                                        <td>{{ $kinerja->tgl_nilai }}</td>
                                        <td>{{ $kinerja->user->name }}</td>
                                        <td>{{ $kinerja->catatan }}</td>
                                        <td>
                                            @if($kinerja->nilai == 'baiksekali')
                                            Baik Sekali
                                            @elseif($kinerja->nilai == 'baik')
                                            Baik
                                            @elseif($kinerja->nilai == 'cukup')
                                            Cukup
                                            @elseif($kinerja->nilai == 'buruk')
                                            Buruk
                                            @else
                                            -
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             <!-- Jika Tidak Ada Data -->
                            @if ($kinerjas->isEmpty())
                            <div class="text-center mt-3">
                                <p class="text-muted">Tidak ada data penilaian kinerja</p>
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