<!-- resources/views/leave/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-0">Input Cuti</h4>
                            <br></br>
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employeeName">Nama Karyawan</label>
                                            <input type="text" class="form-control" id="employeeName" name="employee_name" required>
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
                                                <!-- Tambahkan jenis cuti lainnya sesuai kebutuhan -->
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection