<?php
	class Ujian extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}

		}

		function index() 
		{
			$nim = $this->session->userdata('nim');
			$data['title'] = "Kartu Ujian - Academic Portal";
			$q = $this->db->select('master_krs_temp.*, master_krs_temp.sks as jml_sks, tbl_ujian.*,master_jadwal_temp.kode_mata_kuliah, master_jadwal_temp.id as jadwal_id, tbl_jadwal_ujian.*, tbl_tempat_ujian.*, master_keuangan_temp.*')
						  ->from('master_krs_temp')
						  ->join('tbl_ujian', 'master_krs_temp.id_jadwal = tbl_ujian.id_jadwal', 'left')
						  ->join('master_jadwal_temp', 'master_krs_temp.id_jadwal = master_jadwal_temp.id', 'left')
						  ->join('tbl_jadwal_ujian', 'master_krs_temp.id_jadwal = tbl_jadwal_ujian.id_jadwal', 'left')
						  ->join('tbl_tempat_ujian', 'master_krs_temp.id_jadwal = tbl_tempat_ujian.id_jadwal', 'left')
						  ->join('master_keuangan_temp', 'master_krs_temp.nim = master_keuangan_temp.nim', 'left')
						  ->where('master_krs_temp.nim', $nim)
						  ->get();
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
			$id_mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row()->id;
			$ujian['m'] = $this->db->get_where('master_keuangan_mhs', ['id_mahasiswa' => $id_mhs, 'id_tahun_ajaran' => $ta])->row();
			$ujian['detail'] = $q->result();
			// echo '<pre>';
			// var_dump($ujian['detail']);
			// echo '</pre>';
			$data['content'] = $this->load->view('mhs/ujian',$ujian,true);
			$this->load->view('mhs/index',$data);
		}
		public function cetak_ujian(){
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$nim = $this->session->userdata('nim');
			$q = $this->db->select('master_krs_temp.*, master_krs_temp.sks as jml_sks, tbl_ujian.*,master_jadwal_temp.kode_mata_kuliah, master_jadwal_temp.id as jadwal_id, tbl_jadwal_ujian.*, tbl_tempat_ujian.*, master_keuangan_temp.*')
						  ->from('master_krs_temp')
						  ->join('tbl_ujian', 'master_krs_temp.id_jadwal = tbl_ujian.id_jadwal', 'left')
						  ->join('master_jadwal_temp', 'master_krs_temp.id_jadwal = master_jadwal_temp.id', 'left')
						  ->join('tbl_jadwal_ujian', 'master_krs_temp.id_jadwal = tbl_jadwal_ujian.id_jadwal', 'left')
						  ->join('tbl_tempat_ujian', 'master_krs_temp.id_jadwal = tbl_tempat_ujian.id_jadwal', 'left')
						  ->join('master_keuangan_temp', 'master_krs_temp.nim = master_keuangan_temp.nim', 'left')
						  ->where('master_krs_temp.nim', $nim)
						  ->get();
			/* $krs['biodata'] = $this->db->select('pmb_peserta.*, fakultas.nama_fakultas as fakultas, program_studi.nama_jurusan as progdi, pegawai_biodata.*, mahasiswa.*')
									   ->from('pmb_peserta')
									   ->join('program_studi', 'pmb_peserta.pilihan1 = program_studi.id', 'left')
									   ->join('fakultas', 'program_studi.fakultas = fakultas.id', 'left')
									   ->join('mahasiswa', 'pmb_peserta.nim = mahasiswa.nim', 'left')
									   ->join('pegawai_biodata', 'mahasiswa.id_dsn_wali = pegawai_biodata.id', 'left')
									   ->where('pmb_peserta.nim', $nim)
									   ->get()->result(); */
			$krs['biodata'] = $this->db->select('fakultas.nama_fakultas as fakultas, program_studi.nama_jurusan as progdi, pegawai.nama as nama_dosen, mahasiswa.*')
									   ->from('mahasiswa')
									   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
									   ->join('fakultas', 'program_studi.fakultas = fakultas.id', 'left')
									   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
									   ->where('mahasiswa.nim', $nim)
									   ->get()->result();						   
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
			$id_mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row()->id;
			$krs['m'] = $this->db->get_where('master_keuangan_mhs', ['id_mahasiswa' => $id_mhs, 'id_tahun_ajaran' => $ta->id])->row();
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
			$krs['ta'] = $ta->awal.' - '.$ta->akhir;
			$krs['status'] = $jenis;
			$krs['jenis_ujian'] = $q->row();
			$krs['detail'] = $q->result();
			$data = $this->load->view('mhs/cetak_ujian', $krs, TRUE);
			$pdfFilePath ="Kartu Ujian - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}	
	}
?>