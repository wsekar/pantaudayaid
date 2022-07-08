<?php

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->login['role'] != 'Petugas' && $this->session->login['role'] != 'Administrator') redirect();
        $this->data['aktif'] = 'staff';
        $this->load->model('M_Staff');
    }

    public function index()
    {
        if ($this->session->login['role'] == 'Petugas') {
            $this->session->set_flashdata('error', 'Managemen staff hanya untuk admin!');
            redirect('staff');
        }

        $this->data['title'] = 'Data Administrator';
        $this->data['all_staff'] = $this->M_Staff->lihat();
        $this->data['no'] = 1;

        $this->load->view('staff/lihat', $this->data);
    }

    public function tambah()
    {
        if ($this->session->login['role'] == 'Petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('staff');
        }

        $this->data['title'] = 'Tambah Administrator';
        // $this->data['kode'] = $this->M_Staff->getKode();

        // var_dump($this->data['kode']);
        // die;
        $this->load->view('staff/tambah', $this->data);
    }

    public function proses_tambah()
    {
        if ($this->session->login['role'] == 'Petugas') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('staff');
        }

        $data = [
            'kode_staff' => $this->input->post('kode_staff'),
            'email_staff' => $this->input->post('email_staff'),
            'username_staff' => $this->input->post('username_staff'),
            'password_staff' => $this->input->post('password_staff'),
        ];

        if ($this->M_Staff->tambah($data)) {
            $this->session->set_flashdata('success', 'Data Administrator <strong>Berhasil</strong> Ditambahkan!');
            redirect('staff');
        } else {
            $this->session->set_flashdata('error', 'Data Administrator <strong>Gagal</strong> Ditambahkan!');
            redirect('staff');
        }
    }

    public function ubah($id_staff)
    {
        if ($this->session->login['role'] == 'Petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('staff');
        }

        $this->data['title'] = 'Ubah Data Administrator';
        $this->data['staff'] = $this->M_Staff->lihat_id($id_staff);

        $this->load->view('staff/ubah', $this->data);
    }

    public function proses_ubah($id_staff)
    {
        if ($this->session->login['role'] == 'Petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('staff');
        }

        $data = [
            'kode_staff' => $this->input->post('kode_staff'),
            'email_staff' => $this->input->post('email_staff'),
            'username_staff' => $this->input->post('username_staff'),
            'password_staff' => $this->input->post('password_staff'),
        ];

        if ($this->M_Staff->ubah($data, $id_staff)) {
            $this->session->set_flashdata('success', 'Data Administrator <strong>Berhasil</strong> Diubah!');
            redirect('staff');
        } else {
            $this->session->set_flashdata('error', 'Data Administrator <strong>Gagal</strong> Diubah!');
            redirect('staff');
        }
    }

    public function hapus($id_staff)
    {
        if ($this->session->login['role'] == 'Petugas') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('staff');
        }

        if ($this->M_Staff->hapus($id_staff)) {
            $this->session->set_flashdata('success', 'Data Administrator <strong>Berhasil</strong> Dihapus!');
            redirect('staff');
        } else {
            $this->session->set_flashdata('error', 'Data Administrator <strong>Gagal</strong> Dihapus!');
            redirect('staff');
        }
    }
}
