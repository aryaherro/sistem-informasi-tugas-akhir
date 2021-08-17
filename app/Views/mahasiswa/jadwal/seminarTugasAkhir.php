<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jadwal Seminar Proposal</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h5 class="card-title">Jadwal Seminar Tugas Akhir</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if ($jadwal == null) : ?>
                                Belum ada jadwal
                            <?php else : ?>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center>Judul</center>
                                            </th>
                                            <th>
                                                <center>Deskripsi</center>
                                            </th>
                                            <th>
                                                <center>Tanggal seminar Proposal</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($jadwal as $key) : ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?= $i++; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['judul']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['deskripsi']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['jadwal']; ?>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-header">
                            <h5 class="card-title">Catatan Seminar Proposal</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if ($berita_acara == null) : ?>
                                Belum ada hasil seminar
                            <?php else : ?>
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center>Judul</center>
                                            </th>
                                            <th>
                                                <center>Deskripsi</center>
                                            </th>
                                            <th>
                                                <center>Saran Dosen Penguji 1</center>
                                            </th>
                                            <th>
                                                <center>Saran Dosen Penguji 2</center>
                                            </th>
                                            <th>
                                                <center>Nilai Dosen Penguji 1</center>
                                            </th>
                                            <th>
                                                <center>Nilai Dosen Penguji 2</center>
                                            </th>
                                            <th>
                                                <center>Hasil</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($berita_acara as $key) : ?>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <?= $i++; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['judul']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['deskripsi']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['Berkas_saran_dosuji1'] != null) : ?>
                                                            <a class="btn btn-info" href="<?= base_url("Mahasiswa/BA/Download/{$key['judulProposal_id']}/P/1"); ?>">Download</a>
                                                        <?php else : ?>
                                                            -
                                                        <?php endif; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['Berkas_saran_dosuji2'] != null) : ?>
                                                            <a class="btn btn-info" href="<?= base_url("Mahasiswa/BA/Download/{$key['judulProposal_id']}/P/2"); ?>">Download</a>
                                                        <?php else : ?>
                                                            -
                                                        <?php endif; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['dosuji1_nilai']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['dosuji2_nilai']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['ketentuan']) {
                                                            case null:
                                                                echo 'Dalam Penilaian';
                                                                break;
                                                            case 1:
                                                                echo "Lulus";
                                                                break;
                                                            case 0:
                                                                echo "Tidak Lulus";
                                                                break;
                                                        }
                                                        ?>
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>/plugins/toastr/toastr.min.js"></script>

<script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/toastr/toastr.min.css">
<?= $this->endSection(); ?>