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
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
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
                                            <center>Tanggal seminar Proposal</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>201811111</td>
                                        <td>Alexander Pierce</td>
                                        <td>Sistem pendukung keputusan pemilihan supplier pada CV. surya abadi dengan metode AHP</td>
                                        <td>Sistem ini membantu para pengambil keputusan melihat keputusan mana yang paling baik untuk diambil</td>
                                        <td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y"); ?>" name="tgl"></td>
                                    </tr>
                                </tbody>
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

<?= $this->endSection(); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>