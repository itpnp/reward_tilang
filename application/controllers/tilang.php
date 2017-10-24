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
		$this->load->library("Excel");
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
			$dataTilang['keterangan'] = $this->input->post('keterangan');
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

	public function reportPage(){
		$session=isset($_SESSION['userdata']) ? $_SESSION['userdata']:'';
		if($session!=""){
			$data = array();
			$pecah=explode("|",$session);
			$data["nik"]=$pecah[0];
			$data["nama"]=$pecah[1];
			$data["dataKaryawan"] = $this->M_karyawan->selectAll();
			
			$this->load->view('Tilang/v_header.php',$data);
			$this->load->view('Tilang/v_sidebar.php',$data);
			$this->load->view('Tilang/v_report_page.php',$data);
			$this->load->view('Tilang/v_footer.php');
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
		$objSheet->setTitle('TILANG BULAN '.$this->convertBulanAngka($bulan));

		$rowTitle = array();
		$rowTitle[] = 'B';
		$rowTitle[] = 'C';
		$rowTitle[] = 'D';
		$rowTitle[] = 'E';
		$rowTitle[] = 'F';
		$rowTitle[] = 'G';

		$rowHeader = 3;
		// write header
		$objSheet->getStyle('B'.$rowHeader)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objSheet->getStyle('B'.$rowHeader)->getFont()->setBold(true)->setSize(14);
		$objSheet->getCell('B'.$rowHeader)->setValue('DATA REKAP TILANG BULAN '.$this->convertBulanAngka($bulan).' '.$tahun);
		$objSheet->mergeCells('B'.$rowHeader.':G'.$rowHeader);

		$rowHeader++;
		$rowHeader++;
		$objSheet->getCell('B'.$rowHeader)->setValue('NO');
		$objSheet->getCell('C'.$rowHeader)->setValue('NAMA');
		$objSheet->getCell('D'.$rowHeader)->setValue('BAGIAN');
		$objSheet->getCell('E'.$rowHeader)->setValue('TANGGAL');
		$objSheet->getCell('F'.$rowHeader)->setValue('KATEGORI');
		$objSheet->getCell('G'.$rowHeader)->setValue('KETERANGAN');

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
		$data = $this->M_tilang->findByDate($bulan,$tahun);
		$no =1;
		foreach ($data as $row) {

			$objSheet->getCell('B'.$rowHeader)->setValue($no);
			$objSheet->getCell('C'.$rowHeader)->setValue($row->Nm_Karyawan);
			$objSheet->getCell('D'.$rowHeader)->setValue($row->Nm_Bagian);
			$objSheet->getCell('E'.$rowHeader)->setValue(date('d M Y',strtotime($row->tanggal_tilang)));
			$objSheet->getCell('F'.$rowHeader)->setValue($row->nama_kategori);
			$objSheet->getCell('G'.$rowHeader)->setValue($row->keterangan);
			for($i = 0; $i < count($rowTitle); $i++){
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getFont()->setBold(false)->setSize(12);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$objSheet->getStyle($rowTitle[$i].''.$rowHeader)->applyFromArray($borders);
			}
			$rowHeader++;
			$no++;
		}
		for($i=0; $i<sizeof($rowTitle); $i++){
			$objSheet->getColumnDimension($rowTitle[$i])->setAutoSize(true);
		}

		$rowHeader++;
		$rowHeader++;
		$rowHeader++;
		$rowHeader++;
		$rowHeader++;
		$objSheet->getCell('B'.$rowHeader)->setValue('Kudus, '.date('d M Y'));
		$objSheet->mergeCells('B'.$rowHeader.':C'.$rowHeader);
		$rowHeader++;
		$objSheet->getCell('B'.$rowHeader)->setValue('Hormat Kami, ');
		$rowHeader++;
		$rowHeader++;
		$rowHeader++;
		$rowHeader++;
		$objSheet->getCell('B'.$rowHeader)->setValue('(Petrus Henry)');

		$filename = "LAPORAN TILANG BULAN ".$this->convertBulanAngka($bulan).''.$tahun;
			// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');
			// It will be called file.xls
		header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
			// Write file to the browser
		$objWriter->save('php://output');
			// $objWriter->save("D://Test/".$filename.".xlsx");
	}

	public function convertBulanAngka($bulan){
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
