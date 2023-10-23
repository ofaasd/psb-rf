<?php
/**
* 
*/
class Input_krs extends CI_Controller
{
	function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}
			$this->load->model('krs/Krs_Model');
			$this->load->model('Model_keuangan');

		}
	function index(){
		$nim = trim($this->session->userdata('nim'));
		$id = $this->session->userdata('id_user');
		$data['title'] = "Mahasiswa - Academic Portal";
		$krs['cek_input'] = $this->db->get('jadwal_krs')->row()->status;
		$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row();
		$q = $this->db->get_where('master_keuangan_mhs',array('id_mahasiswa'=>$id, 'id_tahun_ajaran' => $ta->id));
		if ($q->num_rows() > 0) {
			$krs['cek_keuangan'] = $q->row()->krs;
		}else{
			$this->db->insert('master_keuangan_mhs', array('id_mahasiswa' => $id, 'id_tahun_ajaran' => $ta->id, 'krs' => 0, 'uts' => 0,'uas' => 0));
			$krs['cek_keuangan'] = $q->row()->krs;
		}
		$cek = $this->db->get_where('pmb_peserta', array('nim' => $nim))->num_rows();

		$krs['mhs'] = $this->db->get_where('mahasiswa', array('nim' => $nim))->result_array();
		
		$krs['matakuliah'] = $this->Krs_Model->tampil_mk_by_prodi($krs['mhs'][0]['id_program_studi'])->result();
		$krs['kuota'] = $this->db->query("SELECT sum(sks) as sks FROM master_krs_temp WHERE nim = '$nim'")->row();
		$krs['detail_krs'] = $this->db->query("SELECT master_krs_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen FROM `master_krs_temp` LEFT JOIN pegawai_biodata on master_krs_temp.id_dosen = pegawai_biodata.id INNER JOIN master_jadwal_temp ON master_krs_temp.id_jadwal = master_jadwal_temp.id where master_krs_temp.nim = '$nim' AND master_krs_temp.id_tahun = $ta->id")->result();
		$krs['status'] = $this->db->query("SELECT * from master_krs_temp where nim = '$nim' ORDER BY id DESC LIMIT 1")->result_array();
		$ta_lalu = $this->db->query('select id from master_tahun_ajaran where id <> '.$ta->id.' order by id desc limit 1')->row()->id;
		$id_mhs = $this->db->get_where('mahasiswa', ['nim' => $nim])->row()->id;
		$ips_lalu = $this->db->get_where('rekap_ips', ['id_mhs' => $id_mhs, 'id_ta' => $ta_lalu]);
		if ($ips_lalu->num_rows() > 0) {
			$ips = $ips_lalu->row()->ips;
		}else{
			$ips = 0;
		}
		$krs['batas'] = $this->bantuan->sksbatas($ips);
		$this->session->set_userdata('limit_sks', $krs['batas']);
		$data['content'] = $this->load->view('mhs/input_krs',$krs,true);
		$this->load->view('mhs/index',$data);
	}
	function list_jadwal(){
		$id=$this->input->post('id');
		$nim = $this->session->userdata('nim');
		 
		$kelas = $this->db->get_where('mahasiswa', array('nim' => $nim))->row()->kelas;
		
		// $data = $this->db->get_where('master_jadwal', array('kode_mata_kuliah' => $id))->result();
		$data = $this->db->query("SELECT master_jadwal_temp.*, concat(pegawai_biodata.gelar_depan,' ',pegawai_biodata.nama_lengkap,' ',pegawai_biodata.gelar_belakang) as nama_dosen, master_ruang.kapasitas FROM `master_jadwal_temp` LEFT JOIN pegawai_biodata on master_jadwal_temp.id_dosen = pegawai_biodata.id left join master_ruang on master_jadwal_temp.ruang = master_ruang.nama_ruang where master_jadwal_temp.kode_mata_kuliah = '".$id."' and master_jadwal_temp.status = 1")->result();
		//$array = array("id"=>$id,"nim"=>$nim,"kelas"=>$kelas);
		echo json_encode($data);
		//echo json_encode($array);
	}
	function tambah_jadwal($urls){
		$data = $urls;
		$pecah = explode('-',$data);
		$nim = trim($this->session->userdata('nim'));
		$kuota = $this->db->query("SELECT sum(sks) as sks FROM master_krs_temp WHERE nim = '$nim'")->row();
		$get_matkul = $this->db->get_where('master_mata_kuliah', array('kode_mata_kuliah' => $pecah[1]))->result_array();
		$kuota_temp = $kuota->sks + $get_matkul[0]['jumlah_sks'];
		echo $nim.'<br>'.$this->session->userdata('limit_sks');
		// echo $kuota_temp;
		if ($kuota_temp > $this->session->userdata('limit_sks')) {
			# code...
			$this->session->set_userdata('krs_bentrok','KRS yang di ambil melebihi Kuota.');
			redirect('mhs/input_krs/');
		}
		$matakuliah = $get_matkul[0]['nama_mata_kuliah'];
		$jmlsks = $get_matkul[0]['jumlah_sks'];
		$hari = $pecah[2];
		$sesi = urldecode($pecah[3]).'-'.urldecode($pecah[4]);
		$ruang = $pecah[5];
		$dosen = urldecode($pecah[6]);
		$id_jadwal = $pecah[7];
		$kelas = $pecah[8];
		// var_dump($data);
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
					  'id_dosen' => $dosen,
					  'kelas' => $kelas,
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
		if ($jml > 0) {
			# code...
			$this->session->set_userdata('krs_bentrok','Jadwal Bentrok Matakuliah '.$bentrok[0]['mata_kuliah'].' dengan '.$matakuliah);
				redirect('mhs/input_krs/');
		}else{
			$cek_bentrok_sama = $this->db->get_where('master_krs_temp', array('mata_kuliah' => $matakuliah, 'nim' => $nim));
			$ada = $cek_bentrok_sama->num_rows();
			$detail = $cek_bentrok_sama->row();
			if ($ada > 0) {
				# code...
				$this->session->set_userdata('krs_bentrok','Jadwal Bentrok Matakuliah '.$detail->mata_kuliah.' dengan '.$matakuliah);
				redirect('mhs/input_krs/');
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
				redirect('mhs/input_krs/');
		}else{
			$this->session->set_userdata('krs', '<script type="text/javascript">
                                                            alert("KRS gagal di tambahkan."); 
                                                        </script>');
				redirect('mhs/input_krs/');
		}

	}
}
?>