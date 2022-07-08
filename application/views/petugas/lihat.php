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
			<div id="content" data-url="<?= base_url('petugas') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<?php if ($this->session->login['role'] == 'Administrator') : ?>
								<a href="<?= base_url('petugas/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
						<div class="card-header"><strong>Daftar Petugas</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr class="text-center">
											<td>No</td>
											<td>Kode Petugas</td>
											<td>Nama Petugas</td>
											<td>Email</td>
											<td>Telephone</td>
											<?php if ($this->session->login['role'] == 'Administrator') : ?>
												<td>Username</td>
												<td>Password</td>
												<td>Aksi</td>
											<?php endif ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($all_petugas as $petugas) : ?>
											<tr class="text-center">
												<td><?= $no++ ?></td>
												<td><?= $petugas->kode_petugas ?></td>
												<td><?= $petugas->nama_petugas ?></td>
												<td><?= $petugas->email ?></td>
												<td><?= $petugas->telephone ?></td>
												<?php if ($this->session->login['role'] == 'Administrator') : ?>
													<td><?= $petugas->username ?></td>
													<td><?= $petugas->password ?></td>
													<td>
														<div class="btn-group">
															<a href="<?= base_url('petugas/ubah/' . $petugas->id_petugas) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
															<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('petugas/hapus/' . $petugas->id_petugas) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
														</div>
													</td>
												<?php endif ?>
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