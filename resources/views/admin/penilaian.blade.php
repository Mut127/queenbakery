@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- Header Penilaian Kinerja -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title mb-0">Penilaian Kinerja</h4>
                            </div>

                            <!-- Navigasi Periode Bulan -->
                            <div class="d-flex align-items-center mb-3">
                                <button class="btn btn-sm btn-primary" id="prevMonth" style="width: 30px; height: 30px; padding: 0;">
                                    &lt;
                                </button>
                                <h6 class="mx-2" id="currentMonth" style="margin-bottom: 0;"></h6>
                                <button class="btn btn-sm btn-primary" id="nextMonth" style="width: 30px; height: 30px; padding: 0;">
                                    &gt;
                                </button>
                            </div>

                            <!-- Dropdown Pilih Pegawai -->
                            <div class="mb-4">
                                <label for="employeeSelect" style="font-size: 14px;">Pilih Pegawai</label>
                                <select id="employeeSelect" class="form-control">
                                    <option value="">-- Pilih Pegawai --</option>
                                    <option value="1">Alice</option>
                                    <option value="2">Bob</option>
                                    <option value="3">Charlie</option>
                                    <option value="4">David</option>
                                    <option value="5">Eve</option>
                                    <option value="6">Frank</option>
                                    <option value="7">Grace</option>
                                    <option value="8">Hank</option>
                                </select>
                            </div>

                            <!-- Input Tanggal Penilaian (initially hidden) -->
                            <div class="mb-4" id="dateInput" style="display: none;">
                                <label for="evaluationDate" style="font-size: 14px;">Tanggal Penilaian</label>
                                <input type="date" id="evaluationDate" class="form-control">
                            </div>

                            <!-- Form Penilaian Kinerja -->
                            <div id="performanceForm" style="display: none;">
                                <form id="evaluationForm">
                                    <div class="form-group">
                                        <label for="description" style="font-size: 14px;">Catatan</label>
                                        <textarea class="form-control" id="description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="score" style="font-size: 14px;">Penilaian</label>
                                        <select class="form-control" id="score">
                                            <option value="Baik Sekali">Baik Sekali</option>
                                            <option value="Baik">Baik</option>
                                            <option value="Cukup">Cukup</option>
                                            <option value="Kurang">Kurang</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-purple btn-lg" style="font-size: 14px; padding: 14px 18px;">Simpan</button>
                                </form>
                            </div>
                            <style>
                                .btn-purple {
                                    background-color: #6f42c1; /* Warna ungu */
                                    color: white;
                                    border-color: #6f42c1;
                                }
                            
                                .btn-purple:hover {
                                    background-color: #5a30a0; /* Warna ungu yang lebih gelap saat hover */
                                    border-color: #5a30a0;
                                }
                            </style>

                            <!-- Tabel Penilaian Kinerja -->
                            <div class="table-responsive mt-4">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Catatan</th>
                                            <th>Penilaian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="performanceTable">
                                        <!-- Data penilaian akan ditampilkan di sini -->
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 -->

<script>
    // Script untuk navigasi bulan
    let currentDate = new Date();
    let selectedEmployee = null;

    function updateMonthDisplay() {
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        document.getElementById('currentMonth').textContent = monthNames[currentDate.getMonth()] + ' ' + currentDate.getFullYear();
        loadPerformanceData();
    }

    document.getElementById('prevMonth').addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        updateMonthDisplay();
    });

    document.getElementById('nextMonth').addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        updateMonthDisplay();
    });

    // Event listener untuk memilih pegawai
    document.getElementById('employeeSelect').addEventListener('change', function () {
        selectedEmployee = this.value;
        if (selectedEmployee) {
            document.getElementById('performanceForm').style.display = 'block';  // Show the form
            document.getElementById('dateInput').style.display = 'block';  // Show the date picker
        } else {
            document.getElementById('performanceForm').style.display = 'none';  // Hide the form
            document.getElementById('dateInput').style.display = 'none';  // Hide the date picker
        }
    });

    // Simulasi data penilaian
    const data = [
        { date: '2024-11-05', name: 'Alice', description: 'Disiplin, kerja sesuai jobdesc', score: 'Baik Sekali' },
        { date: '2024-11-10', name: 'Bob', description: 'Kerja cepat dan tepat', score: 'Baik' }
    ];

    // Filter data berdasarkan bulan
    function loadPerformanceData() {
        const tableBody = document.getElementById('performanceTable');
        tableBody.innerHTML = '';

        // Filter data berdasarkan bulan
        const filteredData = data.filter(item => {
            const itemDate = new Date(item.date);
            const itemMonth = itemDate.getMonth();
            const itemYear = itemDate.getFullYear();

            return itemMonth === currentDate.getMonth() && itemYear === currentDate.getFullYear();
        });

        filteredData.forEach(item => {
            const row = `<tr>
                <td>${item.date}</td>
                <td>${item.name}</td>
                <td>${item.description}</td>
                <td>${item.score}</td>
                <td>
                    <button class="btn btn-sm btn-outline-secondary">Edit</button>
                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </td>
            </tr>`;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
    }

    // Event listener untuk menyimpan penilaian
    document.getElementById('evaluationForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const name = document.getElementById('employeeSelect').selectedOptions[0].text;
        const description = document.getElementById('description').value;
        const score = document.getElementById('score').value;
        const date = document.getElementById('evaluationDate').value || new Date().toISOString().split('T')[0]; // Use the selected date or current date
        data.push({ date, name, description, score });
        loadPerformanceData();

        // Using SweetAlert2 to show a success message
        Swal.fire({
            title: 'Penilaian Berhasil!',
            text: 'Penilaian telah disimpan dengan sukses.',
            icon: 'success',
            confirmButtonText: 'OK',
            background: '#f7f7f7',
            color: '#333',
            showCancelButton: false,
            focusConfirm: true
        });

        this.reset();
        document.getElementById('performanceForm').style.display = 'none';
        document.getElementById('employeeSelect').value = '';
        document.getElementById('dateInput').style.display = 'none'; // Hide date picker after submission
    });

    // Inisialisasi tampilan bulan saat halaman dimuat
    updateMonthDisplay();
</script>
@endsection