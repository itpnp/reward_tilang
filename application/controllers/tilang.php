<?php defined('BASEPATH') OR exit('No direct script access allowed');

class tilang extends CI_Controller {

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
		$this->load->model('M_tilang');
		$this->load->model('M_nominal');
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
			$data["dataTilang"] = $this->M_tilang->selectAll();
			$data["dataTilangArray"] = $this->M_tilang->selectArray();
			$this->load->view('Tilang/v_header.php',$data);
			$this->load->view('Tilang/v_sidebar.php');
			$this->load->view('Tilang/v_main.php',$data);
			// $this->load->view('Tilang/v_footer.php');

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
			
			$this->load->view('Tilang/v_header.php',$data);
			$this->load->view('Tilang/v_sidebar.php',$data);
			$this->load->view('Tilang/v_choose_employee.php',$data);
			$this->load->view('Tilang/v_footer.php');
		}
	}

	public function registerTicket($id){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->findById($id);
			$data["dataKategori"] = $this->M_kategori->selectAll();
			$data["subCategory"] = $this->M_kategori->selectSubCategoryArray();
			$data["jumlahTilang"] = $this->M_tilang->countTotalTicket($id,date('m'));
			$data["dendaTilang"] = 0;
			$nominal = $this->M_nominal->findByJabatan($data["dataKaryawan"]->Kd_Jabatan);
			if($data["jumlahTilang"]->total==0){
				$data["dendaTilang"] = $nominal->tilang_1;
			}else if($data["jumlahTilang"]->total==1){
				$data["dendaTilang"] = $nominal->tilang_2;
			}else if($data["jumlahTilang"]->total==2){
				$data["dendaTilang"] = $nominal->tilang_3;
			}else if($data["jumlahTilang"]->total==3){
				$data["dendaTilang"] = $nominal->tilang_4;
			}else if($data["jumlahTilang"]->total==4){
				$data["dendaTilang"] = $nominal->tilang_5;
			}
			$this->load->view('Tilang/v_header.php',$data);
			$this->load->view('Tilang/v_sidebar.php',$data);
			$this->load->view('Tilang/v_form_tilang.php',$data);
			$this->load->view('Tilang/v_footer.php');
		}
	}

	public function saveTilang(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataTilang = array();
			$dataTilang['nik'] = $this->input->post('nik');
			$dataTilang['nik_penilang'] = $data["nik"];
			$tanggal = explode(' ', $this->input->post('tanggalTilang'));
			$tanggal = $tanggal[2].'-'.$this->convertBulan($tanggal[1]).'-'.$tanggal[0];
			$dataTilang['tanggal_tilang'] = $tanggal;
			$dataTilang['id_sub_kategori'] = $this->input->post('chooseSubCategory');
			$dataTilang['nominal_tilang'] = $this->input->post('nominalTilang');
			if($this->M_tilang->savetilang($dataTilang)){
				$this->index();
			}else{

			}
		}
	}

	public function convertBulan($bulan){
		if($bulan == "Januari"){
			return "01";
		}else if($bulan == "Februari"){
			return "02";
		}else if($bulan == "Maret"){
			return "03";
		}else if($bulan == "April"){
			return "04";
		}else if($bulan == "Mei"){
			return "05";
		}else if($bulan == "Juni"){
			return "06";
		}else if($bulan == "Juli"){
			return "07";
		}else if($bulan == "Agustus"){
			return "08";
		}else if($bulan == "September"){
			return "09";
		}else if($bulan == "Oktober"){
			return "10";
		}else if($bulan == "November"){
			return "11";
		}else if($bulan == "Desember"){
			return "12";
		}

	}

	public function search()
	{
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');

			$data["dataTilang"] = $this->M_tilang->findByDate($bulan,$tahun);
			$data["dataTilangArray"] = $this->M_tilang->findByDateArray($bulan,$tahun);
			$this->load->view('Tilang/v_header.php',$data);
			$this->load->view('Tilang/v_sidebar.php');
			$this->load->view('Tilang/v_main.php',$data);
			// $this->load->view('Tilang/v_footer.php');

		}
		
	}
}
