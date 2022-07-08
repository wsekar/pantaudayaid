<?php

class M_Petugas extends CI_Model
{
	protected $_table = 'petugas';

	public function lihat()
	{

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah()
	{
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id_petugas)
	{
		$query = $this->db->get_where($this->_table, ['id_petugas' => $id_petugas]);
		return $query->row();
	}

	public function lihat_username($username)
	{
		$query = $this->db->get_where($this->_table, ['username' => $username]);
		return $query->row();
	}
	public function buatkode()
	{
		$this->db->select('RIGHT(petugas.kode_petugas,3) as kode_petugas', FALSE);
		$this->db->order_by('kode_petugas', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('petugas');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode_petugas) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 3, "0", STR_PAD_LEFT);
		$kodetampil = "PTG" . $batas;
		return $kodetampil;
	}
	public function tambah($data)
	{
		// insert/menambahkan ke tabel kasir
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id_petugas)
	{
		$query = $this->db->set($data); //set data yang akan diubah
		$query = $this->db->where(['id_petugas' => $id_petugas]); //keywordnya di idnya
		$query = $this->db->update($this->_table); //yang diupdate tabel kasir
		return $query;
	}

	public function hapus($id_petugas)
	{
		// delete/hapus data berdasarkan id
		return $this->db->delete($this->_table, ['id_petugas' => $id_petugas]);
	}
}
