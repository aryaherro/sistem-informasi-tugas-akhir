<?= $this->extend('layouts/templates'); ?>

<?= $this->section('content'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <html>

    <body>
        <h1>Profil Mahasiswa</h1>
        <p>
            <td>Biodata Mahasiswa</td>
        </p>

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
    </body>

    </html>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blank Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                Start creating your amazing application!
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
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