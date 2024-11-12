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
                                    <form id="attendanceForm" onsubmit="return validateAttendanceForm()">
                                        @csrf
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label text-end">Pengguna :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="Muthia Khanza" readonly>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label text-end">Tanggal :</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="5/10/2024" readonly>
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
                                                    <input class="form-check-input" type="radio" name="status" id="statusIzin" value="Izin" onclick="toggleFields()">
                                                    <label class="form-check-label" for="statusIzin">Izin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" id="statusSakit" value="Sakit" onclick="toggleFields()">
                                                    <label class="form-check-label" for="statusSakit">Sakit</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="suratDokterField" class="mb-3 row" style="display: none;">
                                            <label class="col-sm-4 col-form-label text-end">Bukti Foto Surat Dokter :</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" id="suratDokter" accept="image/*">
                                            </div>
                                        </div>
                                        <div id="pengajuanIzin" class="mb-3 row" style="display: none;">
                                            <label class="col-sm-4 col-form-label text-end">Alasan Izin :</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" rows="3" id="alasanIzin" placeholder="Masukkan alasan pengajuan izin"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                            <button type="button" class="btn btn-danger">Batal</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Cuti Tab -->
                                <div class="tab-pane fade" id="leave" role="tabpanel" aria-labelledby="leave-tab">
                                    <h4 class="mt-4">Form Pengajuan Izin</h4>
                                    <form id="leaveForm" onsubmit="return validateLeaveForm()">
                                        @csrf
                                        <!-- Pilihan Izin atau Sakit -->
                                        <div class="form-group">
                                            <label for="jenis_izin">Jenis Izin</label>
                                            <div>
                                                <input type="radio" id="izin" name="jenis_izin" value="izin" required>
                                                <label style="margin-right: 15px;" for="izin">Izin</label>
                                                <input type="radio" id="sakit" name="jenis_izin" value="sakit" required>
                                                <label style="margin-right: 15px;" for="sakit">Sakit</label>
                                            </div>
                                        </div>

                                        <!-- Keterangan -->
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea id="keterangan" name="keterangan" class="form-control" rows="3" required></textarea>
                                        </div>

                                        <!-- Input Surat -->
                                        <div class="form-group">
                                            <label for="surat">Surat Keterangan (jika ada)</label>
                                            <input type="file" id="surat" name="surat" class="form-control" accept=".pdf,.jpg,.png">
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
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
    function toggleFields() {
        var suratDokterField = document.getElementById("suratDokterField");
        var pengajuanIzin = document.getElementById("pengajuanIzin");
        var statusIzin = document.getElementById("statusIzin").checked;
        var statusSakit = document.getElementById("statusSakit").checked;

        // Tampilkan field upload bukti foto surat dokter dan alasan izin hanya jika status "Izin" atau "Sakit" dipilih
        if (statusIzin || statusSakit) {
            suratDokterField.style.display = "flex";
            pengajuanIzin.style.display = "flex";
        } else {
            suratDokterField.style.display = "none";
            pengajuanIzin.style.display = "none";
        }
    }

    function validateAttendanceForm() {
        var statusIzin = document.getElementById("statusIzin").checked;
        var statusSakit = document.getElementById("statusSakit").checked;
        var suratDokter = document.getElementById("suratDokter");
        var alasanIzin = document.getElementById("alasanIzin");

        // Validasi untuk memastikan bukti foto surat dokter diunggah dan alasan izin diisi jika status "Izin" atau "Sakit" dipilih
        if ((statusIzin || statusSakit) && !suratDokter.value) {
            alert("Anda harus memasukkan bukti foto surat dokter.");
            return false;
        }

        if ((statusIzin || statusSakit) && alasanIzin.value.trim() === "") {
            alert("Anda harus memasukkan alasan pengajuan izin.");
            return false;
        }

        return true;
    }

    function validateLeaveForm() {
        // Validasi form cuti jika perlu
        return true;
    }
</script>
@endsection