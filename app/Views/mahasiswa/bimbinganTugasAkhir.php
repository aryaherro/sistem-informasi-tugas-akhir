<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1>Bimbingan Tugas Akhir</h1>
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

                        <div class="card-header col-12">
                            <h5 class="card-title">Bimbingan Tugas Akhir</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="block col"></div>
                                <button type="button" class="btn btn-inline btn-primary col-2" data-toggle="modal" data-target="#modal-default">Ajukan Bimbingan</button>
                            </div>
                            <br>
                            <?php if ($judul == null) : ?>
                                <div>
                                    Judul yang anda ajukan belum memenuhi syarat untuk melakukan bimbingan!
                                    <br>
                                    Silahkan hubungi dosen pembimbing anda.
                                </div>
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
                                                <center>Bimbingan ke-</center>
                                            </th>
                                            <th>
                                                <center>Deskripsi</center>
                                            </th>
                                            <th>
                                                <center>Lihat File</center>
                                            </th>

                                            <th>
                                                <center>Saran dosen pembimbing 1</center>
                                            </th>
                                            <th>
                                                <center>Saran dosen pembimbing 2</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($judul as $key) : ?>
                                            <?php $j = 1; ?>
                                            <?php foreach ($bimbingan[$key['id']] as $keyB) : ?>
                                                <tr value="<?= $keyB['id']; ?>">
                                                    <td>
                                                        <center><?= $i++; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?= $key['judul']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?= $j++; ?></center>
                                                    </td>
                                                    <td>
                                                        <center><?= $keyB['Deskripsi']; ?></center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a class="btn btn-info" href="<?= base_url("Mahasiswa/TugasAkhir/downloadBimbingan/{$key['mahasiswa_id']}/{$key['id']}/T/{$keyB['id']}"); ?>">Download</a>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php if ($keyB['Berkas_saran_dospem1'] == null) : ?>
                                                                Dalam Proses
                                                            <?php else : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Mahasiswa/TugasAkhir/downloadBimbingan/{$key['mahasiswa_id']}/{$key['id']}/T/{$keyB['id']}/1"); ?>">Download</a>
                                                            <?php endif; ?>
                                                        </center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <?php if ($keyB['Berkas_saran_dospem2'] == null) : ?>
                                                                Dalam Proses
                                                            <?php else : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Mahasiswa/TugasAkhir/downloadBimbingan/{$key['mahasiswa_id']}/{$key['id']}/T/{$keyB['id']}/2"); ?>">Download</a>
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
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Ajukan Bimbingan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- <label for="customFile">Custom File</label> -->
                            <form action="<?= route_to('bimbinganTugasAkhir') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Judul</label>
                                    <select class="form-select" aria-label="Default select example" name="judulTugasAkhir_id">
                                        <?php foreach ($judul as $key) :; ?>
                                            <option value="<?= $key['id']; ?>"><?= $key['judul']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div><?php echo session()->getFlashdata('error'); ?>
                                <div class="custom-file form-group">
                                    <input type="file" class="form-control custom-file-input" id="Berkas_bimbingan" name="Berkas_bimbingan" />
                                    <label class="custom-file-label" for="Berkas_bimbingan">File</label>
                                </div>
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" rows="3" placeholder="Deskripsi" name="Deskripsi"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                </div>
            </div>
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