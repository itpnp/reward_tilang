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
		$this->load->library("Excel");
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
			$dataLean['nominal_reward'] = $nominal;

			if($this->M_lean->update($idLean,$dataLean)){
				$this->dataReward();
			}

			
		}
	}

	public function searchByMonth()
	{
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$bulan = $this->input->post('bulan');
			$tahun = $this->input->post('tahun');
			$data["dataReward"] = $this->M_lean->findByDate($bulan,$tahun);
			$data["dataRewardArray"] = $this->M_lean->findByDateArray($bulan,$tahun);
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php');
			$this->load->view('Reward/v_reward_data.php',$data);
			// $this->load->view('Tilang/v_footer.php');

		}
		
	}

	public function reportPage(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->selectAll();
			$this->load->view('Reward/v_header.php',$data);
			$this->load->view('Reward/v_sidebar.php',$data);
			$this->load->view('Reward/v_generate_report.php',$data);
			$this->load->view('Reward/v_footer.php');
		}
	}

	public function generateReport(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
		// set default font size
		$objPHPExcel->getDefaultStyle()->getFont()->setSize(11);
		// create the writer
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		// writer already created the first sheet for us, let's get it
		$objSheet = $objPHPExcel->getActiveSheet();
		// rename the sheet
		$objSheet->setTitle('REWARD BULAN '.$this->convertBulan($bulan).' '.$tahun);

		$rowTitle = array();
		$rowTitle[] = 'B';
		$rowTitle[] = 'C';
		$rowTitle[] = 'D';
		$rowTitle[] = 'E';
		$rowTitle[] = 'F';

		$rowHeader = 3;
		// write header
		$objSheet->getStyle('B'.$rowHeader)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getStyle('B'.$rowHeader)->getFont()->setBold(true)->setSize(14);
		$objSheet->getCell('B'.$rowHeader)->setValue('PT. PURA NUSAPERSADA UNIT HOLOGRAFI');
		$objSheet->mergeCells('B'.$rowHeader.':F'.$rowHeader);

		$rowHeader++;
		$objSheet->getStyle('B'.$rowHeader)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getStyle('B'.$rowHeader)->getFont()->setBold(true)->setSize(14);
		$objSheet->getCell('B'.$rowHeader)->setValue('IDE / GAGASAN LEAN MANUFACTURING '.$this->convertBulan($bulan).' '.$tahun);
		$objSheet->mergeCells('B'.$rowHeader.':F'.$rowHeader);

		$rowHeader++;
		$rowHeader++;
		$objSheet->getCell('B'.$rowHeader)->setValue('NIK');
		$objSheet->getCell('C'.$rowHeader)->setValue('Nama Lengkap');
		$objSheet->getCell('D'.$rowHeader)->setValue('Nama Dept');
		$objSheet->getCell('E'.$rowHeader)->setValue('IDE / GAGASAN');
		$objSheet->getCell('F'.$rowHeader)->setValue('Reward');

		$borders = array(
	      'borders' => array(
	        'inside'     => array(
	          'style' => PHPExcel_Style_Border::BORDER_THIN,

	          'color' => array(
	            'argb' => '00000000'
	          )
	        ),
	        'outline' => array(
	          'style' => PHPExcel_Style_Border::BORDER_THIN,
	          'color' => array(
	             'argb' => '00000000'
	          )
	        )
	      )
	    );

		for($i = 0; $i < count($rowTitle); $i++){
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getFont()->setBold(true)->setSize(12);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->applyFromArray($borders);
		}

		$rowHeader++;
		$data = $this->M_lean->findByDate($bulan,$tahun);
		foreach ($data as $row) {
			$objSheet->getCell('B'.$rowHeader)->setValue($row->NIK);
			$objSheet->getCell('C'.$rowHeader)->setValue($row->Nm_Karyawan);
			$objSheet->getCell('D'.$rowHeader)->setValue($row->Nm_Bagian);
			$objSheet->getCell('E'.$rowHeader)->setValue($row->judul);
			$objSheet->getCell('F'.$rowHeader)->setValue($row->nominal_reward);
			for($i = 0; $i < count($rowTitle); $i++){
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getFont()->setBold(false)->setSize(12);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->applyFromArray($borders);
			}
						$rowHeader++;
		}
		for($i=0; $i<sizeof($rowTitle); $i++){
			$objSheet->getColumnDimension($rowTitle[$i])->setAutoSize(true);
		}
		$filename = "LAPORAN REWARD BULAN ".$this->convertBulan($bulan).''.$tahun;
			// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');
			// It will be called file.xls
		header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
			// Write file to the browser
		$objWriter->save('php://output');
			// $objWriter->save("D://Test/".$filename.".xlsx");
	}

	public function convertBulan($bulan){
		if($bulan == "01"){
			return "Januari";
		}else if($bulan == "02"){
			return "Februari";
		}else if($bulan == "03"){
			return "Maret";
		}else if($bulan == "04"){
			return "April";
		}else if($bulan == "05"){
			return "Mei";
		}else if($bulan == "06"){
			return "Juni";
		}else if($bulan == "07"){
			return "Juli";
		}else if($bulan == "08"){
			return "Agustus";
		}else if($bulan == "09"){
			return "September";
		}else if($bulan == "10"){
			return "Oktober";
		}else if($bulan == "11"){
			return "November";
		}else if($bulan == "12"){
			return "Desember";
		}

	}
}
