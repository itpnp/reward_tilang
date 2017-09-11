<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_nominal extends CI_Model 
	{

		public function selectAll() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('nominal_tilang.*,jabatan.*');
			$this->db->from('nominal_tilang');
			$this->db->join('jabatan', 'nominal_tilang.kode_jabatan = jabatan.Kd_Jabatan');
			$query = $this->db->get();
			return $query->result();
		}

		public function displayJabatan() 
		{
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('jabatan');
			$this->db->where("(status = 'AKTIF')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

			public function updateNominal($id,$data){
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$this->db->where('id_nominal',$id);
			$success = $this->db->update('nominal_tilang', $data);
			$this->db->trans_commit();
			$this->db->trans_complete();
			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}
			return $success;
		}

		public function findByJabatan($id)
		{
			
			$this->db = $this->load->database('default', true);
			$this->db->select('*');
			$this->db->from('nominal_tilang');
			$this->db->where('kode_jabatan', $id);
			$query = $this->db->get();
			return $query->row();
		}
		// public function findById($id) 
		// {
		// 	$this->db = $this->load->database('default', true);
		// 	$this->db->select('karyawan.*,bagian.*');
		// 	$this->db->from('karyawan');
		// 	$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
		// 	$this->db->where('karyawan.NIK', $id);
		// 	$query = $this->db->get();
		// 	return $query->row();
		// }

		// public function selectUserApp() 
		// {
		// 	$this->db = $this->load->database('default', true);
		// 	$this->db->select('karyawan.NIK,karyawan.Nm_Karyawan, credential.hak_akses, credential.id_akses');
		// 	$this->db->from('karyawan');
		// 	$this->db->join('credential', 'credential.id_akses = karyawan.id_akses');
		// 	$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
		// 	$query = $this->db->get();
		// 	return $query->result();
		// }
	}

?>