<?php

class MonitoringPJU extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->login['role'] != 'Petugas' && $this->session->login['role'] != 'Administrator') redirect();
        $this->data['aktif'] = 'monitoringpju';
        $this->load->model('M_MonitoringPJU');
        $this->load->model('M_DataPJU');
        $this->load->model('M_Petugas');
        $this->load->model('M_Staff');
        Header('Access-Control-Allow-Origin: http://127.0.0.1:5000/uploader'); //for allow any domain, insecure
                Header('Access-Control-Allow-Headers: *'); //for allow any headers, insecure
                Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed
        // $this->load->library('upload');
    }
    public function index()
    {
        $this->data['title'] = 'Data Monitoring PJU';
        // $this->data['all_monitoringpju'] = $this->M_MonitoringPJU->petugas_jpu_detail($this->session->login['id']);
        $this->data['all_monitoringpju'] = $this->M_MonitoringPJU->lihat($this->session->login['id']);
        $this->data['no'] = 1;
        $this->load->view('monitoringpju/lihat', $this->data);
    }

    public function petugas()
    {
        $this->data['title'] = 'Data Petugas Monitoring PJU';
        $this->data['record'] = $this->M_MonitoringPJU->petugas_jpu();
        $this->load->view('monitoringpju/detail', $this->data);
    }

    public function petugas_staff()
    {
        $this->data['title'] = 'Data Petugas Monitoring PJU';
        $this->data['record'] = $this->M_MonitoringPJU->petugas_jpu_staff();
        $this->load->view('MonitoringPJU/petugas', $this->data);
    }

    public function detail($id)
    {
        $this->data['title'] = 'Data Petugas Monitoring PJU';
        $this->data['record'] = $this->M_MonitoringPJU->petugas_jpu_detail($id);
        $this->load->view('MonitoringPJU/detail', $this->data);
    }

    public function tambah()
    {
        $this->data['title'] = 'Tambah Data Monitoring PJU';
        $this->data['all_dataapju'] = $this->M_DataPJU->lihat();
        $this->data['all_petugaas'] = $this->M_Petugas->lihat();
        $this->data['all_staaff'] = $this->M_Staff->lihat();
        $this->load->view('MonitoringPJU/tambah', $this->data);
    }
    public function proses_tambah()
    {
        if ($this->input->method() === 'post') {
            $id_monitoring_pju = $this->input->post('id_monitoring_pju', TRUE);
            $id_pju = $this->input->post('id_pju', TRUE);
            $id_staff = $this->input->post('id_staff', TRUE);
            $id_petugas = $this->input->post('id_petugas', TRUE);
            $daya_monitoring_pju = $this->input->post('daya_monitoring_pju', TRUE);
            $kategori_daya = $this->input->post('kategori_daya', TRUE);
            $latitude_monitoring_pju = $this->input->post('latitude_monitoring_pju', TRUE);
            $longitude_monitoring_pju = $this->input->post('longitude_monitoring_pju', TRUE);
            $tanggal_monitoring_pju = $this->input->post('tanggal_monitoring_pju', TRUE);
            $gambar_monitoring_pju = $this->input->post('gambar_monitoring_pju', TRUE);
            $config['upload_path']          = './assets/images/'; //tempat penyimpanan
            $config['allowed_types']        = 'jpeg|jpg|png|PNG'; //tipe yang ingin diinsert
            $config['max_size']             = 10000; //ukuran file maksimal
            $config['max_width']            = 10000; //lebar maksimal
            $config['max_height']           = 10000; //tinggi maksimal
            $config['file_name'] = $_FILES['gambar_monitoring_pju']['name'];
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar_monitoring_pju']['name'])) {
                if ($this->upload->do_upload('gambar_monitoring_pju')) {
                    $gambar_monitoring_pju = $this->upload->data();
                    $data = array(
                        'gambar_monitoring_pju' => $gambar_monitoring_pju['file_name'],
                        'id_monitoring_pju' => $id_monitoring_pju,
                        'id_pju' => $id_pju,
                        'id_staff' => $id_staff,
                        'id_petugas' => $id_petugas,
                        'daya_monitoring_pju' => $daya_monitoring_pju,
                        'kategori_daya' => $kategori_daya,
                        'latitude_monitoring_pju' => $latitude_monitoring_pju,
                        'longitude_monitoring_pju' => $longitude_monitoring_pju,
                        'tanggal_monitoring_pju' => $tanggal_monitoring_pju,
                    );

                    if ($this->M_MonitoringPJU->tambah($data)) {
                        $this->session->set_flashdata('success', 'Data PJU <strong>Berhasil</strong> Ditambahkan!');
                        redirect('MonitoringPJU/Petugas');
                    } else {
                        $this->session->set_flashdata('error', 'Data PJU <strong>Gagal</strong> Ditambahkan!');
                        redirect('MonitoringPJU');
                    }
                }
            }
        }
    }
    public function ubah($id_monitoring_pju)
    {
        $this->data['title'] = 'Ubah Data Monitoring PJU';
        $this->data['monitoringpju'] = $this->M_MonitoringPJU->lihat_id($id_monitoring_pju);
        $this->data['all_dataapju'] = $this->M_DataPJU->lihat();
        $this->data['all_petugaas'] = $this->M_Petugas->lihat();
        $this->data['all_staaff'] = $this->M_Staff->lihat();
        // $this->data['all_monitoringpju'] = $this->M_MonitoringPJU->lihat();
        $this->load->view('monitoringpju/ubah', $this->data);
    }

    public function detail_pju($id_monitoring_pju)
    {
        $this->data['title'] = 'Detail Data Monitoring PJU';
        $this->data['monitoringpju'] = $this->M_MonitoringPJU->lihat_id($id_monitoring_pju);
        $this->data['all_dataapju'] = $this->M_DataPJU->lihat();
        $this->data['all_petugaas'] = $this->M_Petugas->lihat();
        $this->data['all_staaff'] = $this->M_Staff->lihat();
        // $this->data['all_monitoringpju'] = $this->M_MonitoringPJU->lihat();
        $this->load->view('monitoringpju/detail_pju', $this->data);
    }

    public function proses_ubah()
    {

        $id_monitoring_pju  = $this->input->post('id_monitoring_pju');
        $id_pju  = $this->input->post('id_pju');
        $id_petugas  = $this->input->post('id_petugas');
        $id_staff  = $this->input->post('id_staff');
        $daya_monitoring_pju = $this->input->post('daya_monitoring_pju');
        $kategori_daya = $this->input->post('kategori_daya');
        $latitude_monitoring_pju = $this->input->post('latitude_monitoring_pju');
        $longitude_monitoring_pju = $this->input->post('longitude_monitoring_pju');
        $tanggal_monitoring_pju = $this->input->post('tanggal_monitoring_pju');

        $path = './assets/images';

        $kondisi = array('id_monitoring_pju' => $id_monitoring_pju);
        // get foto
        $config['upload_path'] = './assets/images';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['gambar_monitoring_pju']['name'];

        $this->load->library('upload', $config);
        if (!empty($_FILES['gambar_monitoring_pju']['name'])) {
            if ($this->upload->do_upload('gambar_monitoring_pju')) {
                $gambar_monitoring_pju = $this->upload->data();
                $data = array(
                    'gambar_monitoring_pju' => $gambar_monitoring_pju['file_name'],
                    'id_pju' => $id_pju,
                    'id_petugas' => $id_petugas,
                    'id_staff' => $id_staff,
                    'daya_monitoring_pju' => $daya_monitoring_pju,
                    'kategori_daya' => $kategori_daya,
                    'latitude_monitoring_pju' => $latitude_monitoring_pju,
                    'longitude_monitoring_pju' => $longitude_monitoring_pju,
                    'tanggal_monitoring_pju' => $tanggal_monitoring_pju,
                );
                // hapus foto pada direktori
                @unlink($path . $this->input->post('foto_lama'));

                $this->M_MonitoringPJU->ubah($data, $kondisi);
                $this->session->set_flashdata('success', 'Data Monitoring PJU <strong>Berhasil</strong> Diubah!');
                redirect('MonitoringPJU/Petugas');
            } else {
                $this->session->set_flashdata('error', 'Data Monitoring PJU <strong>Gagal</strong> Diubah!');
                redirect('MonitoringPJU');
            }
        } else {
            $id_pju = $this->input->post('id_pju', TRUE);
            $id_staff = $this->input->post('id_staff', TRUE);
            $id_petugas = $this->input->post('id_petugas', TRUE);
            $daya_monitoring_pju = $this->input->post('daya_monitoring_pju', TRUE);
            $kategori_daya = $this->input->post('kategori_daya', TRUE);
            $latitude_monitoring_pju = $this->input->post('latitude_monitoring_pju', TRUE);
            $longitude_monitoring_pju = $this->input->post('longitude_monitoring_pju', TRUE);
            $tanggal_monitoring_pju = $this->input->post('tanggal_monitoring_pju', TRUE);
            $data = array(
                'id_pju' => $id_pju,
                'id_petugas' => $id_petugas,
                'id_staff' => $id_staff,
                'daya_monitoring_pju' => $daya_monitoring_pju,
                'kategori_daya' => $kategori_daya,
                'latitude_monitoring_pju' => $latitude_monitoring_pju,
                'longitude_monitoring_pju' => $longitude_monitoring_pju,
                'tanggal_monitoring_pju' => $tanggal_monitoring_pju,
            );
            @unlink($path . $this->input->post('foto_lama'));

            $this->M_MonitoringPJU->ubah($data, $kondisi);
            $this->session->set_flashdata('success', 'Data Monitoring PJU <strong>Berhasil</strong> Diubah!');
            redirect('MonitoringPJU/Petugas');
        }
    }
    public function hapus($id_monitoring_pju, $id_petugas = null)
    {
        $link = $id_petugas ? 'MonitoringPJU/detail/' . $id_petugas : 'monitoringpju/petugas';
        if ($this->M_MonitoringPJU->hapus($id_monitoring_pju)) {
            $this->session->set_flashdata('success', 'Data PJU <strong>Berhasil</strong> Dihapus!');
            redirect($link);
        } else {
            $this->session->set_flashdata('error', 'Data PJU <strong>Gagal</strong> Dihapus!');
            redirect($link);
        }
    }
}
