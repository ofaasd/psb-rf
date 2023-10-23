<?php
class Krs extends CI_Controller
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
    function index(){
        $data['title'] = "KRS - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
        $krs['krs'] = $this->Krs_Model->tampil_mhs($ta)->result();
        $krs['total_input_krs'] = $this->Krs_Model->total_input_krs($ta)->num_rows();
        $krs['total_mhs'] = $this->Krs_Model->total_mhs()->num_rows();
        $krs['jenis'] = [
        				  '1' => 'Ganjil',
        				  '2' => 'Genap',
        				  '3' => 'Antara Gajil Genap',
        				  '4' => 'Antara Genap Gajil'
        				];
        $data['content'] = $this->load->view('krs/v_krs',$krs,true);
        $this->load->view('index',$data);
	}
	function input($nim=''){
		$data['title'] = "KRS - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		//$krs['mhs'] = $this->db->query("SELECT mahasiswa.*, pmb_keuangan.* FROM mahasiswa LEFT JOIN pmb_peserta ON mahasiswa.nims = pmb_peserta.nim INNER JOIN pmb_keuangan ON pmb_peserta.kelas = pmb_keuangan.kelas where mahasiswa.nim = '$nim'")->result_array(); 
		$krs['mhs'] = $this->db->get_where('mahasiswa', array('nim' => $nim))->result_array();
		$krs['matakuliah'] = $this->Krs_Model->tampil_mk()->result();
		$krs['kuota'] = $this->db->query("SELECT sum(sks) as sks FROM master_krs_temp WHERE nim = '$nim'")->row();
		$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
		$krs['detail_krs'] = $this->db->query("SELECT master_krs_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen FROM `master_krs_temp` LEFT JOIN pegawai_biodata on master_krs_temp.id_dosen = pegawai_biodata.id where master_krs_temp.nim = '$nim' AND master_krs_temp.id_tahun = $ta")->result();
		$krs['status'] = $this->db->query("SELECT * from master_krs_temp where nim = '$nim' ORDER BY id DESC LIMIT 1")->result_array();
		$krs['jkel'] = [1 => 'Reguler', 2 => 'Karyawan'];
		$ta_lalu = $this->db->query('select id from master_tahun_ajaran where id <> '.$ta.' order by id desc limit 1')->row()->id;
		$id_mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row()->id;
		$ips_lalu = $this->db->get_where('rekap_ips', ['id_mhs' => $id_mhs, 'id_ta' => $ta_lalu]);
		if ($ips_lalu->num_rows() > 0) {
			$ips = $ips_lalu->row()->ips;
		}else{
			$ips = 0;
		}
		$krs['batas'] = $this->bantuan->sksbatas($ips);
		$this->session->set_userdata('batas_sks', $krs['batas']);
		$krs['hidden'] = "";
		$data['content'] = $this->load->view('krs/v_input',$krs,true);
		$this->load->view('index',$data);
	}
	function inputKrsReset($nim=''){
		$data['title'] = "KRS - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		//$krs['mhs'] = $this->db->query("SELECT mahasiswa.*, pmb_keuangan.* FROM mahasiswa LEFT JOIN pmb_peserta ON mahasiswa.nims = pmb_peserta.nim INNER JOIN pmb_keuangan ON pmb_peserta.kelas = pmb_keuangan.kelas where mahasiswa.nim = '$nim'")->result_array(); 
		$krs['mhs'] = $this->db->get_where('mahasiswa', array('nim' => $nim))->result_array();
		$krs['matakuliah'] = $this->Krs_Model->tampil_mk()->result();
		$krs['kuota'] = $this->db->query("SELECT sum(sks) as sks FROM master_krs_temp WHERE nim = '$nim'")->row();
		$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
		$krs['detail_krs'] = $this->db->query("SELECT master_krs_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen FROM `master_krs_temp` LEFT JOIN pegawai_biodata on master_krs_temp.id_dosen = pegawai_biodata.id where master_krs_temp.nim = '$nim' AND master_krs_temp.id_tahun = $ta")->result();
		$krs['status'] = $this->db->query("SELECT * from master_krs_temp where nim = '$nim' ORDER BY id DESC LIMIT 1")->result_array();
		$krs['jkel'] = [1 => 'Reguler', 2 => 'Karyawan'];
		$krs['hidden'] = "hidden='false'";
		$data['content'] = $this->load->view('krs/v_input',$krs,true);
		$this->load->view('index',$data);
	}
	function resetbatas($nim=''){
		$this->session->set_userdata('batas_sks', 24);
		$krs['hidden'] = "hidden='true'";
		redirect('master/krs/inputKrsReset/'.$nim);
	}
	function cetak($nim=''){
		error_reporting(0);
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

		if ($ta_sebelum->num_rows() < 1) {
			$ta_sebelum = $ta->id;
		}else{
			$ta_sebelum = $ta_sebelum->row()->id_tahun;
		}
		$get_matkul_sebelum = $this->db->get_where('master_krs', array('nim' => $nim, 'id_tahun' => $ta_sebelum))->result();
		$jml_bobot = 0;
		$jml_sks = 0;
		foreach ($get_matkul_sebelum as $g) {
			$cek_grade = $this->db->get_where('table_transkrip', array('id_jadwal' => $g->id_jadwal, 'nim' => $nim));
			$grade = 'E';
			if ($cek_grade->num_rows() > 0) {
				$r = $cek_grade->row();
				$grade = $r->grade;
			}
			$cek_bobot = $this->bantuan->nbobot($grade);
			$jml_bobot += ($cek_bobot * $g->sks);
			$jml_sks += $g->sks;
		}
		$total = $jml_bobot / $jml_sks;
		$krs['ips_sebelum'] = 0;
		if (!is_nan($total)) {
			$krs['ips_sebelum'] = $total;
		}
		$krs['sks_maks'] = $this->bantuan->sksbatas($krs['ips_sebelum']);
		// $this->load->view('mhs/cetak_krs', $krs);
		$data = $this->load->view('mhs/cetak_krs', $krs, TRUE);
		$pdfFilePath ="Kartu Rencana Studi - ".$nim.".pdf"; 
		$mpdf->WriteHTML($data);
		$mpdf->Output($pdfFilePath, "D");
		exit;
	}
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
		if ($kuota_temp > $this->session->userdata('batas_sks')) {
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
								'id_tahun' => $id_tahun->id,
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
									'id_jadwal' => $jadwal_lama->id,
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
									'id_krs' => $k->id,
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
		$mhs = $this->db->get_where('mahasiswa', ['status' => 1])->result();
		foreach($mhs as $m){
			$get_nilai = $this->db->get_where('master_krs_temp', ['nim' => $m->nim])->result();
			$point_aktif = 0;
			$sks_aktif = 0;
			foreach ($get_nilai as $g) {
				$nilai = $this->db->get_where('master_nilai', ['id_jadwal' => $g->id_jadwal, 'nim' => $g->nim])->row()->nhuruf;
				$bobot = $this->bantuan->nbobot($nilai);
				$point_aktif += $bobot * $g->sks;
				$sks_aktif += $g->sks;
			}
			$ips = $point_aktif / $sks_aktif;
			if (is_nan($ips)) {
				$ips = 0;
			}
			$cek = $this->db->get_where('rekap_ips', ['id_mhs' => $m->id, 'id_ta' => $ta]);
			if ($cek->num_rows() > 0) {
				$this->db->update('rekap_ips', ['ips' => $ips], ['id' => $cek->row()->id]);
			}else{
				$this->db->insert('rekap_ips', ['id_mhs' => $m->id, 'id_ta' => $ta, 'ips' => $ips]);
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
}
?>