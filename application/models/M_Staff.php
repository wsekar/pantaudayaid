<?php

class M_Staff extends CI_Model
{
    protected $_table = 'staff_administrasi'; //tabel kasir

    public function lihat()
    {
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function jumlah()
    {
        // variabel query menampung data yang didapatkan dari tabel kasir
        $query = $this->db->get($this->_table);
        // mengembalikan nilai dari jumlah rows dalam tabel kasir
        return $query->num_rows();
    }

    public function lihat_id($id_staff)
    {
        // row : mengambil satu data dari hasil query
        // datanya berdasarkan id dalam tabel kasir
        $query = $this->db->get_where($this->_table, ['id_staff' => $id_staff]);
        return $query->row();
    }

    public function lihat_username($username_staff)
    {
        // row : mengambil satu data dari hasil query
        // datanya berdasarkan username_staff_pengguna dalam tabel kasir
        $query = $this->db->get_where($this->_table, ['username_staff' => $username_staff]);
        return $query->row();
    }
    public function buatkode()
    {
        $this->db->select('RIGHT(staff_administrasi.kode_staff,2) as kode_staff', FALSE);
        $this->db->order_by('kode_staff', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('staff_administrasi');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_staff) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
        $kodetampil = "ADM" . $batas;
        return $kodetampil;
    }
    public function tambah($data)
    {
        // insert/menambahkan ke tabel kasir
        return $this->db->insert($this->_table, $data);
    }

    public function ubah($data, $id_staff)
    {
        $query = $this->db->set($data); //set data yang akan diubah
        $query = $this->db->where(['id_staff' => $id_staff]); //keywordnya di idnya
        $query = $this->db->update($this->_table); //yang diupdate tabel kasir
        return $query;
    }

    public function hapus($id_staff)
    {
        // delete/hapus data berdasarkan id
        return $this->db->delete($this->_table, ['id_staff' => $id_staff]);
    }
}
