<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_tilang extends CI_Model 
	{

		public function saveTilang($data) 
		{
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$success = $this->db->insert('tilang', $data);
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

		public function selectAll(){
			$this->db->select('*');
			$this->db->from('tilang');
			$this->db->join('karyawan', 'karyawan.nik = tilang.nik');
			$this->db->join('sub_kategori', 'sub_kategori.id_sub_kategori = tilang.id_sub_kategori');
			$this->db->join('kategori', 'sub_kategori.id_kategori = kategori.id_kategori');
			$query = $this->db->get();
			return $query->result();
		}

		public function selectArray(){
			$this->db->select('*');
			$this->db->from('tilang');
			$this->db->join('karyawan', 'karyawan.nik = tilang.nik');
			$this->db->join('sub_kategori', 'sub_kategori.id_sub_kategori = tilang.id_sub_kategori');
			$this->db->join('kategori', 'sub_kategori.id_kategori = kategori.id_kategori');
			$query = $this->db->get();
			$list = $query->result();
			$data = array();
			$indexRow = 0;
			foreach ($list as $row) {
				$data[$indexRow][0] = $row->id_tilang;
				$data[$indexRow][1] = $row->nama_kategori;
				$indexRow++;
			}
			return $data;
		}
		
		public function selectAllByDept($deptName){
			$this->db->select('*');
			$this->db->from('tilang');
			$this->db->join('karyawan', 'karyawan.nik = tilang.nik');
			$this->db->join('bagian', 'karyawan.Kd_Bagian = bagian.Kd_Bagian');
			$this->db->join('sub_kategori', 'sub_kategori.id_sub_kategori = tilang.id_sub_kategori');
			$this->db->join('kategori', 'sub_kategori.id_kategori = kategori.id_kategori');
			$this->db->where('bagian.Nm_Bagian', $deptName);
			$query = $this->db->get();
			return $query->result();
		}

		public function selectArrayByDept($deptName){
			$this->db->select('*');
			$this->db->from('tilang');
			$this->db->join('karyawan', 'karyawan.nik = tilang.nik');
			$this->db->join('bagian', 'karyawan.Kd_Bagian = bagian.Kd_Bagian');
			$this->db->join('sub_kategori', 'sub_kategori.id_sub_kategori = tilang.id_sub_kategori');
			$this->db->join('kategori', 'sub_kategori.id_kategori = kategori.id_kategori');
			$this->db->where('bagian.Nm_Bagian', $deptName);
			$query = $this->db->get();
			$list = $query->result();
			$data = array();
			$indexRow = 0;
			foreach ($list as $row) {
				$data[$indexRow][0] = $row->id_tilang;
				$data[$indexRow][1] = $row->nama_kategori;
				$indexRow++;
			}
			return $data;
		}

		public function countTotalTicket($id,$month){
			$this->db->select('count(*) as total');
			$this->db->from('tilang');
			$this->db->join('karyawan', 'karyawan.nik = tilang.nik');
			// $this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$this->db->where('tilang.nik', $id);
			$this->db->where("MONTH(tanggal_tilang) = '".$month."'", NULL, FALSE);
			$query = $this->db->get();
			return $query->row();
		}

		// public function update($id,$data){
		// 	$this->db=$this->load->database('default',true);
		// 	$this->db->trans_begin();
		// 	$this->db->where('id_lean',$id);
		// 	$success = $this->db->update('lean', $data);
		// 	$this->db->trans_commit();
		// 	$this->db->trans_complete();
		// 	if(!$success){
		// 		$success = false;
		// 		$errNo   = $this->db->_error_number();
		// 		$errMess = $this->db->_error_message();
		// 		array_push($errors, array($errNo, $errMess));
		// 	}

		// return $success;
		// }

	}

?>