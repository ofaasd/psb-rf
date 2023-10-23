<?php
	class Krs extends CI_Controller
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
			$data['title'] = "Kartu Rencana Studi - Academic Portal";
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
			$krs['ta'] = $ta->awal.' - '.$ta->akhir.' '.$jenis;
			$krs['krs'] = $this->db->query("SELECT master_krs_temp.*, 
											concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, 
											master_jadwal_temp.kode_mata_kuliah, 
											master_tahun_ajaran.*,
											master_mata_kuliah.jumlah_sks, master_jadwal_temp.id as jadwal_id
											FROM `master_krs_temp` 
											LEFT JOIN pegawai_biodata ON master_krs_temp.id_dosen = pegawai_biodata.id 
											LEFT JOIN master_jadwal_temp ON master_krs_temp.id_jadwal = master_jadwal_temp.id 
											LEFT JOIN master_tahun_ajaran ON master_krs_temp.id_tahun = master_tahun_ajaran.id
											LEFT JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah 
											WHERE master_krs_temp.nim = '$nim' AND master_krs_temp.id_tahun = $ta->id")->result();
			//echo $this->db->last_query();
			$krs['ta_history'] = $this->db->query("SELECT * FROM `master_tahun_ajaran` WHERE id != $ta->id ORDER BY id DESC")->result();
			// echo $ta->id;
			$data['content'] = $this->load->view('mhs/krs',$krs,true);
			$this->load->view('mhs/index',$data);
		}
		public function cetak_krs(){
			$this->load->model('Krs_mhs');
			$nim = $this->session->userdata('nim');
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
			$krs['biodata'] = $this->db->select('mahasiswa.*, program_studi.nama_jurusan, pegawai.nama as nama_dosen')
									   ->from('mahasiswa')
									   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
									   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
									   ->where('mahasiswa.nim', $nim)
									   ->get()->row();
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
			$krs['ta'] = $ta->awal.' - '.$ta->akhir;
			$krs['status'] = $jenis;
			$krs['krs'] = $this->db->query("SELECT master_krs_temp.*,  
											master_jadwal_temp.kode_mata_kuliah, 
											master_tahun_ajaran.*,
											master_mata_kuliah.jumlah_sks 
											FROM `master_krs_temp` 
											INNER JOIN master_jadwal_temp ON master_krs_temp.id_jadwal = master_jadwal_temp.id 
											INNER JOIN master_tahun_ajaran ON master_krs_temp.id_tahun = master_tahun_ajaran.id
											INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah 
											WHERE master_krs_temp.nim = '$nim' AND master_krs_temp.id_tahun = $ta->id")->result();
			$ta_sebelum = $this->db->query("SELECT * FROM `master_krs` where nim = '$nim' order by id DESC limit 1");
			$ta_before = $ta_sebelum->row()->id_tahun;
			if ($ta_sebelum->num_rows() < 1) {
				$ta_before = $ta->id;
			}else{
				$ta_sebelum = $ta_sebelum->row()->id_tahun;
			}

			$jml_bobot = 0;
			$jml_sks = 0;

			$nilai_sebelum = $this->Krs_mhs->khs_history($nim, $ta_before);
			foreach($nilai_sebelum as $nil){
				$cek_bobot = $this->bantuan->nbobot($nil->nhuruf);
				$jml_bobot += ($cek_bobot * $nil->jumlah_sks);
				$jml_sks += $nil->jumlah_sks;
			}
			$total = $jml_bobot / $jml_sks;
			$krs['ips_sebelum'] = 0;
			if (!is_nan($total)) {
				$krs['ips_sebelum'] = $total;
			}
			$krs['sks_maks'] = $this->bantuan->sksbatas($krs['ips_sebelum']);
			$this->load->view('mhs/cetak_krs', $krs);
			$data = $this->load->view('mhs/cetak_krs', $krs, TRUE);
			$pdfFilePath ="Kartu Rencana Studi - ".$nim.".pdf"; 
			$mpdf->WriteHTML($data);
			$mpdf->Output($pdfFilePath, "D");
			exit;
		}
		function detail_presensi($id_jadwal){
			$nim = $this->session->userdata('nim');
			$data['title'] = "Detail Kehadiran - Academic Portal";
			$krs['detail'] = $this->db->get_where('master_presensi', array('id_jadwal' => $id_jadwal, 'nim' => $this->session->userdata('nim')))->result();
			$krs['total'] = $this->db->get_where('master_presensi', array('id_jadwal' => $id_jadwal, 'nim' => $this->session->userdata('nim')))->num_rows();
			$krs['jadwal'] = $this->db->get_where('master_krs_temp', array('id_jadwal' => $id_jadwal, 'nim' => $this->session->userdata('nim')))->row();
			$data['content'] = $this->load->view('mhs/presensi',$krs,true);
			$this->load->view('mhs/index',$data);
		}
		function delete($id){
		$pecah = explode('-',$id);
		$get_acuan = $this->db->get_where('master_krs_temp', array('id' => $pecah[0]))->result_array();
		$id_jadwal = $get_acuan[0]['id_jadwal'];
		$get_kuota = $this->db->get_where('master_jadwal_temp', array('id' => $id_jadwal))->result_array();
		$jml = $get_kuota[0]['kuota_diambil'] - 1;
		$this->db->delete('master_nilai', array('id_jadwal' => $id_jadwal, 'nim' => $pecah[1]));
		// for ($i=0; $i < 14; $i++) { 
			// $this->db->delete('master_presensi', array('id_jadwal' => $id_jadwal, 'nim' => $pecah[1]));
		// }
		$r = $this->db->delete('master_krs_temp', array('id' => $pecah[0]));
			if ($r) {
				# code...
				$this->session->set_userdata('krs', '<script type="text/javascript">
                                                            alert("KRS berhasil di hapus."); 
                                                        </script>');
				$this->db->update('master_jadwal_temp',array('kuota_diambil' => $jml),array('id' => $id_jadwal));
				redirect('mhs/input_krs');
			}else{
				$this->session->set_userdata('krs', '<script type="text/javascript">
                                                            alert("KRS gagal di hapus."); 
                                                        </script>');
				redirect('mhs/input_krs');
			}
	}
	}
?>
