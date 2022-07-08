<?php

class petugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//pengambiilan data user login sesuai dengan rolenya
		if ($this->session->login['role'] != 'Petugas' && $this->session->login['role'] != 'Administrator') redirect();
		$this->data['aktif'] = 'petugas';
		$this->load->model('M_Petugas');
	}

	public function index()
	{
		$this->data['title'] = 'Data Petugas'; //buat judul
		$this->data['all_petugas'] = $this->M_Petugas->lihat(); //mengambil data kasir dari method lihat dalam model M_kasir
		$this->data['no'] = 1;

		$this->load->view('petugas/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'Petugas') { //jika login sebagai kasir
			//tidak dapat menambahkan data kasir
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('petugas'); //redirect ke penjualan
		}

		$this->data['title'] = 'Tambah Petugas';
		//load view halaman kasir/tambah
		$this->load->view('petugas/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'Petugas') { //jika login sebagai kasir
			//tidak dapat menambahkan data kasir dan akan redirect ke penjualan
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('petugas');
		}

		$data = [ //variabel data menampung array berikut
			'kode_petugas' => $this->input->post('kode_petugas'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'telephone' => $this->input->post('telephone'),
		];

		if ($this->M_Petugas->tambah($data)) { //benar mengambil method tambah pada model M_kasir
			//membuat session flashdata/notifikasi bahwa data berhasil ditambah
			$this->session->set_flashdata('success', 'Data Petugas <strong>Berhasil</strong> Ditambahkan!');
			// redirect ke kasir
			redirect('petugas');
		} else {
			//membuat session flashdata/notifikasi bahwa data gagal ditambah
			$this->session->set_flashdata('error', 'Data Petugas <strong>Gagal</strong> Ditambahkan!');
			// redirect ke kasir
			redirect('petugas');
		}
	}

	public function ubah($id_petugas)
	{
		if ($this->session->login['role'] == 'Petugas') {
			//jika login sebagai kasir
			//tidak dapat mengubah data kasir dan akan redirect ke penjualan
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('petugas');
		}

		$this->data['title'] = 'Ubah Petugas';
		$this->data['petugas'] = $this->M_Petugas->lihat_id($id_petugas);

		$this->load->view('petugas/ubah', $this->data);
	}

	public function proses_ubah($id_petugas)
	{
		if ($this->session->login['role'] == 'Petugas') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('petugas');
		}

		$data = [
			'kode_petugas' => $this->input->post('kode_petugas'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'telephone' => $this->input->post('telephone'),
		];

		if ($this->M_Petugas->ubah($data, $id_petugas)) {
			$this->session->set_flashdata('success', 'Data Petugas <strong>Berhasil</strong> Diubah!');
			redirect('petugas');
		} else {
			$this->session->set_flashdata('error', 'Data Petugas <strong>Gagal</strong> Diubah!');
			redirect('petugas');
		}
	}

	public function hapus($id_petugas)
	{
		if ($this->session->login['role'] == 'Petugas') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('petugas');
		}

		if ($this->M_Petugas->hapus($id_petugas)) {
			$this->session->set_flashdata('success', 'Data Petugas <strong>Berhasil</strong> Dihapus!');
			redirect('petugas');
		} else {
			$this->session->set_flashdata('error', 'Data Petugas <strong>Gagal</strong> Dihapus!');
			redirect('petugas');
		}
	}
}
