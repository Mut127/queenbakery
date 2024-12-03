@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
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
                                            <button class="btn btn-sm btn-outline-secondary edit-btn mr-2"
                                                data-id="{{ $kinerja->id }}"
                                                data-name="{{ $kinerja->user->name }}"
                                                data-catatan="{{ $kinerja->catatan }}"
                                                data-nilai="{{ $kinerja->nilai }}"
                                                data-toggle="modal"
                                                data-target="#editNilaiModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 640 512">
                                                    <path fill="#FFB200" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8 4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                                </svg>
                                            </button>
                                            <form action="{{ route('owner.destroyPenilaian', $kinerja->id) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-btn" onclick="confirmDelete(this)">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="25" viewBox="0 0 448 512">
                                                        <path fill="#FF0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM32 128H416c17.7 0 32 14.3 32 32v320c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32zm32 32v320h352V160H64z" />
                                                    </svg>
                                                </button>
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