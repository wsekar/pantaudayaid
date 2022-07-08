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
            <div id="content" data-url="<?= base_url('monitoringpju') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>
                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <?php if ($this->session->login['role'] == 'Petugas') : ?>
                                <a href="<?= base_url('monitoringpju/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                            <?php endif ?>
                        </div>
                    </div>
                    <hr>
                    <?php if ($this->session->flashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php elseif ($this->session->flashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif ?>
                    <div class="card shadow">
                        <div class="card-header"><strong>Daftar Monitoring PJU</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Alamat PJU</td>
                                            <td>Nomor Trafo</td>
                                            <td>Jenis Lampu</td>
                                            <td>Jenis Tiang</td>
                                            <?php if ($this->session->login['role'] == 'Administrator') : ?>
                                                <td>Nama Petugas</td>
                                            <?php endif ?>
                                            <!-- <td>Nama Staff</td> -->
                                            <!-- <td>Gambar PJU</td> -->
                                            <td>Besar Daya</td>
                                            <td>Kategori Daya</td>
                                            <td>Tanggal Monitoring</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_monitoringpju as $monitoringpju) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>

                                                <td><?= $monitoringpju->alamat ?>
                                                </td>

                                                <?php if ($this->session->login['role'] == 'Administrator') : ?>
                                                    <td><?= $monitoringpju->username ?></td>
                                                <?php endif ?>
                                                <!-- <td><?= $monitoringpju->username_staff ?></td> -->
                                                <!-- <td><img src="<?= base_url() . 'assets/images/' . $monitoringpju->gambar_monitoring_pju ?>" width="150" height="150"></td> -->
                                                <td><?= $monitoringpju->daya_monitoring_pju ?></td>
                                                <!-- <td style="width: 150px; height: 150px; "><iframe src='https://www.google.com/maps?q=<?= $monitoringpju->latitude_monitoring_pju ?>,<?= $monitoringpju->longitude_monitoring_pju ?>&h1=es;z=14&output=embed' style="width: 100%; height: 100%" ;> </iframe> </td> -->
                                                <td><?= $monitoringpju->tanggal_monitoring_pju ?></td>
                                                <td>

                                                    <div class="btn-group">
                                                        <?php if ($this->session->login['role'] == 'Petugas') : ?>
                                                            <a href="<?= base_url('monitoringpju/ubah/' . $monitoringpju->id_monitoring_pju) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                                        <?php endif ?>
                                                        <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('monitoringpju/hapus/' . $monitoringpju->id_monitoring_pju) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
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
    <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>