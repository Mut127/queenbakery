@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="">
        <div class="ml-2 mr-2 content-wrapper">
            <!-- Success/Error Message Display -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('success_delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if(session('success_edit'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('success_edit') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penilaian Kinerja</h4>

                            <!-- Form Penilaian Kinerja -->
                            <form id="penilaianForm" method="POST" action="{{ route('owner.storePenilaian') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">Pilih Pegawai</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">-- Pilih Pegawai --</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_nilai">Tanggal Penilaian</label>
                                    <input type="date" name="tgl_nilai" id="tgl_nilai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea name="catatan" id="catatan" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Penilaian</label>
                                    <select name="nilai" id="nilai" class="form-control" required>
                                        <option value="">-- Pilih Penilaian --</option>
                                        <option value="baiksekali">Baik Sekali</option>
                                        <option value="baik">Baik</option>
                                        <option value="cukup">Cukup</option>
                                        <option value="kurang">Kurang</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                            <!-- Tabel Penilaian -->
                            <table class="table table-striped mt-4">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Pegawai</th>
                                        <th>Catatan</th>
                                        <th>Penilaian</th>
                                        <th>Aksi</th>
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
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-user mr-1"
                                                data-id="{{ $kinerja->id }}"
                                                data-name="{{ $kinerja->user->name }}"
                                                data-catatan="{{ $kinerja->catatan }}"
                                                data-nilai="{{ $kinerja->nilai }}"
                                                data-toggle="modal"
                                                data-target="#editNilaiModal">
                                                Edit
                                            </button>
                                            <form action="{{ route('owner.destroyPenilaian', $kinerja->id) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm  mr-1" onclick="confirmDelete(this)">
                                                    Hapus
                                                </button>
                                            </form>

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

<!-- Edit User Modal -->
<div class="modal fade" id="editNilaiModal" tabindex="-1" role="dialog" aria-labelledby="editNilaiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editNilaiForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editNilaiModalLabel">Edit Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input id="editName" type="text" class="form-control" name="name" required autocomplete="name" autofocus readonly>
                    </div>
                    <div class="form-group">
                        <label for="editCatatan">Catatan</label>
                        <textarea class="form-control" name="catatan" id="editCatatan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ediNilai">Nilai</label>
                        <select id="ediNilai" class="form-control" name="nilai" required>
                            <option value="">-- Select Nilai --</option>
                            <option value="baiksekali">Baik Sekali</option>
                            <option value="baik">Baik</option>
                            <option value="cukup">Cukup</option>
                            <option value="buruk">Buruk</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Ketika modal edit akan ditampilkan
        $('#editNilaiModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            var userId = button.data('id');
            var name = button.data('name'); // Ambil nama dari atribut data-name
            var catatan = button.data('catatan');
            var nilai = button.data('nilai');

            // Update form action
            var actionUrl = "{{ route('owner.updatePenilaian', ':id') }}".replace(':id', userId);
            $('#editNilaiForm').attr('action', actionUrl);

            // Isi form dengan data
            var modal = $(this);
            modal.find('#editName').val(name);
            modal.find('#editCatatan').val(catatan);
            modal.find('#editNilai').val(nilai);
        });

    });
</script>
<script>
    function confirmDelete(button) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // Submit form jika user setuju
            button.closest('form').submit();
        }
    }
</script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").alert('close');
        }, 3000); // 3000 ms = 3 detik
    });
</script>