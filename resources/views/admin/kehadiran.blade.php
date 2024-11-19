@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Kehadiran</h4>
                            <br>
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="attendanceTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="attendance-tab" data-toggle="tab" href="#attendance" role="tab" aria-controls="attendance" aria-selected="true">Kehadiran</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="leave-tab" data-toggle="tab" href="#leave" role="tab" aria-controls="leave" aria-selected="false">Pengajuan Izin</a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="attendanceTabContent">
                                <!-- Kehadiran Tab -->
                                <div class="tab-pane fade show active" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
                                    <h4 class="mt-4">Form Kehadiran</h4>
                                    <!-- Form kehadiran -->
                                    <form action="{{ route('admin.kehadiran') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label text-end">Pengguna :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label text-end">Tanggal :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="currentDate" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label text-end">Status :</label>
                                            <div class="col-sm-8">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="statusHadir" value="Hadir">
                                                    <label class="form-check-label" for="statusHadir">Hadir</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="statusIzin" value="Izin">
                                                    <label class="form-check-label" for="statusIzin">Izin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="statusSakit" value="Sakit">
                                                    <label class="form-check-label" for="statusSakit">Sakit</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row" id="suratDokterField" style="display: none;">
                                            <label class="col-sm-4 col-form-label text-end">Surat Dokter:</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" name="surat" accept=".pdf,.jpg,.png">
                                            </div>
                                        </div>
                                        <div class="mb-3 row" id="alasanIzinField" style="display: none;">
                                            <label class="col-sm-4 col-form-label text-end">Alasan Izin/Sakit:</label>
                                            <div class="col-sm-8">
                                                <textarea name="reason" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            <button type="button" class="btn btn-danger">Batal</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Pengajuan Izin Tab -->
                                <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                                    <h4 class="mt-4">Form Pengajuan Izin</h4>
                                    <form action="{{ route('admin.storeIzin') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="jenis_izin">Jenis Izin</label>
                                            <div>
                                                <input type="radio" id="izin" name="jenis_izin" value="izin" required>
                                                <label for="izin">Izin</label>
                                                <input type="radio" id="sakit" name="jenis_izin" value="sakit" required>
                                                <label for="sakit">Sakit</label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" rows="3" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="surat">Surat Izin</label>
                                            <input type="file" name="surat" class="form-control">
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary me-2">Ajukan Izin</button>
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
    </div>
</div>

<script>
    document.getElementById('currentDate').value = new Date().toISOString().split('T')[0];

    function toggleFields() {
        const status = document.querySelector('input[name="status"]:checked').value;
        if (status === 'Izin' || status === 'Sakit') {
            document.getElementById('alasanIzinField').style.display = 'block';
            if (status === 'Sakit') {
                document.getElementById('suratDokterField').style.display = 'block';
            } else {
                document.getElementById('suratDokterField').style.display = 'none';
            }
        } else {
            document.getElementById('alasanIzinField').style.display = 'none';
            document.getElementById('suratDokterField').style.display = 'none';
        }
    }
</script>
@endsection