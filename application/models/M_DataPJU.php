<?php

class M_DataPJU extends CI_Model
{
    protected $_table = 'data_pju';

    public function lihat()
    {
        $this->db->select('*');
        $this->db->from('data_pju');
        $this->db->join('petugas', 'petugas.id_petugas = data_pju.id_petugas');
        $query = $this->db->get();
        return $query->result();
    }
    public function jumlah()
    {
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }
    public function lihat_id($id_pju)
    {
        $query = $this->db->get_where($this->_table, ['id_pju' => $id_pju]);
        return $query->row();
    }

    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }
    public function ubah($data, $id_pju)
    {
        $query = $this->db->set($data);
        $query = $this->db->where(['id_pju' => $id_pju]);
        $query = $this->db->update($this->_table);
        return $query;
    }

    public function hapus($id_pju)
    {
        return $this->db->delete($this->_table, ['id_pju' => $id_pju]);
    }
}
