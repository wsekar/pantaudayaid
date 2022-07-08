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
            <div id="content" data-url="<?= base_url('Petugas') ?>">
                <!-- load Topbar -->
                <?php $this->load->view('partials/topbar.php') ?>

                <div class="container-fluid">
                    <div class="clearfix">
                        <div class="float-left">
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
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

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data PJU</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_datapju ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Petugas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_petugas ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Data Monitoring</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_monitoring_pju ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-4">
                        <h5>Statistik Monitoring Daya PJU</h5>
                        <canvas id="myChart"></canvas>
                        <?php
                        $daya = "";            // string kosong untuk menampung data tahun
                        $total_per_daya = null;    // nilai awal null untuk menampung data total siswa

                        // looping data dari $chartSiswa
                        foreach ($chartDaya as $chart) {
                            $dataDaya     = $chart->DAYA . "";
                            $daya         .= "'$dataDaya'" . ",";
                            $dataTotal     = $chart->total_setiap_daya;
                            $total_per_daya .= "'$dataTotal'" . ",";
                        }

                        ?>
                    </div>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
                    <script type="text/javascript">
                        const chartDaya = document.getElementById('myChart').getContext('2d');
                        const chart = new Chart(chartDaya, {
                            type: 'bar',
                            data: {
                                labels: [<?= $daya; ?>], // data tahun sebagai label dari chart
                                datasets: [{
                                    label: 'Total PJU',
                                    backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)', 'rgb(255, 102, 102)', 'rgb(153, 51, 255)', 'rgb(255, 178, 102)'],
                                    borderColor: ['rgb(255, 99, 132)'],
                                    data: [<?= $total_per_daya; ?>] //data siswa sebagai data dari chart
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    </script>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                    </br>
                </div>
                <!-- load footer -->
                <?php $this->load->view('partials/footer.php') ?>
            </div>
        </div>
        <?php $this->load->view('partials/js.php') ?>
        <!-- <script src="<?= base_url() ?>/assets/Chart.js"></script> -->
        <script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
        <script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>