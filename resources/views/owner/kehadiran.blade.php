@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Konten Utama -->
        <main class="flex-fill">
            <div class="container mt-5">
                <h4 class="mb-4 text-center">Kehadiran</h4>
                <div class="card p-4 shadow-sm">
                    <form>
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
                                <select class="form-select">
                                    <option selected>Pilih Status</option>
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Sakit">Sakit</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label text-end">Keterangan :</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="3" placeholder="Masukkan keterangan"></textarea>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="button" class="btn btn-danger">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection