<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->login['role'] != 'Petugas' && $this->session->login['role'] != 'Administrator') redirect();
        $this->data['aktif'] = 'dashboard';
        $this->load->model('M_DataPJU');
        $this->load->model('M_MonitoringPJU');
        $this->load->model('M_Petugas');
    }
    public function index()
    {
        $this->data['title'] = 'Dashboard';
        $this->data['jumlah_datapju'] = $this->M_DataPJU->jumlah();
        $this->data['jumlah_petugas'] = $this->M_Petugas->jumlah();
        $this->data['jumlah_monitoring_pju'] = $this->M_MonitoringPJU->jumlah();
        $this->data["chartDaya"] = $this->M_MonitoringPJU->graph(); // call method siswaPertahun di Model_chart
        $this->load->view('dashboard', $this->data);
    }
}
