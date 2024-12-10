@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Penilaian Kinerja</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addPerformanceModal">
                                    <i class="fas fa-plus"></i> Tambah Penilaian
                                </button>
                            </div>

                            <!-- Modal Tambah Penilaian -->
                            <div class="modal fade" id="addPerformanceModal" tabindex="-1" role="dialog" aria-labelledby="addPerformanceModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('karyawan.storePenilaian') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addPerformanceModalLabel">Tambah Penilaian</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tgl_nilai">Tanggal</label>
                                                            <input type="date" class="form-control" id="tgl_nilai" name="tgl_nilai" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="user_id">Nama Karyawan</label>
                                                            <select class="form-control" id="user_id" name="user_id" required>
                                                                <option value="">Pilih Karyawan</option>
                                                                @foreach($users as $user)
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="catatan">Deskripsi</label>
                                                            <textarea class="form-control" id="catatan" name="catatan" rows="3" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nilai">Penilaian</label>
                                                            <select class="form-control" id="nilai" name="nilai" required>
                                                                <option value="">Pilih Penilaian</option>
                                                                <option value="baiksekali">Baik Sekali</option>
                                                                <option value="baik">Baik</option>
                                                                <option value="cukup">Cukup</option>
                                                                <option value="kurang">Kurang</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabel Penilaian -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Penilaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($penilaians as $penilaian)
                                        <tr>
                                            <td>{{ $penilaian->tgl_nilai }}</td>
                                            <td>{{ $penilaian->user->name }}</td>
                                            <td>{{ $penilaian->catatan }}</td>
                                            <td>{{ ucfirst($penilaian->nilai) }}</td>
                                            <td>
                                                <div class="d-inline-flex align-items-center">
                                                    <!-- Tombol Edit -->
                                                    <button type="button" class="btn btn-sm btn-outline-secondary mr-1" data-toggle="modal" data-target="#editPerformanceModal{{ $penilaian->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <!-- Tombol Hapus -->
                                                    <form action="{{ route('karyawan.destroyPenilaian', $penilaian->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit Penilaian -->
                                        <div class="modal fade" id="editPerformanceModal{{ $penilaian->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ route('karyawan.updatePenilaian', $penilaian->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Penilaian</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="tgl_nilai">Tanggal</label>
                                                                        <input type="date" class="form-control" id="tgl_nilai" name="tgl_nilai" value="{{ $penilaian->tgl_nilai }}" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="user_id">Nama Karyawan</label>
                                                                        <select class="form-control" id="user_id" name="user_id" required>
                                                                            @foreach($users as $user)
                                                                            <option value="{{ $user->id }}" {{ $user->id == $penilaian->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="catatan">Deskripsi</label>
                                                                        <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $penilaian->catatan }}</textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nilai">Penilaian</label>
                                                                        <select class="form-control" id="nilai" name="nilai" required>
                                                                            <option value="baiksekali" {{ $penilaian->nilai == 'baiksekali' ? 'selected' : '' }}>Baik Sekali</option>
                                                                            <option value="baik" {{ $penilaian->nilai == 'baik' ? 'selected' : '' }}>Baik</option>
                                                                            <option value="cukup" {{ $penilaian->nilai == 'cukup' ? 'selected' : '' }}>Cukup</option>
                                                                            <option value="kurang" {{ $penilaian->nilai == 'kurang' ? 'selected' : '' }}>Kurang</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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