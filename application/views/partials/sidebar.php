<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">

		<div class="sidebar-brand-text mx-3">pantaudaya.id</div>
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item <?= $aktif == 'dashboard' ? 'active' : '' ?>">
		<a class="nav-link" href="<?= base_url('dashboard') ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>
	<?php if ($this->session->login['role'] == 'Petugas') : ?>
		<hr class="sidebar-divider">
		<div class="sidebar-heading">
			Manajemen Data PJU
		</div>

		<li class="nav-item <?= $aktif == 'datapju' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('datapju') ?>">
				<i class="fas fa-list-alt"></i>
				<span>Data PJU</span></a>
		</li>
	<?php endif; ?>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<div class="sidebar-heading">
		Data Monitoring PJU
	</div>

	<?php if ($this->session->login['role'] == 'Administrator') { ?>
		<li class="nav-item <?= $aktif == 'monitoringpju' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('monitoringpju/petugas_staff') ?>">
				<i class="fas fa-fw fa-file-invoice"></i>
				<span>Data Monitoring PJU</span></a>
		</li>
	<?php } else { ?>
		<li class="nav-item <?= $aktif == 'monitoringpju' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('monitoringpju/petugas') ?>">
				<i class="fas fa-fw fa-file-invoice"></i>
				<span>Data Monitoring PJU</span></a>
		</li>
	<?php } ?>

	<hr class="sidebar-divider">
	<?php if ($this->session->login['role'] == 'Administrator') : ?>
		<!-- Heading -->
		<div class="sidebar-heading">
			Manajemen Pengguna
		</div>
		<li class="nav-item <?= $aktif == 'staff' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('staff') ?>">
				<i class="fas fa-fw fa-users"></i>
				<span>Data Administrator</span></a>
		</li>
		<li class="nav-item <?= $aktif == 'petugas' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= base_url('petugas') ?>">
				<i class="fas fa-fw fa-users"></i>
				<span>Data Petugas</span></a>
		</li>
		<hr class="sidebar-divider d-none d-md-block">
	<?php endif; ?>

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>