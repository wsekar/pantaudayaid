<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top" onload="getLocation();">
    <div id="wrapper">
        <!-- load sidebar -->
        <?php $this->load->view('partials/sidebar.php') ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" data-url="<?= base_url('monitoringpju') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <?php if ($this->session->login['role'] == 'Administrator') { ?>
                                <a href="<?= base_url('MonitoringPJU/petugas_staff') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>

                            <?php } else { ?>
                                <a href="<?= base_url('MonitoringPJU/petugas') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong>Data Monitoring PJU</strong></div>
                                <div class="card-body">
                                    <form class="myForm" action="<?= base_url('monitoringpju/proses_ubah/' . $monitoringpju->id_monitoring_pju) ?>" id="form-tambah" method="POST" enctype="multipart/form-data">

                                        <input type="hidden" name="id_monitoring_pju" autocomplete="off" class="form-control" required value="<?= $monitoringpju->id_monitoring_pju ?>" readonly>

                                        <label for="id_pju"><strong>Alamat PJU</strong></label>
                                        <select type="text" name="id_pju" autocomplete="off" class="form-control" disabled id="id_pju" required>
                                            <option value="">Pilih Alamat</option>
                                            <?php foreach ($all_dataapju as $dataapju) : ?>
                                                <option value="<?= $dataapju->id_pju ?>" <?php if ($dataapju->id_pju == $monitoringpju->id_pju) {
                                                                                                echo "selected='selected'";
                                                                                            } ?>><?= $dataapju->alamat ?></option>
                                            <?php endforeach ?>
                                        </select>

                                        <label for="nomor_trafo"><strong>Nomor Trafo</strong></label>
                                        <input type="text" class="form-control" disabled value="<?= $dataapju->nomor_trafo ?>">

                                        <label for="jenis_lampu"><strong>Jenis Lampu</strong></label>
                                        <input type="text" class="form-control" disabled value="<?= $dataapju->jenis_lampu ?>">


                                        <label for="jenis_tiang"><strong>Jenis Tiang</strong></label>
                                        <input type="text" class="form-control" disabled value="<?= $dataapju->jenis_tiang ?>">


                                        <!-- <div class="form-group col-md-6">
                                                <?php foreach ($all_staaff as $staaff) : ?>
                                                    <input type="hidden" name="id_staff" autocomplete="off" class="form-control" value="<?= $staaff->id_staff ?> - <?= $staaff->username_staff ?>" readonly>
                                                    <?php endforeach ?>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <?php foreach ($all_petugaas as $petugaas) : ?>
                                                    <input type="hidden" name="id_petugas" autocomplete="off" class="form-control" required value="<?= $this->session->login['id'] ?> - <?= $this->session->login['username'] ?>" readonly>
                                                    <?php endforeach ?>
                                            </div> -->


                                        <label for="tanggal_monitoring_pju"><strong>Tanggal Monitoring</strong></label>
                                        <input type="text" name="tanggal_monitoring_pju" autocomplete="off" readonly class="form-control" required value="<?= $monitoringpju->tanggal_monitoring_pju ?>">

                                        <label for="daya_monitoring_pju"><strong>Daya Monitoring PJU</strong></label>
                                        <input type="text" name="daya_monitoring_pju" placeholder="Masukkan Nama kategori" autocomplete="off" class="form-control" required value="<?= $monitoringpju->daya_monitoring_pju ?>" readonly>

                                        <label for="kategori_daya"><strong>Kategori Daya</strong></label>
                                        <input type="text" name="kategori_daya" placeholder="" autocomplete="off" class="form-control" required value="<?= $monitoringpju->kategori_daya ?>" readonly>


                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <label for=""><strong>Gambar PJU</strong></label>
                                                <img src="<?= base_url() . './assets/images/' . $monitoringpju->gambar_monitoring_pju ?>" class="img-fluid">

                                            </div>
                                            <div class="col-md-6">
                                                <label for=""><strong>Titik Lokasi</strong></label>
                                                <iframe src='https://www.google.com/maps?q=<?= $monitoringpju->latitude_monitoring_pju ?>,<?= $monitoringpju->longitude_monitoring_pju ?>&h1=es;z=14&output=embed' style="width: 95%; height: 95%" ;> </iframe>
                                            </div>

                                            <input type="hidden" name="latitude_monitoring_pju" required value="">
                                            <input type="hidden" name="longitude_monitoring_pju" required value=""> <br>
                                        </div>
                                        <hr>

                                    </form>
                                    <!-- geolocation -->
                                    <script type="text/javascript">
                                        function getLocation() {
                                            if (navigator.geolocation) {
                                                navigator.geolocation.getCurrentPosition(showPosition);
                                            }
                                        }

                                        function showPosition(position) {
                                            document.querySelector('.myForm input[name = "latitude_monitoring_pju"]').value = position.coords.latitude;
                                            document.querySelector('.myForm input[name = "longitude_monitoring_pju"]').value = position.coords.longitude;
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

    <script>
        $(document).ready(function() {
            $('#id_pju').on('change', function() {
                let id = $(this).val();

                $.ajax({
                    url: "<?= base_url(); ?>datapju/get_monitoring",
                    type: "POST",
                    data: {
                        id_pju: id
                    },
                    success: function(res) {
                        let data = JSON.parse(res)
                        $(`#jenis_tiang option[value=${data.id_pju}]`).attr('selected', 'selected');
                        $(`#jenis_lampu option[value=${data.id_pju}]`).attr('selected', 'selected');
                        $(`#nomor_trafo option[value=${data.id_pju}]`).attr('selected', 'selected');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            })
        })
    </script>
</body>

</html>