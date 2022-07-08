<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('datapju') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <a href="<?= base_url('datapju') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong>Data PJU</strong></div>
                                <div class="card-body">
                                    <form class="myForm" action="<?= base_url('datapju/proses_tambah/') ?>" id="form-tambah" method="POST">

                                        <!-- <div class="form-group "> -->
                                        <!-- <label for="id_petugas"><strong>ID - Nama Petugas</strong></label> -->
                                        <?php foreach ($all_petugas as $petugas) : ?>
                                            <input type="hidden" name="id_petugas" autocomplete="off" class="form-control" required value="<?= $this->session->login['id'] ?> - <?= $this->session->login['username'] ?>" readonly>
                                            <!-- <?php endforeach ?>-->
                                            <!-- </div> -->
                                            <div class="form-group">
                                                <label for="nomor_trafo"><strong>Nomor Trafo</strong></label>
                                                <input type="text" name="nomor_trafo" placeholder="Masukkan Nomor Trafo" autocomplete="off" class="form-control " required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_lampu"><strong>Jenis Lampu</strong></label>
                                                <input type="text" name="jenis_lampu" placeholder="Isikan Jenis Lampu" autocomplete="off" class="form-control " required>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_tiang"><strong>Jenis Tiang</strong></label>
                                                <input type="text" name="jenis_tiang" placeholder="Isikan Jenis Tiang" autocomplete="off" class="form-control " required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat"><strong>Alamat</strong></label>
                                                <input id="searchTextField" class="form-control" type="text" name="alamat">
                                            </div>
                                            <div id="map_canvas" style="height: 350px; width: 100%; margin: 0.6em"></div>
                                            <div class="form-group">
                                                <label for="alamat"><strong>Latitude</strong></label>
                                                <input name="latitude" class="MapLat form-control" type="text" placeholder="Latitude" readonly />
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat"><strong>Longitude</strong></label>
                                                <input name="longitude" class="MapLon form-control" type="text" placeholder="Longitude" readonly />
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- load footer -->
            <?php $this->load->view('partials/footer.php') ?>
        </div>
    </div>
    <?php $this->load->view('partials/js.php') ?>

</body>

</html>