<?php
	class Khs extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}

		}
		function index(){
			error_reporting(0);
			$nim = $this->session->userdata('nim');
			$data['title'] = "Kartu Hasil Studi - Academic Portal";
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
			if ($ta->jenis == 1) {
				# code...
				$jenis = 'Ganjil';
			}elseif ($ta->jenis == 2) {
				# code...
				$jenis = 'Genap';
			}elseif ($ta->jenis == 3) {
				# code...
				$jenis = 'Antara Ganjil Genap';
			}elseif ($ta->jenis == 4) {
				# code...
				$jenis = 'Antara Genap Ganjil';
			}
			$khs['ta'] = $ta->awal.' - '.$ta->akhir.' '.$jenis;
			$khs['nim'] = $nim;
			$khs['khs'] = $this->db->query("SELECT 
												master_nilai.*, 
												concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_jadwal_temp.*,
												master_mata_kuliah.nama_mata_kuliah as mata_kuliah,
												detail_tagihan.status as keuangan, 
												master_mata_kuliah.jumlah_sks 
												FROM `master_nilai` 
												LEFT JOIN master_jadwal_temp 
													ON master_jadwal_temp.id = master_nilai.id_jadwal 
												LEFT JOIN pegawai_biodata 
													ON pegawai_biodata.id = master_nilai.ndosen 
												LEFT JOIN master_mata_kuliah 
													ON master_mata_kuliah.kode_mata_kuliah = master_jadwal_temp.kode_mata_kuliah 
												LEFT JOIN detail_tagihan
													ON master_nilai.nim = detail_tagihan.nim
												WHERE 
													master_nilai.nim = '".$nim."'
													AND detail_tagihan.id_ta = $ta->id 
													AND master_jadwal_temp.id_tahun = $ta->id
													")->result();
			$khs['ta_history'] = $this->db->query("SELECT * FROM `master_tahun_ajaran` WHERE id <> $ta->id AND is_delete = '0' ORDER BY id DESC")->result();
			// var_dump($khs['ta_history']);
			// echo $ta->id;
			$khs['bobot'] = array('0' => 'E','1' => 'D', '2' => 'C', '3' => 'B', '4' => 'A');
			$data['content'] = $this->load->view('mhs/khs',$khs,true);
			$this->load->view('mhs/index',$data);
		}
		function cetak_khs_history($id=''){
			$this->load->model('Krs_mhs');
			$x = explode('-', $id);
			$ta_id = $x[0];
			$nim = $x[1];
			$khs['khs'] = $this->Krs_mhs->khs_history($nim, $ta_id);
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where id = ".$ta_id)->row();
			if ($ta->jenis == 1) {
				# code...
				$jenis = 'Ganjil';
			}elseif ($ta->jenis == 2) {
				# code...
				$jenis = 'Genap';
			}elseif ($ta->jenis == 3) {
				# code...
				$jenis = 'Antara Ganjil Genap';
			}elseif ($ta->jenis == 4) {
				# code...
				$jenis = 'Antara Genap Ganjil';
			}
			$khs['ta'] = $ta->awal.' - '.$ta->akhir.'/'.$jenis;
			$khs['biodata'] = $this->db->select('mahasiswa.*, program_studi.nama_jurusan, pegawai_biodata.*')
									   ->from('mahasiswa')
									   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
									   ->join('pegawai_biodata', 'mahasiswa.id_dsn_wali = pegawai_biodata.id_pegawai', 'left')
									   ->where('mahasiswa.nim', $nim)
									   ->get()->row();
			$khs['bid_akademik'] = $this->db->get_where('struktur_pegawai', array('id' => 1))->row();
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$data = $this->load->view('mhs/cetak_khs_history', $khs, TRUE);
			$pdfFilePath ="Kartu Hasil Studi - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
		function cetak_khs(){
			error_reporting(0);
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$nim = $this->session->userdata('nim');
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
			if ($ta->jenis == 1) {
				# code...
				$jenis = 'Ganjil';
			}elseif ($ta->jenis == 2) {
				# code...
				$jenis = 'Genap';
			}elseif ($ta->jenis == 3) {
				# code...
				$jenis = 'Antara Ganjil Genap';
			}elseif ($ta->jenis == 4) {
				# code...
				$jenis = 'Antara Genap Ganjil';
			}
			$khs['ta'] = $ta->awal.' - '.$ta->akhir.'/'.$jenis;
			$khs['jenis'] = $jenis;
			$khs['biodata'] = $this->db->select('mahasiswa.*, program_studi.nama_jurusan, pegawai_biodata.*')
									   ->from('mahasiswa')
									   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
									   ->join('pegawai_biodata', 'mahasiswa.id_dsn_wali = pegawai_biodata.id_pegawai', 'left')
									   ->where('mahasiswa.nim', $nim)
									   ->get()->row();
			$khs['khs'] = $this->db->query("SELECT 
												master_nilai.*, 
												concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_jadwal_temp.*,
												master_mata_kuliah.nama_mata_kuliah as mata_kuliah,
												detail_tagihan.status as keuangan, 
												master_mata_kuliah.jumlah_sks 
												FROM `master_nilai` 
												LEFT JOIN master_jadwal_temp 
													ON master_jadwal_temp.id = master_nilai.id_jadwal 
												LEFT JOIN pegawai_biodata 
													ON pegawai_biodata.id = master_nilai.ndosen 
												LEFT JOIN master_mata_kuliah 
													ON master_mata_kuliah.kode_mata_kuliah = master_jadwal_temp.kode_mata_kuliah 
												LEFT JOIN detail_tagihan
													ON master_nilai.nim = detail_tagihan.nim
												WHERE 
													master_nilai.nim = '".$nim."'
													AND detail_tagihan.id_ta = $ta->id 
													AND master_jadwal_temp.id_tahun = $ta->id
													")->result();
			$khs['bobot'] = array('0' => 'E','1' => 'D', '2' => 'C', '3' => 'B', '4' => 'A');
			$khs['bid_akademik'] = $this->db->get_where('struktur_pegawai', array('id' => 1))->row();
			// $this->load->view('mhs/cetak_khs', $khs);
			$data = $this->load->view('mhs/cetak_khs', $khs, TRUE);
			$pdfFilePath ="Kartu Hasil Studi - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
	}
?>
