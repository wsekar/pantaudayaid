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
							<a href="<?= base_url('petugas') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('petugas/proses_tambah') ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="kode_petugas"><strong>Kode Petugas</strong></label>
												<input type="text" name="kode_petugas" placeholder="Masukkan Kode Petugas" autocomplete="off" class="form-control" required value="<?= $kode_petugas = $this->M_Petugas->buatkode() ?>" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="nama_petugas"><strong>Nama Petugas</strong></label>
												<input type="text" name="nama_petugas" placeholder="Masukkan Nama Petugas" autocomplete="off" class="form-control js-name" required>
											</div>

										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="email"><strong>Email</strong></label>
												<input type="email" name="email" placeholder="Masukkan Email Petugas" autocomplete="off" class="form-control " required>
											</div>
											<div class="form-group col-md-6">
												<label for="telephone"><strong>Telephone</strong></label>
												<input type="number" name="telephone" placeholder="Masukkan Telephone" autocomplete="off" class="form-control" required>
											</div>

										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="username"><strong>Username</strong></label>
												<input type="text" name="username" placeholder="Masukkan Username" autocomplete="off" class="form-control" required>
											</div>
											<div class="form-group col-md-6">
												<label for="password"><strong>Password</strong></label>
												<input type="password" name="password" placeholder="Masukkan Password" autocomplete="off" class="form-control" required>
											</div>
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
	<!-- <script>
		$(document).ready(function() {
			let username = $('input[name="id_petugas"]').val().split(' - ');
			username = 'petugas' + username[1]
			$('input[name="username"]').val(username)
		})
	</script> -->
	<script>
		function alphaOnly() {
			let nameInput = document.querySelectorAll('.js-name');
			nameInput.forEach((input) => {

				input.addEventListener('keydown', (e) => {
					let charCode = e.keyCode;

					if ((charCode >= 65 && charCode <= 90) || charCode == 8 || charCode == 32) {
						null;
					} else {
						e.preventDefault();
					}
				});
			});
		}

		alphaOnly();
	</script>
</body>

</html>