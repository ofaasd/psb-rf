<?php
class Khs extends CI_Controller
{
    function __construct()
		{
			# code..
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('matakuliah/Matakuliah_Model');
				$this->load->model('krs/Krs_Model');
        }
	function list_mhs(){
			$data['title'] = "KHS Mahasiswa - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$mhs['daftar_mhs'] = $this->db->get('mahasiswa')->result();
			$data['content'] = $this->load->view('list_mhs/list_mhs',$mhs,true);
			$this->load->view('index',$data);
	}
	function khs_detail($nim){
			error_reporting(0);
			$data['title'] = "Kartu Hasil Studi - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
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
			$this->session->set_userdata('nim', $nim);
			$khs['khs'] = $this->db->query("SELECT 
												master_nilai.*, 
												concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_jadwal_temp.*,
												master_mata_kuliah.nama_mata_kuliah as mata_kuliah,
												detail_tagihan.status as keuangan, 
												master_mata_kuliah.jumlah_sks 
												FROM `master_nilai` 
												INNER JOIN master_jadwal_temp 
													ON master_jadwal_temp.id = master_nilai.id_jadwal 
												INNER JOIN pegawai_biodata 
													ON pegawai_biodata.id = master_nilai.ndosen 
												INNER JOIN master_mata_kuliah 
													ON master_mata_kuliah.kode_mata_kuliah = master_jadwal_temp.kode_mata_kuliah 
												LEFT JOIN detail_tagihan
													ON master_nilai.nim = detail_tagihan.nim
												WHERE 
													master_nilai.nim = '".$nim."' 
													AND master_jadwal_temp.id_tahun = $ta->id
													AND detail_tagihan.id_ta = $ta->id
													")->result();
			$khs['ta_history'] = $this->db->query("SELECT * FROM `master_tahun_ajaran` WHERE id <> $ta->id AND is_delete = '0' ORDER BY id DESC")->result();
			
			$data['content'] = $this->load->view('mhs/khs_admin',$khs,true);
			$this->load->view('index',$data);
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
												INNER JOIN master_jadwal_temp 
													ON master_jadwal_temp.id = master_nilai.id_jadwal 
												INNER JOIN pegawai_biodata 
													ON pegawai_biodata.id = master_nilai.ndosen 
												INNER JOIN master_mata_kuliah 
													ON master_mata_kuliah.kode_mata_kuliah = master_jadwal_temp.kode_mata_kuliah 
												LEFT JOIN detail_tagihan
													ON master_nilai.nim = detail_tagihan.nim
												WHERE 
													master_nilai.nim = '".$nim."' 
													AND master_jadwal_temp.id_tahun = $ta->id
													AND detail_tagihan.id_ta = $ta->id
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
	// function cetak($nim=''){
	// 	error_reporting(0);
	// 	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
	// 	$krs['biodata'] = $this->db->select('mahasiswa.*, program_studi.nama_jurusan, pegawai.nama as nama_dosen')
	// 							   ->from('mahasiswa')
	// 							   ->join('program_studi', 'mahasiswa.id_program_studi = program_studi.id', 'left')
	// 							   ->join('pegawai', 'mahasiswa.id_dsn_wali = pegawai.id', 'left')
	// 							   ->where('mahasiswa.nim', $nim)
	// 							   ->get()->row();
	// 	$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
	// 	if ($ta->jenis == 1) {
	// 		# code...
	// 		$jenis = 'Ganjil';
	// 	}elseif ($ta->jenis == 2) {
	// 		# code...
	// 		$jenis = 'Genap';
	// 	}elseif ($ta->jenis == 3) {
	// 		# code...
	// 		$jenis = 'Antara Ganjil Genap';
	// 	}elseif ($ta->jenis == 4) {
	// 		# code...
	// 		$jenis = 'Antara Genap Ganjil';
	// 	}
	// 	$krs['ta'] = $ta->awal.' - '.$ta->akhir;
	// 	$krs['status'] = $jenis;
	// 	$krs['krs'] = $this->db->query("SELECT master_krs_temp.*,  
	// 									master_jadwal_temp.kode_mata_kuliah, 
	// 									master_tahun_ajaran.*,
	// 									master_mata_kuliah.jumlah_sks 
	// 									FROM `master_krs_temp` 
	// 									INNER JOIN master_jadwal_temp ON master_krs_temp.id_jadwal = master_jadwal_temp.id 
	// 									INNER JOIN master_tahun_ajaran ON master_krs_temp.id_tahun = master_tahun_ajaran.id
	// 									INNER JOIN master_mata_kuliah ON master_jadwal_temp.kode_mata_kuliah = master_mata_kuliah.kode_mata_kuliah 
	// 									WHERE master_krs_temp.nim = '$nim' AND master_krs_temp.id_tahun = $ta->id")->result();
	// 	$ta_sebelum = $this->db->query("SELECT * FROM `master_krs` where nim = '$nim' order by id DESC limit 1");
	// 	if ($ta_sebelum->num_rows() < 1) {
	// 		$ta_sebelum = $ta->id;
	// 	}
	// 	$get_matkul_sebelum = $this->db->get_where('master_krs', array('nim' => $nim, 'id_tahun' => $ta_sebelum))->result();
		
	// 	$jml_bobot = 0;
	// 	$jml_sks = 0;
	// 	foreach ($get_matkul_sebelum as $g) {
	// 		$cek_grade = $this->db->get_where('table_transkrip', array('id_jadwal' => $g->id_jadwal, 'nim' => $nim));
	// 		$grade = 'E';
	// 		if ($cek_grade->num_rows() > 0) {
	// 			$r = $cek_grade->row();
	// 			$grade = $r->grade;
	// 		}
	// 		$cek_bobot = $this->bantuan->nbobot($grade);
	// 		$jml_bobot += ($cek_bobot * $g->sks);
	// 		$jml_sks += $g->sks;
	// 	}
	// 	$total = $jml_bobot / $jml_sks;
	// 	$krs['ips_sebelum'] = 0;
	// 	if (!is_nan($total)) {
	// 		$krs['ips_sebelum'] = $total;
	// 	}
	// 	$krs['sks_maks'] = $this->bantuan->sksbatas($krs['ips_sebelum']);
	// 	// $this->load->view('mhs/cetak_krs', $krs);
	// 	$data = $this->load->view('mhs/cetak_krs', $krs, TRUE);
	// 	$pdfFilePath ="Kartu Rencana Studi - ".$nim.".pdf"; 
	// 	$mpdf->WriteHTML($data);
	// 	$mpdf->Output($pdfFilePath, "D");
	// 	exit;
	// }
	function list_jadwal(){
		$id=$this->input->post('id');
		$kelas = '';
		if($this->session->userdata('kelas') == 1){
			$kelas = 'and master_jadwal_temp.kelas = 1';
		}else if($this->session->userdata('kelas') == 2){
			$kelas = 'and master_jadwal_temp.kelas = 2';
		}
		// $data = $this->db->get_where('master_jadwal', array('kode_mata_kuliah' => $id))->result();
		$data = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_ruang.kapasitas FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id left join master_ruang on master_jadwal_temp.ruang = master_ruang.nama_ruang where master_jadwal_temp.kode_mata_kuliah = '$id' and master_jadwal_temp.status = 1 $kelas")->result();
		echo json_encode($data);
	}

	function tambah_jadwal($data){
		$pecah = explode('-',$data);
		$nim = $pecah[0];
		$kuota = $this->db->query("SELECT sum(sks) as sks FROM master_krs_temp WHERE nim = '$nim'")->row();
		$get_matkul = $this->db->get_where('master_mata_kuliah', array('kode_mata_kuliah' => $pecah[1]))->result_array();
		$kuota_temp = $kuota->sks + $get_matkul[0]['jumlah_sks'];
		// echo $kuota_temp;
		if ($kuota_temp > 24) {
			# code...
			$this->session->set_userdata('krs_bentrok','KRS yang di ambil melebihi Kuota.');
			redirect('master/krs/input/'.$nim);
		}
		$matakuliah = $get_matkul[0]['nama_mata_kuliah'];
		$jmlsks = $get_matkul[0]['jumlah_sks'];
		$hari = $pecah[2];
		$sesi = urldecode($pecah[3]).'-'.urldecode($pecah[4]);
		$ruang = $pecah[5];
		$dosen = urldecode($pecah[6]);
		$id_jadwal = $pecah[7];
		$kelas = $pecah[8];
		$hitung = $this->db->get_where('master_jadwal_temp',array('id' => $id_jadwal))->result_array();
		$kuota_diambil = $hitung[0]['kuota_diambil'] + 1;
		$id_tahun = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
		$data = array(
					  'id_jadwal' => $id_jadwal,
					  'id_tahun' => $id_tahun->id,
					  'nim' => $nim,
					  'mata_kuliah' => $matakuliah,
					  'sks' => $jmlsks,
					  'hari' => $hari,
					  'sesi' => $sesi,
					  'ruang' => $ruang,
					  'kelas' => $kelas,
					  'id_dosen' => $dosen,
					  'is_publish' => 0
					);
		$data_nilai = array(
								'id_jadwal' => $id_jadwal,
								'nim' => $nim,
								'ndosen' => $dosen,
								'is_krs' => 0
						   );
		$cek_bentrok = $this->db->get_where('master_krs_temp', array('nim' => $nim, 'hari' => $hari, 'sesi' => $sesi));
		$jml = $cek_bentrok->num_rows();
		// echo $jml;
		$bentrok = $cek_bentrok->result_array();
		// var_dump($data);
		if ($jml > 0) {
			# code...
			$this->session->set_userdata('krs_bentrok','Jadwal Bentrok Matakuliah '.$bentrok[0]['mata_kuliah'].' dengan '.$matakuliah);
				redirect('master/krs/input/'.$nim);
		}else{
			$cek_bentrok_sama = $this->db->get_where('master_krs_temp', array('mata_kuliah' => $matakuliah, 'nim' => $nim));
			$ada = $cek_bentrok_sama->num_rows();
			$detail = $cek_bentrok_sama->row();
			if ($ada > 0) {
				# code...
				$this->session->set_userdata('krs_bentrok','Jadwal Bentrok Matakuliah '.$detail->mata_kuliah.' dengan '.$matakuliah);
				redirect('master/krs/input/'.$nim);
			}
			$this->db->update('master_jadwal_temp',array('kuota_diambil' => $kuota_diambil),array('id' => $id_jadwal));
			$cek_nilai = $this->db->get_where('master_nilai', $data_nilai)->num_rows();
			if ($cek_nilai > 0) {
				# code...
				$this->db->update('master_nilai',$data_nilai, $data_nilai);
			}else{
				$this->db->insert('master_nilai', $data_nilai);
			}
			// for ($i=0; $i < 14; $i++) { 
				# code...
				// $this->db->insert('master_presensi', array('id_jadwal' => $id_jadwal, 'nim' => $nim));
			// }
			$r = $this->db->insert('master_krs_temp', $data);
		}
		if ($r) {
			# code...
			$this->session->set_userdata('krs', '<script type="text/javascript">
                                                            alert("KRS berhasil di tambahkan."); 
                                                        </script>');
				redirect('master/krs/input/'.$nim);
		}else{
			$this->session->set_userdata('krs', '<script type="text/javascript">
                                                            alert("KRS gagal di tambahkan."); 
                                                        </script>');
				redirect('master/krs/input/'.$nim);
		}

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
				redirect('master/krs/input/'.$pecah[1]);
			}else{
				$this->session->set_userdata('krs', '<script type="text/javascript">
                                                            alert("KRS gagal di hapus."); 
                                                        </script>');
				redirect('master/krs/input/'.$pecah[1]);
			}
	}
	function publish($nim){
		$this->db->update('master_nilai',array('is_krs' => 1),array('nim' => $nim));
		$r = $this->db->update('master_krs_temp',array('is_publish' => 1),array('nim' => $nim));
		if ($r) {
			# code... 
			$this->session->set_userdata('krs', '<script type="text/javascript">
														alert("KRS berhasil di publish."); 
													</script>');
			redirect('master/krs/input/'.$nim);
		}else{
			$this->session->set_userdata('krs', '<script type="text/javascript">
														alert("KRS gagal di publish."); 
													</script>');
			redirect('master/krs/input/'.$nim);
		}
	}
	function nonaktif(){
		$pin = $this->input->post('pin');
		$year = date('Y');
		if ($pin == 'krs'.$year) {
			$r = $this->db->update('master_krs_temp',array('is_aktif' => 0));
			if ($r) {
				# code...
				$this->session->set_userdata('krs', '<script type="text/javascript">
															alert("Pindah Semester Berhasil"); 
														</script>');
				redirect('master/krs/');
			}
		}else{
			$this->session->set_userdata('krs', '<script type="text/javascript">
															alert("PIN yang anda masukan salah!!!"); 
														</script>');
				redirect('master/krs/');
		}
	}
	function transkrip(){
		$jadwal_lama = $this->db->get('master_jadwal_temp')->result();
		foreach ($jadwal_lama as $jadwal_lama) {
			# code...
			$data_jadwal = array(
									'kode_jadwal' => $jadwal_lama->kode_jadwal,
									'id_tahun' => $jadwal_lama->id_tahun,
									'id_dosen' => $jadwal_lama->id_dosen,
									'kode_mata_kuliah' => $jadwal_lama->kode_mata_kuliah,
									'hari' => $jadwal_lama->hari,
									'sesi' => $jadwal_lama->sesi,
									'ruang' => $jadwal_lama->ruang,
									'kuota_diambil' => $jadwal_lama->kuota_diambil,
									'status' => $jadwal_lama->status
								);
			$this->db->insert('master_jadwal', $data_jadwal);
			$this->db->empty_table('master_jadwal_temp');
		}
		$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
		$this->db->update('master_keuangan_temp', array('is_bayar' => 0, 'operasional' => 0, 'seragam' => 0, 'kemahasiswaan' => 0, 'spi' => 0, 'sks' => 0, 'total' => 0, 'is_publish' => 0), array('id_tahun' => $ta->id));
		$krs_lama = $this->db->get('master_krs_temp')->result();
		foreach ($krs_lama as $k) {
			# code...
			$data_krs = array(
									'id_jadwal' => $k->id_jadwal,
									'id_tahun' => $k->id_tahun,
									'nim' => $k->nim,
									'mata_kuliah' => $k->mata_kuliah,
									'sks' => $k->sks,
									'hari' => $k->hari,
									'sesi' => $k->sesi,
									'ruang' => $k->ruang,
									'id_dosen' => $k->id_dosen,
									'is_publish' => $k->is_publish,
									'log_date' => $k->log_date
								);
			$this->db->insert('master_krs', $data_krs);
			$this->db->empty_table('master_krs_temp');
		}
		$nilai = $this->db->get('master_nilai')->result();
		$nilai_sekarang = '';
		foreach ($nilai as $n) {
			# code...
			$where = array(
							'id_jadwal' => $n->id_jadwal,
							'nim' => $n->nim
						  );
			if (is_null($n->nhuruf)) {
				$huruf = 'E';
			}else{
				$huruf = $n->nhuruf;
			}
			$data_nilai = array(
									'id_jadwal' => $n->id_jadwal,
									'nim' => $n->nim,
									'nakhir' => $n->nakhir,
									'grade' => $huruf
							   );
			$q = $this->db->get_where('table_transkrip',$where);
			$r = $q->row();
			$cek_duplicate = $q->num_rows();
			if ($cek_duplicate > 1) {
				# code...
				$nilai_lama = $n->nakhir;
				$nilai_baru = $r->nakhir;
				if ($nilai_lama < $nilai_baru) {
					# code...
					$nilai_sekarang = $r->grade;
				}elseif ($nilai_baru < $nilai_lama) {
					# code...
					$nilai_sekarang = $n->nhuruf;
				}
				$this->db->update('table_transkrip',array('grade' => $nilai_sekarang),$where);
			}else{
				$this->db->insert('table_transkrip',$data_nilai);
			}
		}
		redirect('master/krs/');
	}
	function log(){
		$data['data'] = $this->db->select('master_krs_temp.*, mahasiswa.nama')
								 ->from('master_krs_temp')
								 ->join('mahasiswa', 'master_krs_temp.nim = mahasiswa.nim', 'left')
								 ->get()->result();
		$this->load->view('krs/log', $data);
	}
	function sinkron(){
		$rs_nilai = $this->db->select('*')->from('master_nilai')->where('id_tahun' , 1)->group_by('id_jadwal ', 'ASC')->get()->result();
		foreach($rs_nilai as $r){
			$id = $this->db->get_where('master_jadwal', ['id' => $r->id_jadwal])->row()->id;
			$data = array('id_jadwal' => $r->id_jadwal);
			$this->db->update('master_jadwal', $data, ['id' => $id]); 
		}
	}
}
?>