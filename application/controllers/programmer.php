<?php defined('BASEPATH') OR exit('No direct script access allowed');

class programmer extends CI_Controller {

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
		session_start();
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		$this->load->model('M_karyawan');
		// $this->load->library('Userauth');
		
	}

	public function index()
	{
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php');
			$this->load->view('SuperAdmin/v_main.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');

		}
		
	}

	public function showDataKaryawan(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->selectAll();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_show_employee.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}
		
	}

	public function chooseEmployee(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->selectAll();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_choose_employee.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}
		
	}

	public function registerUserApp($id){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->selectAll();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_add_user_app.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}

	}
}
