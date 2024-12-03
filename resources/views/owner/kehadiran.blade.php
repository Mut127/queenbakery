@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Form Kehadiran</h4>

                            <!-- Form kehadiran -->
                            <form action="{{ route('owner.kehadiran') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label text-end">Nama:</label>
                                    <div class="col-sm-8">
                                        <!-- Admin can select a user from a dropdown -->
                                        @if(Auth::user()->usertype == 'owner')
                                        <select class="form-control" name="user_id">
                                            <option value="">--Select Pegawai--</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                        @endif
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label text-end">Tanggal:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="currentDate" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-4 col-form-label text-end">Status:</label>
                                    <div class="col-sm-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="statusHadir" value="Hadir" onclick="toggleFields()">
                                            <label class="form-check-label" for="statusHadir">Hadir</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="statusIzin" value="Izin" onclick="toggleFields()">
                                            <label class="form-check-label" for="statusIzin">Izin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="statusSakit" value="Sakit" onclick="toggleFields()">
                                            <label class="form-check-label" for="statusSakit">Sakit</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tambahan input untuk Izin/Sakit -->
                                <div class="mb-3 row" id="alasanIzinField" style="display: none;">
                                    <label class="col-sm-4 col-form-label text-end">Keterangan:</label>
                                    <div class="col-sm-8">
                                        <textarea name="ket" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row" id="uploadField" style="display: none;">
                                    <label class="col-sm-4 col-form-label text-end">Upload Surat:</label>
                                    <div class="col-sm-8">
                                        <input id="image_path" type="file" class="form-control" name="image_path" accept="image/*">
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                    <button type="button" class="btn btn-danger">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Set the current date in the date input field in the format: dd MMMM yyyy (e.g., 02 Desember 2024)
    document.getElementById('currentDate').value = formatDate(new Date());

    function formatDate(date) {
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return date.toLocaleDateString('id-ID', options); // Format tanggal dalam bahasa Indonesia
    }

    function toggleFields() {
        const status = document.querySelector('input[name="status"]:checked').value;

        // Get additional input fields for reason and file upload
        const alasanField = document.getElementById('alasanIzinField');
        const uploadField = document.getElementById('uploadField');

        // Show or hide fields based on the selected status
        if (status === 'Izin' || status === 'Sakit') {
            alasanField.style.display = 'block'; // Show reason input
            uploadField.style.display = 'block'; // Show file upload input
        } else {
            alasanField.style.display = 'none'; // Hide reason input
            uploadField.style.display = 'none'; // Hide file upload input
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
@endsection