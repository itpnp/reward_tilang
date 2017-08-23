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

	public function kategoriPage(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKategori"] = $this->M_kategori->selectAll();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_add_kategori_tilang.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}
	}

	public function saveKategori(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataKategori = array();
			$dataKategori['nama_kategori'] = $this->input->post('categoryName');
			$dataKategori['status'] = "AKTIF";
			if($this->M_kategori->saveKategori($dataKategori)){
				$this->kategoriPage();
			}
		}
	}

	public function deleteCategory($id){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataKategori = array();
			$dataKategori['status'] = "NON AKTIF";
			if($this->M_kategori->updateCategory($id,$dataKategori)){
				$this->kategoriPage();
			}
		}else{

		}
	}

	public function subKategoriPage(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKategori"] = $this->M_kategori->selectAll();
			$data["dataSubKategori"] = $this->M_kategori->selectAllSubCategory();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_add_sub_kategori_tilang.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}
	}

	public function saveSubKategori(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataKategori = array();
			$dataKategori['id_kategori'] = $this->input->post('chooseCategory');
			$dataKategori['nama_sub_kategori'] = $this->input->post('subCategoryName');
			$dataKategori['status'] = "AKTIF";
			if($this->M_kategori->saveSubKategori($dataKategori)){
				$this->subKategoriPage();
			}
		}
	}

	public function deleteSubCategory(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataSubKategori = array();
			$id = $this->input->post('idSubCategory');
			echo $id;
			exit();
			$dataSubKategori['status'] = "NON AKTIF";
			if($this->M_kategori->updateSubCategory($id,$dataSubKategori)){
				$this->subKategoriPage();
			}
		}else{

		}
	}

	public function updateSubCategory(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$id = $this->input->post('idSubCategory');
			$dataSubKategori = array();
			$dataSubKategori['id_kategori'] = $this->input->post('chooseCategoryModal');
			$dataSubKategori['nama_sub_kategori'] = $this->input->post('subCategoryName');
			$dataSubKategori['status'] = "AKTIF";
			if($this->M_kategori->updateSubCategory($id,$dataSubKategori)){
				$this->subKategoriPage();
			}
		}else{

		}
	}
}
