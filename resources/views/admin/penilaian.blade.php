@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Penilaian Kinerja</h4>

                            <!-- Form Penilaian Kinerja -->
                            <form id="penilaianForm" method="POST" action="{{ route('admin.storePenilaian') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="user_id">Pilih Pegawai</label>
                                    <select name="user_id" class="form-control" required>
                                        <option value="">-- Pilih Pegawai --</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_nilai">Tanggal Penilaian</label>
                                    <input type="date" name="tgl_nilai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea name="catatan" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Penilaian</label>
                                    <select name="nilai" class="form-control @error('nilai') is-invalid @enderror" required>
                                        <option value="">-- Pilih Penilaian --</option>
                                        <option value="baiksekali">Baik Sekali</option>
                                        <option value="baik">Baik</option>
                                        <option value="cukup">Cukup</option>
                                        <option value="kurang">Kurang</option>
                                    </select>
                                    @error('nilai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
                                        <td>{{ $kinerja->nilai }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-secondary edit-btn"
                                                data-id="{{ $kinerja->id }}"
                                                data-toggle="modal"
                                                data-target="#editModal">Edit</button>
                                            <form action="{{ route('admin.destroyPenilaian', $kinerja->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
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

<!-- Modal Edit Penilaian -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Penilaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editPenilaianForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_catatan">Catatan</label>
                        <textarea name="catatan" id="edit_catatan" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_nilai">Penilaian</label>
                        <select name="nilai" id="edit_nilai" class="form-control" required>
                            <option value="baiksekali">Baik Sekali</option>
                            <option value="baik">Baik</option>
                            <option value="cukup">Cukup</option>
                            <option value="kurang">Kurang</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle Edit Button Click
        $('.edit-btn').on('click', function() {
            var kinerjaId = $(this).data('id');

            // AJAX to retrieve the existing record details
            $.ajax({
                url: '{{ route("admin.editPenilaian", ":id") }}'.replace(':id', kinerjaId),
                method: 'GET',
                success: function(response) {
                    // Fill the modal fields with the retrieved data
                    $('#edit_catatan').val(response.catatan);
                    $('#edit_nilai').val(response.nilai);

                    // Update the form's action URL dynamically
                    $('#editPenilaianForm').attr(
                        'action',
                        '{{ route("admin.updatePenilaian", ":id") }}'.replace(':id', kinerjaId)
                    );
                },
                error: function(xhr) {
                    alert('Gagal mengambil data. Silakan coba lagi.');
                }
            });
        });

        // Handle Edit Form Submission via AJAX
        $('#editPenilaianForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission behavior

            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Notify the user and refresh the page to reflect changes
                    alert(response.message || 'Data berhasil diperbarui.');
                    location.reload();
                },
                error: function(xhr) {
                    // Provide detailed error messages
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = Object.values(errors).join("\n");
                        alert('Error: ' + errorMessage);
                    } else {
                        alert('Gagal memperbarui data. Silakan coba lagi.');
                    }
                }
            });
        });
    });
</script>

@endpush