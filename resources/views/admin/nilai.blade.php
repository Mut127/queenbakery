@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="main-panel">
        <div class="ml-2 mr-2 content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Kelola Nilai</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addScoreModal">
                                    <i class="fas fa-plus"></i> Tambah Nilai
                                </button>
                            </div>

                            <!-- Modal Tambah Nilai -->
                            <div class="modal fade" id="addScoreModal" tabindex="-1" role="dialog" aria-labelledby="addScoreModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addScoreModalLabel">Tambah Nilai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="pelamarName">Nama Pelamar</label>
                                                    <input type="text" class="form-control" id="pelamarName" name="nama_pelamar" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="testScore">Nilai Tes</label>
                                                    <input type="number" class="form-control" id="testScore" name="nilai_tes" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="interviewScore">Nilai Wawancara</label>
                                                    <input type="number" class="form-control" id="interviewScore" name="nilai_wawancara" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="decision">Hasil Keputusan</label>
                                                    <select class="form-control" id="decision" name="hasil_keputusan" required>
                                                        <option value="Diterima">Diterima</option>
                                                        <option value="Ditolak">Ditolak</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
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
                                        <!-- Tampilkan data nilai pelamar di sini -->
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
@endsection