<?php

class M_MonitoringPJU extends CI_Model
{
    protected $_table = 'monitoring_pju';

    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('monitoring_pju');
        $this->db->join('data_pju', 'data_pju.id_pju = monitoring_pju.id_pju');
        $this->db->join('petugas', 'petugas.id_petugas = monitoring_pju.id_petugas');
        $this->db->join('staff_administrasi', 'staff_administrasi.id_staff = monitoring_pju.id_staff');
        $query = $this->db->get();
        return $query->result();
    }

    public function lihat_by_id()
    {
        $this->db->select('*');
        $this->db->from('monitoring_pju');
        $this->db->join('data_pju', 'data_pju.id_pju = monitoring_pju.id_pju');
        $this->db->join('petugas', 'petugas.id_petugas = monitoring_pju.id_petugas');
        $this->db->join('staff_administrasi', 'staff_administrasi.id_staff = monitoring_pju.id_staff');
        $this->db->where('petugas.id_petugas', $this->session->login['id']);
        $query = $this->db->get();
        return $query->result();
    }

    public function jumlah()
    {
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }

    public function lihat_id($id_monitoring_pju)
    {
        $query = $this->db->get_where($this->_table, ['id_monitoring_pju' => $id_monitoring_pju]);
        return $query->row();
    }

    public function petugas_jpu_staff()
    {
        return $this->db->select('*')
            ->from('petugas')
            ->join('monitoring_pju', 'petugas.id_petugas=monitoring_pju.id_petugas')
            ->group_by('petugas.id_petugas')
            ->get()
            ->result();
    }

    public function petugas_jpu()
    {
        $id_petugas = $this->session->login['id'];
        return $this->db->select('*')
            ->from('monitoring_pju')
            ->join('data_pju', 'data_pju.id_pju = monitoring_pju.id_pju')
            ->where('monitoring_pju.id_petugas', $id_petugas)
            ->get()
            ->result();
    }

    public function petugas_jpu_detail($id)
    {
        $this->db->select('*');
        $this->db->from('monitoring_pju');
        $this->db->join('data_pju', 'data_pju.id_pju = monitoring_pju.id_pju');
        $this->db->join('petugas', 'petugas.id_petugas = monitoring_pju.id_petugas');
        $this->db->join('staff_administrasi', 'staff_administrasi.id_staff = monitoring_pju.id_staff');
        $this->db->where('petugas.id_petugas', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function ubah($data, $kondisi)
    {
        $this->db->update('monitoring_pju', $data, $kondisi);
        return TRUE;
    }

    public function hapus($id_monitoring_pju)
    {
        return $this->db->delete($this->_table, ['id_monitoring_pju' => $id_monitoring_pju]);
    }

    public function graph()
    {
        $query = "SELECT daya_monitoring_pju AS DAYA, COUNT(*) AS total_setiap_daya FROM monitoring_pju
        GROUP BY daya_monitoring_pju";
        $result = $this->db->query($query)->result();
        return $result;
    }
}
