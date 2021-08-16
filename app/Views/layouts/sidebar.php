<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link">
        <img src="/profile/logo-unitomo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Unitomo</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/profile/<?= user()->__get('username'); ?>.png" class="img-circle elevation-2 backup_picture" alt="User Image" onerror="this.onerror=null;this.src='/profile/default.png';">
            </div>
            <div class="info">
                <a href="<?= base_url("/" . (in_groups('Mahasiswa') ? "Mahasiswa" : "Dosen")); ?>" class="d-block"><?= $person['nama']; ?></a>
            </div>
        </div>



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



                <?php if (in_groups("Mahasiswa")) :; ?>
                    <!-- Mahasiswa -->
                    <li class="nav-header">Mahasiswa</li>
                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item <?= (strstr(current_url(), base_url("/Mahasiswa/TugasAkhir"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <!-- tambahkan active dibawah -->
                            <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Mahasiswa/TugasAkhir"))) ? "active" : ""; ?>">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <p>
                                    Tugas Akhir
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("mahasiswa.judul"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/TugasAkhir/judul")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Pengajuan Judul Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("mahasiswa.bimbinganProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/TugasAkhir/bimbinganProposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Bimbingan Proposal Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("mahasiswa.bimbinganTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/TugasAkhir/bimbinganTugasAkhir")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Bimbingan Tugas Akhir</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item <?= (strstr(current_url(), base_url("/Mahasiswa/Jadwal"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Mahasiswa/Jadwal"))) ? "active" : ""; ?>">
                                <i class="fas fa-clipboard-list"></i>
                                <p>
                                    Jadwal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("mahasiswa.jadwal.jadwalSeminarProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/Jadwal/SeminarProposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Jadwal Seminar Proposal Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("mahasiswa.jadwal.jadwalSeminarTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Mahasiswa/Jadwal/SeminarTugasAkhir")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Jadwal Seminar Tugas Akhir</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <!-- Mahasiswa -->
                <?php endif; ?>

                <?php if (in_groups("Dosen")) :; ?>
                    <!-- Dosen -->
                    <li class="nav-header">Dosen</li>
                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item <?= (strstr(current_url(), base_url("/Dosen/Validasi"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Dosen/Validasi"))) ? "active" : ""; ?>">
                                <i class="fas fa-file-signature"></i>
                                <p>
                                    Validasi & Saran
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("dosen.validasi.judul"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/Validasi/Judul")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Judul Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("dosen.validasi.proposal"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/Validasi/Proposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Bimbingan Proposal Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("dosen.validasi.tugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/Validasi/TugasAkhir")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Bimbingan Tugas Akhir</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item nav-item <?= (strstr(current_url(), base_url("/Dosen/Jadwal"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <a href="#" class="nav-link  <?= (strstr(current_url(), base_url("/Dosen/Jadwal"))) ? "active" : ""; ?>">
                                <i class="fas fa-clipboard-list"></i>
                                <p>
                                    Jadwal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("dosen.jadwal.seminarProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/Jadwal/SeminarProposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Jadwal Seminar Proposal Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("dosen.jadwal.seminarTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/Jadwal/SeminarTugasAkhir")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Jadwal Tugas Akhir</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <?php if (has_permission("Dosen Penguji")) :; ?>
                        <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                            <li class="nav-item nav-item <?= (strstr(current_url(), base_url("/Dosen/UjiSeminar"))) ? "menu-is-opening menu-open" : ""; ?>">
                                <a href="#" class="nav-link  <?= (strstr(current_url(), base_url("/Dosen/UjiSeminar"))) ? "active" : ""; ?>">
                                    <i class="fab fa-leanpub"></i>
                                    <p>
                                        Uji Seminar
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= route_to("dosen.uji.proposal"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/UjiSeminar/Nilai")) ? "active" : ""; ?>">
                                            <i class="fas fa-caret-right"></i>
                                            <p>Uji Proposal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= route_to("dosen.validasi.nilai"); ?>" class="nav-link <?= (current_url() == base_url("/Dosen/UjiSeminar/Nilai")) ? "active" : ""; ?>">
                                            <i class="fas fa-caret-right"></i>
                                            <p>Penilaian Tugas Akhir</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </div>
                    <?php endif; ?>
                    <!-- Dosen -->
                <?php endif; ?>

                <?php if (has_permission("Kaprodi")) :; ?>
                    <!-- Prodi -->
                    <li class="nav-header">Prodi</li>
                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item <?= (strstr(current_url(), base_url("/Prodi/Validasi"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Prodi/Validasi"))) ? "active" : ""; ?>">
                                <i class="fas fa-file-signature"></i>
                                <p>
                                    Validasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("prodi.validasi.judul"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Validasi/Judul")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Judul Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("prodi.validasi.proposal"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Validasi/Proposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Data Proposal Tugas Akhir Mahasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("prodi.validasi.tugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Validasi/TugasAkhir")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Data Tugas Akhir Mahasiswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item <?= (strstr(current_url(), base_url("/Prodi/Jadwal"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Prodi/Jadwal"))) ? "active" : ""; ?>">
                                <i class="fas fa-clipboard"></i>
                                <p>
                                    Pembuatan Jadwal
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("prodi.jadwal.seminarProposal"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Jadwal/SeminarProposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Jadwal Seminar Proposal Tugas Akhir</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= route_to("prodi.jadwal.seminarTugasAkhir"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/Jadwal/SeminarTugasAkhir")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Jadwal Tugas Akhir</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>

                    <div class="user-panel mt-1 pb-1 mb-1 d-flex">
                        <li class="nav-item <?= (strstr(current_url(), base_url("/Prodi/BA"))) ? "menu-is-opening menu-open" : ""; ?>">
                            <a href="#" class="nav-link <?= (strstr(current_url(), base_url("/Prodi/BA"))) ? "active" : ""; ?>">
                                <i class="fas fa-clipboard"></i>
                                <p>
                                    Berita Acara Seminar
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= route_to("prodi.berita.proposal"); ?>" class="nav-link <?= (current_url() == base_url("/Prodi/BA/Proposal")) ? "active" : ""; ?>">
                                        <i class="fas fa-caret-right"></i>
                                        <p>Proposal</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                <?php endif; ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>