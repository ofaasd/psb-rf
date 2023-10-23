<?php
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use Zend\Crypt\Password\Bcrypt;
	class Ijazah extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('pmb_model/Model_pmb');
			}
		function index(){
			$data['title'] = "Mahasiswa - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$mhs['daftar_mhs'] = $this->db->get('mahasiswa')->result();
			$mhs['setting'] = $this->db->order_by("id desc")->limit(1)->get('ijazah_setting')->row();
			$data['content'] = $this->load->view('ijazah/index',$mhs,true);
			$this->load->view('index',$data);
		}
		function simpan_setting(){
			$data = array(
				'status' => $this->input->post("status"),
				'ketua_prodi' => $this->input->post("ketua_prodi"),
				'ketua_sekolah' => $this->input->post("ketua_sekolah"),
				'tanggal_ijazah' => $this->input->post("tanggal_ijazah"),
				'tanggal_pembuatan' => $this->input->post("tanggal_pembuatan"),
				'tanggal_pembuatan' =>date('Y-m-d'),
				'izin' =>$this->input->post("izin"),
			);	
			$r = $this->db->insert("ijazah_setting",$data);
			if($r){
				redirect('ijazah/index');
			}else{
				redirect('ijazah/index');
			}
		}
		function cetak($nim){
			error_reporting(0);
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			
			$ijazah['biodata'] = $this->db->select('mahasiswa.*, program_studi.nama_jurusan, pegawai_biodata.*')
									   ->from('mahasiswa')
									   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
									   ->join('pegawai_biodata', 'mahasiswa.id_dsn_wali = pegawai_biodata.id_pegawai', 'left')
									   ->where('mahasiswa.nim', $nim)
									   ->get()->row();
			
			
			// $this->load->view('mhs/cetak_khs', $khs);
			$data = $this->load->view('ijazah/cetak', $ijazah, TRUE);
			$pdfFilePath ="Ijazah - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
}
?>