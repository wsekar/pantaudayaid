<?php

class DataPJU extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->login['role'] != 'Petugas' && $this->session->login['role'] != 'Administrator') redirect();
        $this->data['aktif'] = 'datapju';
        $this->load->model('M_DataPJU');
        $this->load->model('M_Petugas');
        // $this->load->helper('url');
    }
    public function index()
    {
        $this->data['title'] = 'Data PJU';
        $this->data['all_datapju'] = $this->M_DataPJU->lihat();
        $this->data['no'] = 1;

        $this->load->view('datapju/lihat', $this->data);
    }
    public function tambah()
    {
        $this->data['title'] = 'Tambah Data PJU';
        $this->data['all_petugas'] = $this->M_Petugas->lihat();
        $this->load->view('datapju/tambah', $this->data);
    }
    public function proses_tambah()
    {
        $data = [
            'id_pju'     => $this->input->post('id_pju'),
            'id_petugas' => $this->input->post('id_petugas'),
            'latitude'   => $this->input->post('latitude'),
            'longitude'  => $this->input->post('longitude'),
            'alamat'     => $this->input->post('alamat'),
            'nomor_trafo'     => $this->input->post('nomor_trafo'),
            'jenis_lampu'     => $this->input->post('jenis_lampu'),
            'jenis_tiang'     => $this->input->post('jenis_tiang'),
        ];

        if ($this->M_DataPJU->tambah($data)) {
            $this->session->set_flashdata('success', 'Data PJU <strong>Berhasil</strong> Ditambahkan!');
            redirect('datapju');
        } else {
            $this->session->set_flashdata('error', 'Data PJU <strong>Gagal</strong> Ditambahkan!');
            redirect('datapju');
        }
    }
    public function ubah($id_pju)
    {
        $this->data['title'] = 'Ubah Data PJU';
        $this->data['datapju'] = $this->M_DataPJU->lihat_id($id_pju);
        $this->data['all_petugas'] = $this->M_Petugas->lihat();
        $this->load->view('datapju/ubah', $this->data);
    }

    public function proses_ubah($id_pju)
    {
        $data = [
            'id_pju' => $this->input->post('id_pju'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'nomor_trafo'     => $this->input->post('nomor_trafo'),
            'jenis_lampu'     => $this->input->post('jenis_lampu'),
            'jenis_tiang'     => $this->input->post('jenis_tiang'),
            'alamat' => $this->input->post('alamat'),

        ];

        if ($this->M_DataPJU->ubah($data, $id_pju)) {
            $this->session->set_flashdata('success', 'Data PJU <strong>Berhasil</strong> Diubah!');
            redirect('datapju');
        } else {
            $this->session->set_flashdata('error', 'Data PJU <strong>Gagal</strong> Diubah!');
            redirect('datapju');
        }
    }

    public function hapus($id_pju)
    {
        if ($this->M_DataPJU->hapus($id_pju)) {
            $this->session->set_flashdata('success', 'Data PJU <strong>Berhasil</strong> Dihapus!');
            redirect('datapju');
        } else {
            $this->session->set_flashdata('error', 'Data PJU <strong>Gagal</strong> Dihapus!');
            redirect('datapju');
        }
    }

    public function get_monitoring()
    {
        $id = $this->input->post('id_pju');

        $pju = $this->M_DataPJU->lihat_id($id);
        echo json_encode($pju);
    }
}
