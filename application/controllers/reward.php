<?php defined('BASEPATH') OR exit('No direct script access allowed');

class reward extends CI_Controller {

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
		$this->load->model('M_lean');
		$this->load->model('M_kategori');
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
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php');
			$this->load->view('Reward/v_main.php',$data);
			$this->load->view('Reward/v_footer.php');

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
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php',$data);
			$this->load->view('Reward/v_choose_employee.php',$data);
			$this->load->view('Reward/v_footer.php');
		}
	}

	public function registerReward($id){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->findById($id);
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php',$data);
			$this->load->view('Reward/v_registration_form.php',$data);
			$this->load->view('Reward/v_footer.php');
		}
	}

	public function saveLean(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataLean = array();
			$dataLean['nik_admin'] = $data["nik"];
			$dataLean['judul'] = $this->input->post('judulProposal');
			$dataLean['tanggal_pengajuan'] = date("Y-m-d",strtotime($this->input->post('tanggalPengajuan')));
			$dataLean['nik'] = $this->input->post('nik');
			// echo $this->input->post('tanggalPengajuan');
			// exit();
			$dataLean['nominal_reward'] = 0;
			$dataLean['level_reward'] = 'PENGAJUAN';

			if($this->M_lean->saveLean($dataLean)){
				$this->dataReward();
			}else{

			}
		}
	}
	public function dataReward(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataReward"] = $this->M_lean->selectAll();
			$data["dataRewardArray"] = $this->M_lean->selectArray();
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php',$data);
			$this->load->view('Reward/v_reward_data.php',$data);
			// $this->load->view('Reward/v_footer.php');
		}
	}

	public function registerBounty($id){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataLean"] = $this->M_lean->findById($id);
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php',$data);
			$this->load->view('Reward/v_upgrade_status.php',$data);
			$this->load->view('Reward/v_footer.php');
		}
	}

	public function saveBounty(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataLean = array();
			$idLean = $this->input->post('idLean');
			$nominal = $this->input->post('nominalReward');
			$nominal = str_replace("Rp.","",$nominal);
			$nominal = str_replace(".","",$nominal);
			// echo $nominal;
			// exit();
			$dataLean['level_reward'] = $this->input->post('level');
			$dataLean['tanggal_penyerahan_reward'] = date("Y-m-d",strtotime($this->input->post('tanggalPenyerahan')));
			$dataLean['nominal_reward'] = $this->input->post('nominal_reward');

			if($this->M_lean->update($idLean,$dataLean)){
				$this->dataReward();
			}

			
		}
	}



}
