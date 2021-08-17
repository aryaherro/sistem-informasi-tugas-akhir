<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <h1>Data Uji Proposal Tugas Akhir Mahasiswa</h1>
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
                            <h5 class="card-title">Proposal Tugas Akhir</h5>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if ($berita_acara == null) :; ?>
                                <div>Tidak ada mahasiswa yang melakukan Ujian Seminar Proposal</div>
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
                                                <center>Saran Dosen</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($berita_acara as $key) :; ?>
                                            <tr>
                                                <td>
                                                    <center><?= $i++; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['nim']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['nama']; ?></center>
                                                </td>
                                                <td>
                                                    <center><?= $key['judul']; ?></center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <?php if ($key['dosuji1_id'] == $person['id']) : ?>
                                                            <?php if ($key['Berkas_saran_dosuji1'] == null) : ?>
                                                                <a data-toggle="modal" data-nim="<?= $key['nim']; ?>" data-nama="<?= $key['nama']; ?>" data-judul="<?= $key['judul']; ?>" data-jad=<?= $key['jadwalSeminarProposal_id']; ?> title="Add this item" class="open-AddUji btn btn-info" href="#AddUji">Upload</a>
                                                            <?php else : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Dosen/UjiSeminar/Download/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/1"); ?>">Download</a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                        <?php if ($key['dosuji2_id'] == $person['id']) : ?>
                                                            <?php if ($key['Berkas_saran_dosuji2'] == null) : ?>
                                                                <a data-toggle="modal" data-nim="<?= $key['nim']; ?>" data-nama="<?= $key['nama']; ?>" data-judul="<?= $key['judul']; ?>" data-jad=<?= $key['jadwalSeminarProposal_id']; ?> title="Add this item" class="open-AddUji btn btn-info" href="#AddUji">Upload</a>
                                                            <?php else : ?>
                                                                <a class="btn btn-info" href="<?= base_url("Dosen/UjiSeminar/Download/{$key['mahasiswa_id']}/{$key['judulProposal_id']}/P/2"); ?>">Download</a>
                                                            <?php endif; ?>
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

        <div class="modal fade" id="AddUji">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Upload Saran</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= route_to('Proposal') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="text" class="form-control visually-hidden" id="jad" name="jad" />
                            <div class="row align-items-center m-1 form-group">
                                <div class="col-3">Nim</div>
                                <div class="col-1">:</div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="nim" name="nim" readonly />
                                </div>
                            </div>
                            <div class="row align-items-center m-1 form-group">
                                <div class="col-3">Nama</div>
                                <div class="col-1">:</div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="nama" name="nama" readonly />
                                </div>
                            </div>
                            <div class="row align-items-center m-1 form-group">
                                <div class="col-3">Judul</div>
                                <div class="col-1">:</div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="judul" name="judul" readonly />
                                </div>
                            </div>
                            <div class="custom-file form-group m-1">
                                <input type="file" class="form-control custom-file-input" id="Berkas_saran" name="Berkas_saran" />
                                <label class="custom-file-label" for="Berkas_saran">File</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
                title: 'Judul telah divalidasi.'
            })
        });
    });
    $(document).on("click", ".open-AddUji", function() {
        var nim = $(this).data('nim');
        var nama = $(this).data('nama');
        var judul = $(this).data('judul');
        var ke = $(this).data('bimbingan');
        var jad = $(this).data('jad');
        $(".modal-body #nim").attr("value", nim);
        $(".modal-body #nama").attr("value", nama);
        $(".modal-body #judul").attr("value", judul);
        $(".modal-body #bimbingan").attr("value", ke);
        $(".modal-body #jad").attr("value", jad);
        // As pointed out in comments, 
        // it is unnecessary to have to manually call the modal.
        // $('#AddUji').modal('show');
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