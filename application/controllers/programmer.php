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
		$this->load->model('M_login');
		$this->load->model('M_nominal');
		$this->load->model('M_tilang');
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
			$data["dataKaryawan"] = $this->M_karyawan->findById($id);
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_add_user_app.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}
	}

	public function saveUserApp(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$credential = array();
			$credential['username'] = $this->input->post('username');
			$credential['password'] = $password = md5($this->input->post('password'));
			$credential['hak_akses'] = $this->input->post('hakAkses');
			$nik = $this->input->post('nik');
			if($this->M_login->addUserApp($nik, $credential)){
				$this->userAppPage();
			}else{
				$this->userAppPage();
			}
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

	public function userAppPage(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataPengguna"] = $this->M_karyawan->selectUserApp();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_show_user_app.php',$data);
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

	public function deleteCategory(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$id = $this->input->post('idCategoryDelete');
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
			$id = $this->input->post('idSubCategoryDelete');
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

	public function updateCategory(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$id = $this->input->post('idCategory');
			$dataKategori = array();
			$dataKategori['id_kategori'] = $id;
			$dataKategori['nama_kategori'] = $this->input->post('categoryName');
			if($this->M_kategori->updateCategory($id,$dataKategori)){
				$this->kategoriPage();
			}
		}else{

		}
	}
	
	public function updateUserApp(){
			$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
			if($session!=""){
				$data = array();
				$pecah=explode("|",$session);
				$data["nik"]=$pecah[0];
				$data["nama"]=$pecah[1];
				$id = $this->input->post('idUser');
				$dataUser = array();
				$dataUser['id_akses'] = $id;
				$dataUser['username'] = $this->input->post('UsernameModal');
				$dataUser['password'] = $password = md5($this->input->post('PassModal'));
	            $dataUser['hak_akses'] = $this->input->post('chooseUserAppModal');
				if($this->M_kategori->updateUserApp($id,$dataUser)){
					$this->userAppPage();
				}
			}else{

			}
		}

		public function deleteUserApp(){
			$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
			if($session!=""){
				$data = array();
				$pecah=explode("|",$session);
				$data["nik"]=$pecah[0];
				$data["nama"]=$pecah[1];
				$dataUser = array();
				$id = $this->input->post('idUserDelete');
				$dataUser['status'] = "NON AKTIF";
				if($this->M_karyawan->updateUserApp($id,$dataUser)){
					$this->userAppPage();
				}
			}else{

			}
		}

			public function deleteNominal(){
			$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
			if($session!=""){
				$data = array();
				$pecah=explode("|",$session);
				$data["nik"]=$pecah[0];
				$data["nama"]=$pecah[1];
				$dataNominal = array();
				$id = $this->input->post('idNominalDelete');
				$dataNominal['status'] = "NON AKTIF";
				if($this->M_nominal->updateNominal($id,$dataNominal)){
					$this->finePage();
				}
			}else{

			}
		}

			public function updateNominal(){
			$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
			if($session!=""){
				$data = array();
				$pecah=explode("|",$session);
				$data["nik"]=$pecah[0];
				$data["nama"]=$pecah[1];
				$id = $this->input->post('idNominal');
				$dataNominal = array();
				$dataNominal['id_nominal'] = $id;
				$dataNominal['kode_jabatan'] = $this->input->post('chooseJabatanModal');
				$dataNominal['tilang_1'] = $this->input->post('tilang1');
	            $dataNominal['tilang_2'] = $this->input->post('tilang2');
				$dataNominal['tilang_3'] = $this->input->post('tilang3');
				$dataNominal['tilang_4'] = $this->input->post('tilang4');
				$dataNominal['tilang_5'] = $this->input->post('tilang5');
				if($this->M_nominal->updateNominal($id,$dataNominal)){
					$this->finePage();
				}
			}else{

			}
		}
	public function finePage(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataTarif"] = $this->M_nominal->selectAll();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php',$data);
			$this->load->view('SuperAdmin/v_fine_page.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');
		}
	}

	public function chooseDataTilang(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataTilang"] = $this->M_tilang->selectAll();
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php');
			$this->load->view('SuperAdmin/v_choose_data_tilang.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');

		}
	}

	public function editTilang($param){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKategori"] = $this->M_kategori->selectAll();
			$data["dataSubCategory"] = $this->M_kategori->selectSubCategory();
			$data["subCategoryArray"] = $this->M_kategori->selectSubCategoryArray();
			$data["dataTilang"] = $this->M_tilang->findById($param);
			$data["dataTilang"]->tanggal_tilang = $this->convertIndonesiaDate($data["dataTilang"]->tanggal_tilang);
			$this->load->view('SuperAdmin/v_header.php',$data);
			$this->load->view('SuperAdmin/v_sidebar.php');
			$this->load->view('SuperAdmin/v_edit_tilang.php',$data);
			$this->load->view('SuperAdmin/v_footer.php');

		}
	}

	public function saveUpdateTilang(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$dataTilang = array();
			$id = $this->input->post('idTilang');
			$dataTilang['nik'] = $this->input->post('nik');
			$dataTilang['nik_penilang'] = $data["nik"];
			$tanggal = explode(' ', $this->input->post('tanggalTilang'));
			$tanggal = $tanggal[2].'-'.$this->convertBulan($tanggal[1]).'-'.$tanggal[0];
			$dataTilang['tanggal_tilang'] = $tanggal;
			$dataTilang['id_sub_kategori'] = $this->input->post('chooseSubCategory');
			// echo $dataTilang['id_sub_kategori'];
			// exit();
			// $dataTilang['nominal_tilang'] = $this->input->post('nominalTilang');
			if($this->M_tilang->updateTilang($id,$dataTilang)){
				$this->index();
			}else{

			}
		}
	}

	public function convertIndonesiaDate($param){
		$tanggal = explode('-',$param);
		if($tanggal[1] == "01"){
			$bulan =  "Januari";
		}else if($tanggal[1]== "02"){
			$bulan =  "Februari";
		}else if($tanggal[1] == "03"){
			$bulan =  "Maret";
		}else if($tanggal[1] == "04"){
			$bulan =  "April";
		}else if($tanggal[1] == "05"){
			$bulan =  "Mei";
		}else if($tanggal[1] == "06"){
			$bulan =  "Juni";
		}else if($tanggal[1]== "07"){
			$bulan =  "Juli";
		}else if($tanggal[1]== "08"){
			$bulan =  "Agustus";
		}else if($tanggal[1] == "09"){
			$bulan = "September";
		}else if($tanggal[1] == "10"){
			$bulan =  "Oktober";
		}else if($tanggal[1] == "11"){
			$bulan =  "November";
		}else if($tanggal[1] == "12"){
			$bulan =  "Desember";
		}

		return $tanggal[2].' '.$bulan.' '.$tanggal[0];
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
}
