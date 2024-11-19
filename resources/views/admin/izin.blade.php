@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <main class="flex-fill">
            <div class="container mt-5">
                <h3 class="mb-4 text-center">Pengajuan Cuti</h3>
                <div class="card p-4 shadow-sm">
                    <!-- Form Pengajuan Cuti -->
                    <form action="{{ route('admin.cuti') }}" method="POST">
                        @csrf
                        <h4 class="mt-4">Input Cuti</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employeeName">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="employeeName" name="employee_name" value="{{ auth()->user()->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="startDate">Tanggal Awal Cuti</label>
                                    <input type="date" class="form-control" id="startDate" name="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label for="endDate">Tanggal Akhir Cuti</label>
                                    <input type="date" class="form-control" id="endDate" name="end_date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="leaveDays">Jumlah Cuti</label>
                                    <input type="number" class="form-control" id="leaveDays" name="leave_days" required>
                                </div>
                                <div class="form-group">
                                    <label for="leaveType">Jenis Cuti</label>
                                    <select class="form-control" id="leaveType" name="leave_type" required>
                                        <option value="">Pilih Jenis Cuti</option>
                                        <option value="Tahunan">Tahunan</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Keluarga">Keluarga</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Keterangan</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ url()->previous() }}" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection