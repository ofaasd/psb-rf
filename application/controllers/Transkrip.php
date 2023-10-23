<?php
	
	class Transkrip extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
			}
		function index(){
			$data['title'] = "Transkrip - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$mhs['daftar_mhs'] = $this->db->get('mahasiswa')->result();
			$data['content'] = $this->load->view('transkrip/index',$mhs,true);
			$this->load->view('index',$data);
		}
		function mahasiswa(){
			$nim = $this->input->post('nim');
			$data['biodata'] = $this->db->get_where('mahasiswa', ['nim' => $nim])->result();
			return $this->load->view('transkrip/tampil', $data);
		}
		function transkrip(){
			$nim = 'A1202018';
			// $nim = $this->input->post('nim');
			$data['data'] = $this->db->select('table_transkrip.*, master_jadwal.*, master_mata_kuliah.*, mahasiswa.nim, mahasiswa.nama')
						  ->from('table_transkrip')
						  ->join('master_jadwal', 'table_transkrip.id_jadwal = master_jadwal.id_jadwal', 'left')
						  ->join('mahasiswa', 'table_transkrip.nim = mahasiswa.nim', 'left')
						  ->join('master_mata_kuliah', 'master_jadwal.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah', 'left')
						  ->where('table_transkrip.nim', $nim)
						  ->group_by('master_mata_kuliah.kelompok_mata_kuliah', 'ASC')
						  ->get()->result();
			$data['mk'] = $this->db->limit(30)->get('master_mata_kuliah');
			$data['mk1'] = $this->db->limit(20)->get('master_mata_kuliah');
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$this->load->view('mhs/cetak_transkrip', $data);
			ob_start();
			$data = $this->load->view('mhs/cetak_transkrip', $data, TRUE);
			ob_end_clean();
			var_dump($datas);
			$pdfFilePath ="Kartu Hasil Studi - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
		public function transkrips(){

		    $data['mk'] = $this->db->limit(20)->get('master_mata_kuliah');
			$data['mk1'] = $this->db->limit(20)->get('master_mata_kuliah');
		    $this->load->library('pdf');

		    $this->pdf->setPaper('A4', 'potrait');
		    $this->pdf->filename = "laporan-petanikode.pdf";
		    $this->pdf->load_view('mhs/cetak_transkrip', $data);
		}
}
?>