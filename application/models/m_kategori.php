<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_kategori extends CI_Model 
	{

		public function saveKategori($data) 
		{
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$success = $this->db->insert('kategori', $data);
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
		public function selectSubCategoryArray(){
			$this->db->select('*');
			$this->db->from('sub_kategori');
			$query = $this->db->get();
			$list = $query->result();
			$data = array();
			$indexRow = 0;
			foreach ($list as $row) {
				$data[$indexRow][0] = $row->id_sub_kategori;
				$data[$indexRow][1] = $row->id_kategori;
				$data[$indexRow][2] = $row->nama_sub_kategori;
				$indexRow++;
			}
			return $data;
		}
		public function selectAll(){
			$this->db->select('*');
			$this->db->from('kategori');
			$this->db->where("(status = 'AKTIF')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function updateCategory($id,$data){
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$this->db->where('id_kategori',$id);
			$success = $this->db->update('kategori', $data);
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

		public function selectAllSubCategory(){
			$this->db->select('*');
			$this->db->from('sub_kategori');
			$this->db->join('kategori', 'kategori.id_kategori = sub_kategori.id_kategori');
			$this->db->where("(kategori.status = 'AKTIF')", NULL, FALSE);
			$this->db->where("(sub_kategori.status = 'AKTIF')", NULL, FALSE);
			$query = $this->db->get();
			return $query->result();
		}

		public function saveSubKategori($data) 
		{
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$success = $this->db->insert('sub_kategori', $data);
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

		public function updateSubCategory($id,$data){
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$this->db->where('id_sub_kategori',$id);
			$success = $this->db->update('sub_kategori', $data);
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