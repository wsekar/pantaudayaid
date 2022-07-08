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
			<div id="content" data-url="<?= base_url('staff') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('staff') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
								<div class="card-body">
									<form action="<?= base_url('staff/proses_tambah') ?>" id="form-tambah" method="POST">
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="kode_staff"><strong>Kode Administrator</strong></label>
												<input type="text" name="kode_staff" placeholder="Masukkan Kode Staff Admin" autocomplete="off" class="form-control" required value="<?= $kode_staff = $this->M_Staff->buatkode() ?>" readonly>
											</div>
											<div class="form-group col-md-6">
												<label for="email_staff"><strong>Email</strong></label>
												<input type="email" name="email_staff" placeholder="Masukkan Email" autocomplete="off" class="form-control" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="username_staff"><strong>Username</strong></label>
												<input type="text" name="username_staff" placeholder="Masukkan Username" autocomplete="off" class="form-control" required>
											</div>
											<div class="form-group col-md-6">
												<label for="password_staff"><strong>Password</strong></label>
												<input type="text" name="password_staff" placeholder="Masukkan Password" autocomplete="off" class="form-control" required>
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
			let username_staff = $('input[name="kode_staff"]').val().split(' - ');
			username_staff = 'ADM' + username_staff[1]
			$('input[name="username_staff"]').val(username_staff)
		})
	</script> -->
</body>

</html>