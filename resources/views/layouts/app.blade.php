<!DOCTYPE html>
<html lang="id">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Queen Bakery</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>

<body class="parent" style="padding-top: 5%;">
    @include('partials.header')
    <div class="container-fluid">
        <div class="row">
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    @if(Auth::user()->usertype == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}" data-toggle="collapse"
                            href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Pegawai</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse {{ request()->is('admin/user*') ? 'show' : '' }}" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a
                                        class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}"
                                        href="{{ route('admin.user') }}">Pegawai List</a></li>
                                <!-- Add more sub-menu items if needed -->
                            </ul>
                        </div>
                    </li>
                    <!-- Bagian Absensi -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Rekam Kehadiran</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.absensi') ? 'active' : '' }}" href="{{ route('admin.absensi') }}">
                                        Rekap Kehadiran
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.kehadiran') ? 'active' : '' }}" href="{{ route('admin.kehadiran') }}">
                                        Presensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('admin.izin') ? 'active' : '' }}" href="{{ route('admin.izin') }}">
                                        Pengajuan Cuti
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="icon-grid-2 menu-icon"></i>
                            <span class="menu-title">Rekrutmen</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link {{ Route::is('admin.pelamar.indexPelamar') ? 'active' : '' }}" href="{{ route('admin.pelamar.indexPelamar') }}">
                                        Kelola Pelamar</a></li>
                            </ul>
                        </div>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('admin.lowongan') ? 'active' : '' }}" href="{{ route('admin.lowongan') }}">
                                        Kelola Lowongan</a> </li>
                            </ul>
                        </div>

                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('admin.kategoriloker') ? 'active' : '' }}" href="{{ route('admin.kategoriloker') }}">
                                        Kelola Ketegori Lowongan</a> </li>
                            </ul>
                        </div>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('admin.nilai.indexNilai') ? 'active' : '' }}" href="{{ route('admin.nilai.indexNilai') }}">
                                        Kelola Nilai</a> </li>
                            </ul>
                        </div>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('admin.pengumuman') ? 'active' : '' }}" href="{{ route('admin.pengumuman') }}">
                                        Kelola Pengumuman</a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
                            <i class="icon-contract menu-icon"></i>
                            <span class="menu-title">Cuti</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('admin.cuti') ? 'active' : '' }}" href="{{ route('admin.cuti') }}">
                                        Konfirmasi Cuti</a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">Penilaian Kinerja</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('admin.penilaian') ? 'active' : '' }}" href="{{ route('admin.penilaian') }}">
                                        Penilaian Kinerja</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- untuk owner -->
                    @elseif(Auth::user()->usertype == 'owner')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('owner/dashboard') ? 'active' : '' }}"
                            href="{{ route('owner.dashboard') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('owner/user*') ? 'active' : '' }}" data-toggle="collapse"
                            href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                            <i class="icon-columns menu-icon"></i>
                            <span class="menu-title">Pegawai</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse {{ request()->is('owner/user*') ? 'show' : '' }}" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a
                                        class="nav-link {{ request()->is('owner/user') ? 'active' : '' }}"
                                        href="{{ route('owner.user') }}">Pegawai List</a></li>
                                <!-- Add more sub-menu items if needed -->
                            </ul>
                        </div>
                    </li>

                    <!-- Bagian Absensi -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Absensi</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('owner.absensi') ? 'active' : '' }}" href="{{ route('owner.absensi') }}">
                                        Absensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('owner.kehadiran') ? 'active' : '' }}" href="{{ route('owner.kehadiran') }}">
                                        Kehadiran
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="icon-grid-2 menu-icon"></i>
                            <span class="menu-title">Rekrutmen</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link {{ Route::is('owner.pelamar') ? 'active' : '' }}" href="{{ route('owner.pelamar') }}">
                                        Kelola Pelamar</a></li>
                            </ul>
                        </div>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('owner.lowongan') ? 'active' : '' }}" href="{{ route('owner.lowongan') }}">
                                        Kelola Lowongan</a> </li>
                            </ul>
                        </div>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('owner.nilai') ? 'active' : '' }}" href="{{ route('owner.nilai') }}">
                                        Kelola Nilai</a> </li>
                            </ul>
                        </div>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('owner.pengumuman') ? 'active' : '' }}" href="{{ route('owner.pengumuman') }}">
                                        Kelola Pengumuman</a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
                            <i class="icon-contract menu-icon"></i>
                            <span class="menu-title">Cuti</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('owner.cuti') ? 'active' : '' }}" href="{{ route('owner.cuti') }}">
                                        Input Cuti</a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">Penilaian Kinerja</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('owner.penilaian') ? 'active' : '' }}" href="{{ route('owner.penilaian') }}">
                                        Penilaian Kinerja</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                            <i class="icon-bar-graph menu-icon"></i>
                            <span class="menu-title">Absensi</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('karyawan.absensi') ? 'active' : '' }}" href="{{ route('karyawan.absensi') }}">
                                        Absensi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::is('karyawan.kehadiran') ? 'active' : '' }}" href="{{ route('karyawan.kehadiran') }}">
                                        Kehadiran
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
                            <i class="icon-contract menu-icon"></i>
                            <span class="menu-title">Cuti</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('karyawan.cuti') ? 'active' : '' }}" href="{{ route('karyawan.cuti') }}">
                                        Input Cuti</a> </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false"
                            aria-controls="auth">
                            <i class="icon-head menu-icon"></i>
                            <span class="menu-title">Penilaian Kinerja</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="auth">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                <li class="nav-item"> <a class="nav-link {{ Route::is('karyawan.penilaian') ? 'active' : '' }}" href="{{ route('karyawan.penilaian') }}">
                                        Penilaian Kinerja</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('profile') ? 'active' : '' }}"
                            href="{{ route('profile') }}">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link"
                            href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="menu-title">Logout</span>
                        </a>
                    </li>
                </ul>

            </nav>


            <main class="flex-fill">
                <div class="body-content">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @include('partials.footer')

    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/vendors/chart.js/Chart.min.js"></script>
    <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/js/off-canvas.js"></script>
    <script src="/js/hoverable-collapse.js"></script>
    <script src="/js/template.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/js/dashboard.js"></script>
    <script src="/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
    @yield('extra-js')
</body>

</html>