@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-6 mr-2 content-wrapper">
            @if(session('success_restore'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success_restore') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_permanent'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success_permanent') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">History Pegawai </h4>
                            </div>

                            <!-- Users Table -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ Str::limit($user->name, 20) }}</td>
                                            <td>{{ $user->usertype }}</td>
                                            <td>{{ Str::limit($user->email, 20) }}</td>
                                            <td>{{ $user->number }}</td>
                                            <td>
                                                <!-- Jika User Sudah Dihapus Secara Soft Delete -->
                                                @if($user->trashed())
                                                <div class="d-flex justify-content-start">
                                                    <!-- Pulihkan Button -->
                                                    <form action="{{ route('owner.restore', $user->id) }}" method="POST" class="restore-form mt-2 mr-2" onsubmit="return confirm('Apakah Anda yakin ingin memulihkan user ini?');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-success btn-sm" style="font-size: 10px;">Pulihkan</button>
                                                    </form>

                                                    <!-- Hapus Permanen Button (Hard Delete) -->
                                                    <form action="{{ route('owner.hardDestroy', $user->id) }}" method="POST" class="delete-form mt-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen user ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" style="font-size: 10px;">Hapus</button>
                                                    </form>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Jika Tidak Ada Data -->
                            @if ($users->isEmpty())
                            <div class="text-center mt-3">
                                <p class="text-muted">Tidak ada data history pegawai</p>
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