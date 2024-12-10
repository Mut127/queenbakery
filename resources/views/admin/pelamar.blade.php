@extends('layouts.app')

@section('content')
<div class="container-scroller">
    <div class="">
        <div class="ml-6 mr-2 content-wrapper" style="background-color: transparent;">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="card-title mb-0">Pelamar</h4>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#addPelamarModal">
                                    <i class="fas fa-user-plus"></i> Add Pelamar
                                </button>
                            </div>

                            <!-- Add Pelamar Modal -->
                            <div class="modal fade" id="addPelamarModal" tabindex="-1" role="dialog"
                                aria-labelledby="addPelamarModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.pelamar.storePelamar') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addPelamarModalLabel">Add Pelamar</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input id="name" type="text" class="form-control" name="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input id="email" type="email" class="form-control" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dob">Tanggal Lahir</label>
                                                    <input id="dob" type="date" class="form-control" name="dob" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Alamat</label>
                                                    <textarea id="address" class="form-control" name="address" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="education">Pendidikan</label>
                                                    <input id="education" type="text" class="form-control" name="education" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kategori_id">Kategori Lowongan</label>
                                                    <select id="kategori_id" name="kategori_id" class="form-control" required>
                                                        <option value="">Pilih Kategori Lowongan</option>
                                                        @foreach($kategorilokers as $kategori)
                                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="photo">Foto</label>
                                                    <input id="photo" type="file" class="form-control" name="photo" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Pelamar Table -->
                            <div class="table-responsive overflow-auto w-max">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>Pendidikan</th>
                                            <th>Posisi</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pelamars as $item)
                                        <tr>
                                            <td>{{ Str::limit($item->name, 20) }}</td>
                                            <td>{{ Str::limit($item->email, 8) }}</td>
                                            <td>{{ $item->dob }}</td>
                                            <td>{{ Str::limit($item->address, 20) }}</td>
                                            <td>{{ Str::limit($item->education, 20) }}</td>
                                            <td>
                                                @foreach($kategorilokers as $kategori)
                                                @if($kategori->id == $item->kategori_id)
                                                {{ $kategori->name }}
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($item->photo)
                                                <img src="{{ asset('images/pelamar/' . $item->photo) }}"
                                                    alt="Photo" width="100">
                                                @else
                                                No Photo
                                                @endif
                                            </td>
                                            <td> <!-- Delete Button -->
                                                <form action="{{ route('admin.pelamar.destroyPelamar', $item->id) }}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger delete-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 448 512">
                                                            <path fill="#FF0000" d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM32 128H416c17.7 0 32 14.3 32 32v320c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32zm32 32v320h352V160H64z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.updateStatus', ['id' => $item->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- Spoofing method PUT -->
                                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                                        <option value="belum_diproses" {{ $item->status == 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                                        <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                        <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                    </select>
                                                </form>
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




@endsection