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
            <div id="content" data-url="<?= base_url('DataPJU') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>
                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                        <div class="float-right">
                            <!-- <?php if ($this->session->login['role'] == 'admin') : ?> -->
                            <!-- <a href="<?= base_url('kategori/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
                            <!-- <?php endif ?> -->
                            <a href="<?= base_url('DataPJU/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
                        <div class="card-header"><strong>Daftar PJU</strong></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <td>No</td>
                                            <!-- <td>ID PJU</td> -->
                                            <td>Nomor Trafo</td>
                                            <td>Jenis Lampu</td>
                                            <td>Jenis Tiang</td>
                                            <td>Alamat</td>
                                            <td>Lokasi</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($all_datapju as $datapju) : ?>
                                            <tr class="text-center">
                                                <td><?= $no++ ?></td>
                                                <!-- <td><?= $datapju->id_pju ?></td> -->
                                                <td><?= $datapju->nomor_trafo ?></td>
                                                <td><?= $datapju->jenis_lampu ?></td>
                                                <td><?= $datapju->jenis_tiang ?></td>
                                                <td><?= $datapju->alamat ?></td>
                                                <td><iframe src='https://www.google.com/maps?q=<?= $datapju->latitude ?>,<?= $datapju->longitude ?>&h1=es;z=14&output=embed' width="300px" height="200px" ;> </iframe> </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?= base_url('DataPJU/ubah/' . $datapju->id_pju) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
                                                        <a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('DataPJU/hapus/' . $datapju->id_pju) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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