<?php defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();

		// if ($this->session->userdata('SESS_AKUN_IS_LOGIN') && $this->session->userdata('SESS_AKUN_USER_PRIV') === 1) {
		// 	redirect(base_url('akun/dashboard'));
		// }
		
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		$this->load->model('M_login');
		session_start();
		// $this->load->library('Userauth');
		
	}

	public function index()
	{
		$this->load->view('FrontPage/v_header.php');
		$this->load->view('FrontPage/v_login.php');
		$this->load->view('FrontPage/v_footer.php');
	}

	public function checkin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array();
		$data['username'] = $username;
		$data['password'] = $password;
		$dataUser = $this->M_login->login($data);
		if($dataUser !== null){
			$data = $dataUser->NIK."|".$dataUser->Nm_Karyawan;
			$_SESSION['userdata']=$data;
			if($dataUser->hak_akses == "SUPER ADMIN"){
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/programmer'>";
			}else if($dataUser->hak_akses == "REWARD"){
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/reward'>";
			}else if($dataUser->hak_akses == "SISTEM"){
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/tilang'>";
			}else{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."";
			}
		}else{
			echo "<meta http-equiv='refresh' content='0; url=".base_url().">";
		}

	}

	function logout()
	{
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
	}

	
}
