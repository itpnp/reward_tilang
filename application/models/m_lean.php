<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_lean extends CI_Model 
	{

		public function saveLean($data) 
		{
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$success = $this->db->insert('lean', $data);
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
			$this->db->from('lean');
			$this->db->join('karyawan', 'karyawan.nik = lean.nik');
			$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$query = $this->db->get();
			return $query->result();
		}

		public function selectAllByDept($deptName){
			$this->db->select('*');
			$this->db->from('lean');
			$this->db->join('karyawan', 'karyawan.nik = lean.nik');
			$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$this->db->where('bagian.Nm_Bagian', $deptName);
			$query = $this->db->get();
			return $query->result();
		}

		public function selectArray(){
			$this->db->select('*');
			$this->db->from('lean');
			$query = $this->db->get();
			$list = $query->result();
			$data = array();
			$indexRow = 0;
			foreach ($list as $row) {
				$data[$indexRow][0] = $row->id_lean;
				$data[$indexRow][1] = $row->level_reward;
				$indexRow++;
			}
			return $data;
		}

		public function selectArrayByDept($deptName){
			$this->db->select('*');
			$this->db->from('lean');
			$this->db->join('karyawan', 'karyawan.nik = lean.nik');
			$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$this->db->where('bagian.Nm_Bagian', $deptName);
			$query = $this->db->get();
			$list = $query->result();
			$data = array();
			$indexRow = 0;
			foreach ($list as $row) {
				$data[$indexRow][0] = $row->id_lean;
				$data[$indexRow][1] = $row->level_reward;
				$indexRow++;
			}
			return $data;
		}

		public function findById($id){
			$this->db->select('*');
			$this->db->from('lean');
			$this->db->join('karyawan', 'karyawan.nik = lean.nik');
			$this->db->join('bagian', 'bagian.Kd_Bagian = karyawan.Kd_Bagian');
			$this->db->where('lean.id_lean', $id);
			$query = $this->db->get();
			return $query->row();
		}

		public function update($id,$data){
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$this->db->where('id_lean',$id);
			$success = $this->db->update('lean', $data);
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

	}

?>