<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_login extends CI_Model 
	{

		public function login($data) 
		{
			$this->db = $this->load->database('default', true);
			$username = $data['username'];
			$password = md5($data['password']);
			// $password = $data['password'];
			// echo $password;
			// exit();
			$this->db->select('credential.*,karyawan.*,bagian.*');
			$this->db->from('credential');
			$this->db->join('karyawan', 'credential.id_akses = karyawan.id_akses');
			$this->db->join('bagian', 'karyawan.Kd_Bagian = bagian.Kd_Bagian');
			$this->db->where('credential.username', $username);
			$this->db->where('credential.password', $password);
			$query = $this->db->get();
			// $test = $query->row();
			// echo $test->Nm_Bagian;
			// exit();
			return $query->row();
		}

		public function select_user($data)
		{
			$this->db->select('user.*');
			$this->db->from('user');
			$this->db->where($data);
			$query = $this->db->get();
			return $query->row();
		}

		public function get_id($username)
		{
			$this->db->select('id_user');
			$this->db->from('user');
			$this->db->where('username', $username);
			$query = $this->db->get();
			$hasil = $query->num_rows();
			if ($hasil = 1) {
				foreach($query->result() as $hasil ){
					$id_user = $hasil->id_user;
				}
			}else{
				$id_user = false;
			}

				return $id_user;

		}

		// public function update($id, $data)
		// {
		// 	return $this->db->update('user', $data, array('id_user' => $id));
		// }

		public function addUserApp($nik, $credential){
			$this->db=$this->load->database('default',true);
			$this->db->trans_begin();
			$success = $this->db->insert('credential', $credential);
			if($success){
				$data['id_akses'] = $this->db->insert_id();
				$this->db->where('karyawan.NIK',$nik);
				$success = $this->db->update('karyawan',$data);
				if(!$success){
					$success = false;
					$errNo   = $this->db->_error_number();
					$errMess = $this->db->_error_message();
					array_push($errors, array($errNo, $errMess));
				}
			}
			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;
		}

	}

?>