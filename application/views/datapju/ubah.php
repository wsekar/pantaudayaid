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
                                    <form class="myForm" action="<?= base_url('datapju/proses_ubah/' . $datapju->id_pju) ?>" id="form-tambah" method="POST">

                                        <input type="hidden" name="id_pju" autocomplete="off" class="form-control" required value="<?= $datapju->id_pju ?>" maxlength="8" readonly>
                                        <?php foreach ($all_petugas as $petugas) : ?>
                                            <input type="hidden" name="id_petugas" autocomplete="off" class="form-control" required value="<?= $this->session->login['id'] ?> - <?= $this->session->login['username'] ?>" readonly>
                                            <!-- <?php endforeach ?> -->


                                            <div class="form-group">
                                                <label for="nomor_trafo"><strong>Nomor Trafo</strong></label>
                                                <input type="text" name="nomor_trafo" placeholder="Masukkan Nomor Trafo" autocomplete="off" class="form-control" required value="<?= $datapju->nomor_trafo ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_lampu"><strong>Jenis Lampu</strong></label>
                                                <input type="text" name="jenis_lampu" placeholder="Isikan Jenis Lampu" autocomplete="off" class="form-control" required value="<?= $datapju->jenis_lampu ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_tiang"><strong>Jenis Tiang</strong></label>
                                                <input type="text" name="jenis_tiang" placeholder="Isikan Jenis Tiang" autocomplete="off" class="form-control" required value="<?= $datapju->jenis_tiang ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat"><strong>Alamat</strong></label>
                                                <input id="searchTextField" type="text" name="alamat" placeholder="Masukkan Alamat" autocomplete="off" class="form-control" required value="<?= $datapju->alamat ?>">
                                            </div>
                                            <div id="map_canvas" style="height: 350px; width: 100%; margin: 0.6em"></div>
                                            <div class="form-group">
                                                <label for="latitude"><strong>Latitude</strong></label>
                                                <input type="text" class="MapLat form-control" id="latitude" name="latitude" required value="<?= $datapju->latitude ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="longitude"><strong>Longitude</strong></label>
                                                <input type="text" class="MapLon form-control" id="longitude" name="longitude" required value="<?= $datapju->longitude ?>" readonly>
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                                <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                            </div>
                                    </form>
                                    <script type="text/javascript">
                                        // function getLocation() {
                                        //     if (navigator.geolocation) {
                                        //         navigator.geolocation.getCurrentPosition(showPosition);
                                        //     }
                                        // }

                                        function showPosition(position) {
                                            document.querySelector('.myForm input[name = "latitude"]').value = position.coords.latitude;
                                            document.querySelector('.myForm input[name = "longitude"]').value = position.coords.longitude;
                                        }

                                        function showError(error) {
                                            switch (error.code) {
                                                case error.PERMISSION_DENIED:
                                                    alert("You Must Allow the Request for Geolocation to Fill Out The Form");
                                                    location.reload();
                                                    break;
                                            }
                                        }
                                    </script>
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