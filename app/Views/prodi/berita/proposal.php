<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
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
                        <div class="card-header">
                            <h3 class="card-title">Berita Acara Proposal Tugas Akhir</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($berita_acara == null) :; ?>
                                <div>Tidak ada mahasiswa yang melakukan Ujian Seminar Proposal</div>
                            <?php else : ?>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>
                                                    No
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Nim
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Nama Mahasiswa
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Judul
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Saran Penguji 1
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Saran Penguji 2
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    ketentuan
                                                </center>
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
                                                        <?= $key['nim']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['nama']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?= $key['judul']; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['Berkas_saran_dosuji1'] != null) : ?>
                                                            <a class="btn btn-info" href="<?= base_url("Prodi/BA/Download/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/1"); ?>">Download</a>
                                                        <?php else : ?>
                                                            -
                                                        <?php endif; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['Berkas_saran_dosuji2'] != null) : ?>
                                                            <a class="btn btn-info" href="<?= base_url("Prodi/BA/Download/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/2"); ?>">Download</a>
                                                        <?php else : ?>
                                                            -
                                                        <?php endif; ?>
                                                    </center>
                                                </td>
                                                <td>11</td>
                                            </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                    <!-- <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </tfoot> -->
                                </table>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bimbingan Proposal Tugas Akhir</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($berita_acara == null) :; ?>
                                <div>Tidak ada mahasiswa yang melakukan Ujian Seminar Proposal</div>
                            <?php else : ?>
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>
                                                    No
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Nim
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Nama Mahasiswa
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Judul
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Bimbingan Ke
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Berkas Mahasiswa
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Berkas Dospem 1
                                                </center>
                                            </th>
                                            <th>
                                                <center>
                                                    Berkas Dospem 2
                                                </center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($berita_acara as $key) : ?>

                                            <?php $j = 1; ?>
                                            <?php $bim = $bimbingan->where('judulProposal_id', $key['judulProposal_id'])->findAll(); ?>
                                            <?php $jumlah = count($bim) + 1; ?>

                                            <?php foreach ($bim as $keyB) : ?>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            <?= $i++; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $key['nim']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $key['nama']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $key['judul']; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?= $j++; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php if ($keyB['Berkas_bimbingan'] != null) : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Prodi/BA/downloadBimbingan/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/{$keyB['id']}"); ?>">Download</a>
                                                            <?php else : ?>
                                                                -
                                                            <?php endif; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php if ($keyB['Berkas_saran_dospem1'] != null) : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Prodi/BA/downloadBimbingan/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/{$keyB['id']}/1"); ?>">Download</a>
                                                            <?php else : ?>
                                                                -
                                                            <?php endif; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php if ($keyB['Berkas_saran_dospem2'] != null) : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Prodi/BA/downloadBimbingan/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/{$keyB['id']}/2"); ?>">Download</a>
                                                            <?php else : ?>
                                                                -
                                                            <?php endif; ?>
                                                        </center>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        <?php endforeach; ?>
                                    </tbody>
                                    <!-- <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </tfoot> -->
                                </table>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
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

<!-- InputMask -->
<script src="<?= base_url(); ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

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
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'D/M/YYYY'
        });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<!-- daterange picker -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="<?= base_url(); ?>/plugins/toastr/toastr.min.css">
<?= $this->endSection(); ?>