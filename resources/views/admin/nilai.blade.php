@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="">
            <div class="ml-6 mr-2 content-wrapper" style="background-color: transparent;">
                <div class="row">
                    <div class="col-lg-28 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Kelola Nilai</h4>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addNilaiModal">
                                        <i class="fas fa-plus"></i> Add Nilai
                                    </button>
                                </div>

                                <!-- Modal Tambah -->
                                <div class="modal fade" id="addNilaiModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addNilaiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('admin.nilai.storeNilai') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addNilaiModalLabel">Add Nilai</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="namaPelamar">Nama Pelamar</label>
                                                        <input id="namaPelamar" type="text"
                                                            class="form-control @error('namaPelamar') is-invalid @enderror"
                                                            name="nama_pelamar" value="{{ old('namaPelamar') }}" required>
                                                        @error('namaPelamar')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilaiTes">Nilai Tes</label>
                                                        <input id="nilaiTes" type="number"
                                                            class="form-control @error('nilaiTes') is-invalid @enderror"
                                                            name="nilai_tes" value="{{ old('nilaiTes') }}" required>
                                                        @error('nilaiTes')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilaiWawancara">Nilai Wawancara</label>
                                                        <input id="nilaiWawancara" type="number"
                                                            class="form-control @error('nilai_wawancara') is-invalid @enderror"
                                                            name="nilai_wawancara" value="{{ old('nilai_wawancara') }}"
                                                            required>
                                                        @error('nilai_wawancara')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="hasilKeputusan">Hasil Keputusan</label>
                                                        <select id="hasilKeputusan"
                                                            class="form-control @error('hasil_keputusan') is-invalid @enderror"
                                                            name="hasil_keputusan" required>
                                                            <option value="Diterima"
                                                                {{ old('hasil_keputusan') == 'Diterima' ? 'selected' : '' }}>
                                                                Diterima</option>
                                                            <option value="Ditolak"
                                                                {{ old('hasil_keputusan') == 'Ditolak' ? 'selected' : '' }}>
                                                                Ditolak</option>
                                                        </select>
                                                        @error('hasil_keputusan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Nilai</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tabel Nilai -->
                                <div class="table-responsive">
                                    <table id="nilaiTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Pelamar</th>
                                                <th>Nilai Tes</th>
                                                <th>Nilai Wawancara</th>
                                                <th>Hasil Keputusan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($nilai as $item)
                                                <tr id="row-{{ $item->id }}">
                                                    <td>{{ $item->nama_pelamar }}</td>
                                                    <td>{{ $item->nilai_tes }}</td>
                                                    <td>{{ $item->nilai_wawancara }}</td>
                                                    <td>{{ $item->hasil_keputusan }}</td>
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary edit-nilai mr-2"
                                                            data-id="{{ $item->id }}"
                                                            data-nama="{{ $item->nama_pelamar }}"
                                                            data-tes="{{ $item->nilai_tes }}"
                                                            data-wawancara="{{ $item->nilai_wawancara }}"
                                                            data-hasil="{{ $item->hasil_keputusan }}" data-toggle="modal"
                                                            data-target="#editNilaiModal">
                                                            <i class="fas fa-edit"></i>
                                                            <svg xmlns="http://www.w3.org/2000/svg" height="20"
                                                                width="25" viewBox="0 0 640 512">
                                                                <path fill="#FFB200"
                                                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8 4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                                            </svg>
                                                        </button>
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admin.nilai.destroyNilai', $item->id) }}"
                                                            method="POST" class="delete-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-danger delete-btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20"
                                                                    width="25" viewBox="0 0 448 512">
                                                                    <path fill="#FF0000"
                                                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM32 128H416c17.7 0 32 14.3 32 32v320c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32zm32 32v320h352V160H64z" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Jika Tidak Ada Data -->
                                @if ($nilai->isEmpty())
                                    <div class="text-center mt-3">
                                        <p class="text-muted">Belum ada data nilai.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Nilai Modal -->
    <div class="modal fade" id="editNilaiModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editNilaiForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editNilaiModalLabel">Edit Nilai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editNamaPelamar">Nama Pelamar</label>
                            <input type="text" class="form-control" id="editNamaPelamar" name="nama_pelamar"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editNilaiTes">Nilai Tes</label>
                            <input type="number" class="form-control" id="editNilaiTes" name="nilai_tes" required>
                        </div>
                        <div class="form-group">
                            <label for="editNilaiWawancara">Nilai Wawancara</label>
                            <input type="number" class="form-control" id="editNilaiWawancara" name="nilai_wawancara"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editHasilKeputusan">Hasil Keputusan</label>
                            <select class="form-control" id="editHasilKeputusan" name="hasil_keputusan" required>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Delete Button Logic dengan SweetAlert
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Mencegah aksi default (submit form langsung)

                const form = $(this).closest('form'); // Ambil form terdekat dari tombol delete

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini tidak bisa dikembalikan setelah dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit form jika user mengonfirmasi penghapusan
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Edit Button Logic untuk modal dengan data yang telah dipilih
            $('#editNilaiModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal
                var id = button.data('id');
                var nama = button.data('nama');
                var tes = button.data('tes');
                var wawancara = button.data('wawancara');
                var hasil = button.data('hasil');

                var actionUrl = "{{ route('admin.nilai.updateNilai', ':id') }}".replace(':id', id);
                $(this).find('form').attr('action', actionUrl);


                // Set data ke dalam modal
                var modal = $(this);
                modal.find('#editNamaPelamar').val(nama);
                modal.find('#editNilaiTes').val(tes);
                modal.find('#editNilaiWawancara').val(wawancara);
                modal.find('#editHasilKeputusan').val(hasil);
            });
            // Reset modal setelah selesai digunakan
            $('#editNilaiModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset(); // Reset form dalam modal
            });
        });
    </script>
@endsection
