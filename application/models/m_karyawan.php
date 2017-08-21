<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_karyawan extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('karyawan.*,bagian.*');
			$this->db->from('karyawan');
			$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$query = $this->db->get();
			return $query->result();
		}

		public function findById($id) 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('karyawan.*,bagian.*');
			$this->db->from('karyawan');
			$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$this->db->where('karyawan.NIK', $id);
			$query = $this->db->get();
			return $query->row();
		}
	}

?>