<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Judul Tugas Akhir</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card <?= ($isi != null) ? 'collapsed-card' : ''; ?>">
                        <div class="card-header">
                            <h5 class="card-title">Pengajuan Proposal</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-<?= ($isi == null) ? 'minus' : 'plus'; ?>"></i>
                                </button>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="block col"></div>
                                <button type="button" class="btn btn-inline btn-primary col-2" data-toggle="modal" data-target="#modal-default">Tambah Judul</button>
                            </div>
                            <br>
                            <?php if ($judul == null) : ?>
                                <div>Anda Belum Mengajukan Judul</div>
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
                                                <center>ACC Dospem 1</center>
                                            </th>
                                            <th>
                                                <center>ACC Dospem 2</center>
                                            </th>
                                            <th>
                                                <center>ACC Prodi</center>
                                            </th>
                                            <th>
                                                <center>Kelayakan Dospem 1</center>
                                            </th>
                                            <th>
                                                <center>Kelayakan Dospem 2</center>
                                            </th>
                                            <th>
                                                <center>Kelayakan Prodi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($judul as $key) : ?>
                                            <tr value="<?= $key['id']; ?>">
                                                <td>
                                                    <center><?= $i++; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['judul']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['deskripsi']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['acc_dospem1']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if ($key['acc_dospem2'] == '0')
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['acc_dospem2']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if ($key['acc_dospem1'] == '0')
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['acc_prodi']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (($key['acc_dospem1'] == '0') || ($key['acc_dospem2'] == '0'))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?></center>
                                                </td>

                                                <!-- kelayakan -->

                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['layak_dospem1']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (($key['layak_dospem2'] == false) && ($key['acc_prodi'] != true))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['layak_dospem2']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (($key['layak_dospem1'] == false) && ($key['acc_prodi'] != true))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['layak_prodi']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (((($key['layak_dospem1'] == false) && ($key['layak_dospem1'] != null)) || (($key['layak_dospem2'] == false) && ($key['layak_dospem2'] != null))) || ($key['acc_prodi'] != true))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?></center>
                                                </td>
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
                    <?php if ($isi != null) : ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Progress Tugas Akhir</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">


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
                                                <center>Saran Dosen penguji 1</center>
                                            </th>
                                            <th>
                                                <center>Saran Dosen penguji 2</center>
                                            </th>
                                            <th>
                                                <center>Kelayakan Dospem 1</center>
                                            </th>
                                            <th>
                                                <center>Kelayakan Dospem 2</center>
                                            </th>
                                            <th>
                                                <center>Kelayakan Prodi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($isi as $key) : ?>
                                            <tr value="<?= $key['id']; ?>">
                                                <td>
                                                    <center><?= $i++; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['judul']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['deskripsi']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['Berkas_saran_dosuji1'] == null) : ?>
                                                            -
                                                        <?php else : ?>
                                                            <a class="btn btn-info" href="<?= base_url("Mahasiswa/BA/Download/{$key['judulProposal_id']}/P/1"); ?>">Download</a>
                                                        <?php endif; ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['Berkas_saran_dosuji2'] == null) : ?>
                                                            -
                                                        <?php else : ?>
                                                            <a class="btn btn-info" href="<?= base_url("Mahasiswa/BA/Download/{$key['judulProposal_id']}/P/2"); ?>">Download</a>
                                                        <?php endif; ?>
                                                    </center>
                                                </td>

                                                <!-- kelayakan -->

                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['layak_dospem1']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (($key['layak_dospem2'] == false) && ($key['acc_prodi'] != true))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['layak_dospem2']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (($key['layak_dospem1'] == false) && ($key['acc_prodi'] != true))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        switch ($key['layak_prodi']) {
                                                            case '1':
                                                                echo "Disetujui";
                                                                break;
                                                            case '0':
                                                                echo "Ditolak";
                                                                break;
                                                            case null:
                                                                if (((($key['layak_dospem1'] == false) && ($key['layak_dospem1'] != null)) || (($key['layak_dospem2'] == false) && ($key['layak_dospem2'] != null))) || ($key['acc_prodi'] != true))
                                                                    echo "-";
                                                                else
                                                                    echo "Dalam proses";
                                                                break;
                                                        }
                                                        ?></center>
                                                </td>
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
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    <?php endif; ?>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pengajuan Judul</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= route_to('judul') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" class="form-control" placeholder="Judul" name="judul">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" rows="3" placeholder="Deskripsi" name='deskripsi'></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
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