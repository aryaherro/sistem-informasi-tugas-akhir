<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Judul Tugas Akhir Mahasiswa</h1>
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
                        <div class="card-body">
                            <?php if ($judul == null) : ?>
                                <div>Tidak ada judul yang perlu divalidasi</div>
                            <?php else : ?>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center>NIM</center>
                                            </th>
                                            <th>
                                                <center>Nama Mahasiswa</center>
                                            </th>
                                            <th>
                                                <center>Judul</center>
                                            </th>
                                            <th>
                                                <center>Deskripsi</center>
                                            </th>
                                            <th>
                                                <center>Validasi</center>
                                            </th>
                                            <th>
                                                <center>Maju Seminar</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($judul as $key) : ?>
                                            <?php $m = $mahasiswa->find($key['mahasiswa_id']); ?>
                                            <tr>
                                                <td>
                                                    <center><?= $i++; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $m['nim']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $m['nama']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['judul']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['deskripsi']; ?></center>
                                                </td>
                                                <!-- acc -->
                                                <td>
                                                    <center>
                                                        <?php if (($key['acc_dospem1'] == 'false') || ($key['acc_dospem2'] == 'false') || ($key['acc_prodi'] == 'false')) : ?>
                                                            Ditolak
                                                        <?php else : ?>
                                                            <?php if ($key['dospem1_id'] == $person['id']) : ?>
                                                                <?php
                                                                switch ($key['acc_dospem1']) {
                                                                    case '1':
                                                                        echo "Disetujui";
                                                                        break;
                                                                    case null:
                                                                ?>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/A/{$key['id']}/A"); ?>">
                                                                            <button type="button" class="btn btn-success swalDefaultSuccess">
                                                                                Setuju
                                                                            </button>
                                                                        </a>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/A/{$key['id']}/R"); ?>">
                                                                            <button type="button" class="btn btn-danger swalDefaultDanger">
                                                                                Tolak
                                                                            </button>
                                                                        </a>

                                                                <?php break;
                                                                }
                                                                ?>
                                                            <?php elseif ($key['dospem2_id'] == $person['id']) : ?>
                                                                <?php
                                                                switch ($key['acc_dospem2']) {
                                                                    case '1':
                                                                        echo "Disetujui";
                                                                        break;
                                                                    case null:
                                                                ?>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/A/{$key['id']}/A"); ?>">
                                                                            <button type="button" class="btn btn-success swalDefaultSuccess">
                                                                                Setuju
                                                                            </button>
                                                                        </a>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/A/{$key['id']}/R"); ?>">
                                                                            <button type="button" class="btn btn-danger swalDefaultDanger">
                                                                                Tolak
                                                                            </button>
                                                                        </a>

                                                                <?php break;
                                                                }
                                                                ?>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </center>
                                                </td>

                                                <!-- maju seminar -->
                                                <td>
                                                    <center>
                                                        <?php if ($key['dospem1_id'] == $person['id']) : ?>
                                                            <?php
                                                            switch ($key['layak_dospem1']) {
                                                                case '1':
                                                                    echo "Disetujui";
                                                                    break;
                                                                case null:
                                                            ?>
                                                                    <?php if (($key['acc_dospem1'] == true) && ($key['acc_dospem2'] == true) && ($key['acc_prodi'] == true)) : ?>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/L/{$key['id']}/A"); ?>">
                                                                            <button type="button" class="btn btn-success swalDefaultSuccess">
                                                                                Setuju
                                                                            </button>
                                                                        </a>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/L/{$key['id']}/R"); ?>">
                                                                            <button type="button" class="btn btn-danger swalDefaultDanger">
                                                                                Tolak
                                                                            </button>
                                                                        </a>
                                                                    <?php else : ?>
                                                                        -
                                                                    <?php endif; ?>
                                                            <?php break;
                                                            }
                                                            ?>
                                                        <?php elseif ($key['dospem2_id'] == $person['id']) : ?>
                                                            <?php
                                                            switch ($key['layak_dospem2']) {
                                                                case '1':
                                                                    echo "Disetujui";
                                                                    break;
                                                                case null:
                                                            ?>
                                                                    <?php if (($key['acc_dospem1'] == true) && ($key['acc_dospem2'] == true) && ($key['acc_prodi'] == true)) : ?>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/L/{$key['id']}/A"); ?>">
                                                                            <button type="button" class="btn btn-success swalDefaultSuccess">
                                                                                Setuju
                                                                            </button>
                                                                        </a>
                                                                        <a href="<?= base_url("/Dosen/Validasi/Judul/L/{$key['id']}/R"); ?>">
                                                                            <button type="button" class="btn btn-danger swalDefaultDanger">
                                                                                Tolak
                                                                            </button>
                                                                        </a>
                                                                    <?php else : ?>
                                                                        -
                                                                    <?php endif; ?>
                                                            <?php break;
                                                            }
                                                            ?>
                                                        <?php endif; ?>
                                                    </center>
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
    });


    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $('.swalDefaultSuccess').click(function() {
            Toast.fire({
                icon: 'success',
                title: 'Judul telah diapprove.'
            })
        });
        $('.swalDefaultDanger').click(function() {
            Toast.fire({
                icon: 'error',
                title: 'Judul telah ditolak.'
            })
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