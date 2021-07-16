<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- Mahasiswa -->
                <li class="nav-header">Mahasiswa</li>
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <li class="nav-item <?= (strstr(current_url(), base_url("/Mahasiswa/TugasAkhir"))) ? "menu-is-opening menu-open" : ""; ?>">
                        <!-- tambahkan active dibawah -->
                        <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Mahasiswa/TugasAkhir"))) ? "active" : ""; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Tugas Akhir
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= route_to("mahasiswa.judul"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/TugasAkhir/judul")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengajuan Judul Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= route_to("mahasiswa.bimbinganProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/TugasAkhir/bimbinganProposal")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bimbingan Proposal Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= route_to("mahasiswa.bimbinganTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/TugasAkhir/bimbinganTugasAkhir")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bimbingan Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <li class="nav-item <?= (strstr(current_url(), base_url("/Mahasiswa/Jadwal"))) ? "menu-is-opening menu-open" : ""; ?>">
                        <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Mahasiswa/Jadwal"))) ? "active" : ""; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Jadwal
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= route_to("mahasiswa.jadwal.jadwalSeminarProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/Jadwal/SeminarProposal")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Seminar Proposal Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= route_to("mahasiswa.jadwal.jadwalSeminarTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/Jadwal/SeminarTugasAkhir")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Seminar Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
                <!-- Mahasiswa -->

                <!-- Dosen -->
                <li class="nav-header">Dosen</li>
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Validasi & Saran
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="../../index.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Judul Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../../index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bimbingan Proposal Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../../index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bimbingan Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../../index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Penilaian Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Jadwal
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="../../index.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Seminar Proposal Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../../index2.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
                <!-- Dosen -->

                <!-- Prodi -->
                <li class="nav-header">Prodi</li>
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <li class="nav-item <?= (strstr(current_url(), base_url("/Prodi/Validasi"))) ? "menu-is-opening menu-open" : ""; ?>">
                        <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Prodi/Validasi"))) ? "active" : ""; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Validasi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= route_to("prodi.validasi.judul"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Validasi/Judul")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Judul Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= route_to("prodi.validasi.proposal"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Validasi/Proposal")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Proposal Tugas Akhir Mahasiswa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= route_to("prodi.validasi.tugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Validasi/TugasAkhir")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Tugas Akhir Mahasiswa</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>
                <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                    <li class="nav-item <?= (strstr(current_url(), base_url("/Prodi/Jadwal"))) ? "menu-is-opening menu-open" : ""; ?>">
                        <a href="#" class="nav-link  <?= (strstr(current_url(), base_url("/Prodi/Jadwal"))) ? "active" : ""; ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Pembuatan Jadwal
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= route_to("prodi.jadwal.jadwalSeminarProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Jadwal/SeminarProposal")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Seminar Proposal Tugas Akhir</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= route_to("prodi.jadwal.jadwalSeminarTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Jadwal/SeminarTugasAkhir")) ? "active" : ""; ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Tugas Akhir</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </div>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>