<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">

            <h1>Profil Mahasiswa</h1>


            <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <p>
                        Biodata Mahasiswa
                    </p>
                </h3>


            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img src="/profile/<?= user()->__get('username'); ?>.png" height="400" onerror="this.onerror=null;this.src='/profile/default.png';">
                    </div>
                    <div class="col">
                        <form action="" method="">
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><input type="text" nama="Nama"></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>:</td>
                                    <td><input type="number" nama="NIK"></td>
                                </tr>
                                <tr>
                                    <td>NIM</td>
                                    <td>:</td>
                                    <td><input type="number" nama="NIM"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td>
                                        <input type="radio" nama="jk" value=> Laki-Laki
                                        <input type="radio" nama="jk" value=> Perempuan
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><input type="date" nama="tanggal_lahir"></td>
                                </tr>
                                <tr>
                                    <td>Tempat Lahir</td>
                                    <td>:</td>
                                    <td><input type="text" nama="tempat_lahir"></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><textarea nama="alamat"></textarea></td>
                                </tr>
                                <tr>
                                    <td>No Telpn</td>
                                    <td>:</td>
                                    <td><input type="number" nama="no_telpn"></td>
                                </tr>

                                <tr>
                                    <td>Agama</td>
                                    <td>:</td>
                                    <td><input type="text" nama="agama"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>