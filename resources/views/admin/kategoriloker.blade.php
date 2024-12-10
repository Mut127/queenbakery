@extends('layouts.app')

@section('content')
    <div class="container-scroller">
        <div class="">
            <div class="ml-2 mr-2 content-wrapper" style="background-color: transparent;">
                <div class="row">
                    <div class="col-lg-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="card-title mb-0">Kelola Lowongan</h4>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#addJobModal">
                                        <i class="fas fa-plus"></i> Add Lowongan
                                    </button>
                                </div>

                                <!-- Modal Tambah Kategori -->
                                <div class="modal fade" id="addJobModal" tabindex="-1" role="dialog"
                                    aria-labelledby="addJobModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.storeKategoriLoker') }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addJobModalLabel">Tambah Lowongan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Nama Posisi</label>
                                                        <input type="text" class="form-control" id="name"
                                                            name="name" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Posisi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kategorilokers as $kl)
                                                <tr>
                                                    <td>{{ $kl->name }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <!-- Edit Button -->

                                                            <button type="button"
                                                                class="btn btn-sm btn-outline-secondary edit-user mr-1"
                                                                data-toggle="modal"
                                                                data-target="#editJobModal{{ $kl->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20"
                                                                    width="25" viewBox="0 0 640 512">
                                                                    <path fill="#FFB200"
                                                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8 4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" />
                                                                </svg>
                                                            </button>

                                                            <!-- Modal Edit Kategori -->
                                                            <div class="modal fade" id="editJobModal{{ $kl->id }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="editJobModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <form
                                                                            action="{{ route('admin.updateKategoriLoker', $kl->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="editJobModalLabel">Edit Lowongan
                                                                                </h5>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label for="name">Nama
                                                                                        Posisi</label>
                                                                                    <input type="text"
                                                                                        class="form-control" id="name"
                                                                                        name="name"
                                                                                        value="{{ $kl->name }}"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="btn btn-danger"
                                                                                    data-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Save</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Delete Button -->
                                                            <form
                                                                action="{{ route('admin.destroyKategoriLoker', $kl->id) }}"
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
                                                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .d-flex.align-items-center button {
            margin: 0 8px;
            /* Jarak antar ikon */
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Mencegah submit form langsung

                const form = $(this).closest('form'); // Ambil form terdekat

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
                        form.submit(); // Submit form jika user mengonfirmasi
                    }
                });
            });
        });
    </script>
@endsection