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
                            <a href="<?= base_url('MonitoringPJU/Petugas') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header"><strong>Data Monitoring PJU</strong></div>
                                <div class="card-body">
                                    <form class="myForm" action="<?= base_url('monitoringpju/proses_ubah/' . $monitoringpju->id_monitoring_pju) ?>" id="form-tambah" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="hidden" name="id_monitoring_pju" autocomplete="off" class="form-control" required value="<?= $monitoringpju->id_monitoring_pju ?>">
                                            <div class="form-group">
                                                <label for="id_pju"><strong>Alamat PJU</strong></label>
                                                <select type="text" name="id_pju" autocomplete="off" class="form-control" id="id_pju" required>
                                                    <option value="">Pilih Alamat</option>
                                                    <?php foreach ($all_dataapju as $dataapju) : ?>
                                                        <option value="<?= $dataapju->id_pju ?>" <?php if ($dataapju->id_pju == $monitoringpju->id_pju) {
                                                                                                        echo "selected='selected'";
                                                                                                    } ?>><?= $dataapju->alamat ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="nomor_trafo"><strong>Nomor Trafo</strong></label>
                                                <select type="text" name="nomor_trafo" id="nomor_trafo" class="form-control" disabled>
                                                    <option value="">Pilih Nomor Trafo</option>
                                                    <?php foreach ($all_dataapju as $dataapju) : ?>
                                                        <option value="<?= $dataapju->id_pju ?>" <?php if ($dataapju->id_pju == $monitoringpju->id_pju) {
                                                                                                        echo "selected='selected'";
                                                                                                    } ?>><?= $dataapju->nomor_trafo ?></option>

                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_lampu"><strong>Jenis Lampu</strong></label>
                                                <select type="text" name="jenis_lampu" class="form-control" value="" id="jenis_lampu" disabled>
                                                    <option value="">Pilih Jenis Lampu</option>
                                                    <?php foreach ($all_dataapju as $dataapju) : ?>
                                                        <option value="<?= $dataapju->id_pju ?>" <?php if ($dataapju->id_pju == $monitoringpju->id_pju) {
                                                                                                        echo "selected='selected'";
                                                                                                    } ?>><?= $dataapju->jenis_lampu ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_tiang"><strong>Jenis Tiang</strong></label>
                                                <select type="text" name="jenis_tiang" class="form-control" value="" id="jenis_tiang" disabled>
                                                    <option value="">Pilih Jenis Tiang</option>
                                                    <?php foreach ($all_dataapju as $dataapju) : ?>
                                                        <option value="<?= $dataapju->id_pju ?>" <?php if ($dataapju->id_pju == $monitoringpju->id_pju) {
                                                                                                        echo "selected='selected'";
                                                                                                    } ?>><?= $dataapju->jenis_tiang ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <?php foreach ($all_staaff as $staaff) : ?>
                                                    <input type="hidden" name="id_staff" autocomplete="off" class="form-control" value="<?= $staaff->id_staff ?> - <?= $staaff->username_staff ?>" readonly>
                                                    <!-- <?php endforeach ?>-->
                                            </div>
                                            <div class="form-group">
                                                <?php foreach ($all_petugaas as $petugaas) : ?>
                                                    <input type="hidden" name="id_petugas" autocomplete="off" class="form-control" required value="<?= $this->session->login['id'] ?> - <?= $this->session->login['username'] ?>" readonly>
                                                    <!-- <?php endforeach ?>-->
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal_monitoring_pju"><strong>Tanggal Monitoring</strong></label>
                                                <!-- <input type="date" name="tanggal_monitoring_pju" autocomplete="off" class="form-control" required value="<?= $monitoringpju->tanggal_monitoring_pju ?>"> -->
                                                <input type="text" name="tanggal_monitoring_pju" value="<?= $monitoringpju->tanggal_monitoring_pju ?>" readonly class="form-control">
                                            </div>
                                            <!-- <input type="hidden" name="username" autocomplete="off" class="form-control" required value="<?= $monitoringpju->id_petugas ?>" readonly>
                                        </div> -->

                                            <div class="form-group">
                                                <label for="gambar_monitoring_pju"><strong>Gambar Monitoring PJU</strong></label>
                                                <input type="file" name="gambar_monitoring_pju" class="form-control" value="<?= $monitoringpju->gambar_monitoring_pju ?>">
                                                <img src="<?= base_url() . './assets/images/' . $monitoringpju->gambar_monitoring_pju ?>" class="mt-5" width="300" height="300">
                                                <input type="hidden" name="file_name" value="<?= $monitoringpju->gambar_monitoring_pju ?>">

                                                </fieldset>
                                                <button id="ugambar" class="btn btn-block btn-primary">Update Gambar</button>
                                            </div>
                                            <div class="form-group">
                                                <label for="daya_monitoring_pju"><strong>Daya Monitoring PJU</strong></label>
                                                <input type="text" name="daya_monitoring_pju" placeholder="Masukkan Nama kategori" autocomplete="off" class="form-control" id="daya_monitoring_pju" required value="<?= $monitoringpju->daya_monitoring_pju ?>" readonly>
                                                <!-- <select name="daya_monitoring_pju" id="daya_monitoring_pju" class="form-control" required>
                                                    <option value="">-- Silahkan Pilih --</option>
                                                    <option value="300" <?= $monitoringpju->daya_monitoring_pju == '300' ? 'selected' : '' ?>>300</option>
                                                    <option value="450" <?= $monitoringpju->daya_monitoring_pju == '450' ? 'selected' : '' ?>>450</option>
                                                    <option value="900" <?= $monitoringpju->daya_monitoring_pju == '900' ? 'selected' : '' ?>>900</option>
                                                </select> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori_daya"><strong>Kategori Daya</strong></label>
                                                <input type="text" name="kategori_daya" placeholder="" autocomplete="off" class="form-control" id="kategori_daya" required value="<?= $monitoringpju->kategori_daya ?>" readonly>
                                            </div>
                                            <input type="hidden" name="latitude_monitoring_pju" required value="">
                                            <input type="hidden" name="longitude_monitoring_pju" required value=""> <br>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                                        </div>
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
    <script>
        function request() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    var test = JSON.parse(this.responseText);
                    var nilai = test.pju[test.pju.length - 1];
                    // console.log(nilai);
                    $('#kategori_daya').val(nilai.category);
                    $('#daya_monitoring_pju').val(nilai.watt);

                }
            };
            xhttp.open("GET", "http://127.0.0.1:5000/got", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send();

        }



        $("form#form-tambah").on('click', '#ugambar', function(event) {
            event.preventDefault();
            // console.log(this.parentElement.parentElement.parentElement);

            var formData = new FormData(this.parentElement.parentElement.parentElement);


            $.ajax({
                url: "http://127.0.0.1:5000/uploader",
                type: 'POST',
                data: formData,
                success: function(data) {

                    request()
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
</body>

</html>