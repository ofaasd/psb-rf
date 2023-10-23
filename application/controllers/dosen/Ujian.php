<?php
	class Ujian extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
			$this->load->model('Model_simpeg');
		}

		function index()
		{
			$id = $this->authact->get_user_id();
			$id_pegawai = $this->db->get_where('pegawai_biodata', array('id_pegawai' => $id))->row()->id;
			$data['title'] = "Dashboard - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			//$data['content'] = $this->load->view('dosen/ujian','',true);
			//$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$hasil['jadwal'] = $this->db->select('master_jadwal_temp.*,master_mata_kuliah.nama_mata_kuliah')->from('master_jadwal_temp')->join('master_mata_kuliah','master_mata_kuliah.kode_mata_kuliah=master_jadwal_temp.kode_mata_kuliah','left')->where(array('master_jadwal_temp.id_dosen' => $id_pegawai, 'master_jadwal_temp.status' => 1))->get()->result();
			//$this->load->view('pegawai/v_krm',$query);
			$data['content'] = $this->load->view('dosen/v_krm_ujian',$hasil,true);
			$this->load->view('dosen/index',$data);
		} 
		function set_nilai($id_jadwal){
			$data['title'] = "Dashboard - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$hasil['jadwal'] = $this->db->select("master_jadwal_temp.*,master_mata_kuliah.nama_mata_kuliah")->join('master_mata_kuliah','master_mata_kuliah.kode_mata_kuliah=master_jadwal_temp.kode_mata_kuliah',"inner")->get_where('master_jadwal_temp',array('master_jadwal_temp.id'=>$id_jadwal))->row();
			$hasil['nilai']  = $this->db->select("master_nilai.*,mahasiswa.nama as nama_mhs")->join('mahasiswa','mahasiswa.nim=master_nilai.nim','inner')->get_where("master_nilai", array("id_jadwal"=>$id_jadwal))->result();
			$qr = $this->db->select('*')->from('master_nilai')->where('id_jadwal', $id_jadwal)->group_by('id_jadwal')->get()->result_array();
			if ($qr[0]['publish_tugas'] == 1) {
				$hasil['class_p_tugas'] = 'btn btn-danger';
				$hasil['stat_p_tugas'] = 'disabled';
			}else{
				$hasil['class_p_tugas'] = 'btn btn-primary';
				$hasil['stat_p_tugas'] = '';
			}

			if ($qr[0]['publish_uts'] == 1) {
				$hasil['class_p_uts'] = 'btn btn-danger';
				$hasil['stat_p_uts'] = 'disabled';
			}else{
				$hasil['class_p_uts'] = 'btn btn-primary';
				$hasil['stat_p_uts'] = '';
			}

			if ($qr[0]['publish_uas'] == 1) {
				$hasil['class_p_uas'] = 'btn btn-danger';
				$hasil['stat_p_uas'] = 'disabled';
			}else{
				$hasil['class_p_uas'] = 'btn btn-primary';
				$hasil['stat_p_uas'] = '';
			}

			if ($qr[0]['validasi_tugas'] == 1) {
				$hasil['class_v_tugas'] = 'btn btn-danger';
				$hasil['stat_v_tugas'] = 'disabled';
				$hasil['v_tugas'] = "readonly=''";
			}else{
				$hasil['class_v_tugas'] = 'btn btn-primary';
				$hasil['stat_v_tugas'] = '';
				$hasil['v_tugas'] = "";
			}

			if ($qr[0]['validasi_uts'] == 1) {
				$hasil['class_v_uts'] = 'btn btn-danger';
				$hasil['stat_v_uts'] = 'disabled';
				$hasil['v_uts'] = "readonly=''";
			}else{
				$hasil['class_v_uts'] = 'btn btn-primary';
				$hasil['stat_v_uts'] = '';
				$hasil['v_uts'] = "";
			}

			if ($qr[0]['validasi_uas'] == 1) {
				$hasil['class_v_uas'] = 'btn btn-danger';
				$hasil['stat_v_uas'] = 'disabled';
				$hasil['v_uas'] = "readonly=''";
			}else{
				$hasil['class_v_uas'] = 'btn btn-primary';
				$hasil['stat_v_uas'] = '';
				$hasil['v_uas'] = "";
			}

			$hasil['id_jadwal'] = $id_jadwal;
			$q = $this->db->get_where('master_persentase_nilai', array('id_jadwal' => $id_jadwal));

			$hasil['persentase'] = $q->num_rows();
			$hasil['tugas'] = 0;
			$hasil['uts'] = 0;
			$hasil['uas'] = 0;
			if ($q->num_rows() > 0) {
				$hasil['tugas'] = $q->row()->ntugas;
				$hasil['uts'] = $q->row()->nuts;
				$hasil['uas'] = $q->row()->nuas;
			}
			$data['content'] = $this->load->view('dosen/v_nilai_ujian',$hasil,true);
			$this->load->view('dosen/index',$data);
			
		}
		function save_nilai(){
			$id = $this->input->post('id');
			$ntugas = $this->input->post('ntugas');
			$nuts = $this->input->post('nuts');
			$nuas = $this->input->post('nuas');
			$ptugas = $this->input->post('ptugas');
			$puts = $this->input->post('puts');
			$puas = $this->input->post('puas');
			$id_jadwal = $this->input->post('id_jadwal');
			$hasil = "";
			foreach($id as $key=>$value){
				$tugas = 0;
				$uts = 0;
				$uas = 0;
				if (!empty($ntugas[$key])) {
					$tugas = $ntugas[$key];
				}
				if (!empty($nuts[$key])) {
					$uts = $nuts[$key];
				}
				if (!empty($nuas[$key])) {
					$uas = $nuas[$key];
				}
				$nakhir = ($tugas * $ptugas / 100) + ($uts * $puts / 100) + ($uas * $puas / 100);
				$nhuruf = $this->bantuan->nmutu($nakhir);
				$array = array(
					'ntugas' => $ntugas[$key],
					'nuts' => $nuts[$key],
					'nuas' => $nuas[$key],
					'nakhir' => $nakhir,
					'nhuruf' => $nhuruf
				);
				$hasil = $this->db->update('master_nilai',$array,array('id'=>$value));
			}
			if($hasil){
				redirect("/dosen/ujian/set_nilai/" . $id_jadwal);
			}
		
		}
		public function nmutu(){
			echo $this->bantuan->nmutu(72.042);
		}
		public function save_persentase(){
			$ntugas = $this->input->post('ntugas');
			$nuts = $this->input->post('nuts');
			$nuas = $this->input->post('nuas');
			$id_jadwal = $this->input->post('id_jadwal');
			$total = 0;
			$total = $ntugas + $nuts + $nuas;
			if ($total > 100) {
				$this->session->set_userdata('persentase', '<script>alert("Simpan Gagal, Total Maksimal 100.");</script>');
				redirect("/dosen/ujian/set_nilai/" . $id_jadwal);	
			}
			$data = array(
							'ntugas' => $ntugas,
							'nuts' => $nuts,
							'nuas' => $nuas,
							'id_jadwal' => $id_jadwal
						 );
			$cek = $this->db->get_where('master_persentase_nilai', array('id_jadwal' => $id_jadwal))->num_rows();
			if ($cek > 0) {
				$this->db->update('master_persentase_nilai', $data, array('id_jadwal' => $id_jadwal));
			}else{
				$this->db->insert('master_persentase_nilai', $data);
			}
			redirect("/dosen/ujian/set_nilai/" . $id_jadwal);
		}
		public function publish(){
			$id_jadwal = $this->input->post('id_jadwal');
			$jenis = $this->input->post('jenis');

			$data = array();
			if ($jenis == 'tugas') {
				$data = array('publish_tugas' => 1);
			}elseif ($jenis == 'uts') {
				// code...
				$data = array('publish_uts' => 1);
			}elseif ($jenis == 'uas') {
				// code...
				$data = array('publish_uas' => 1);
			}
			$this->db->update('master_nilai', $data, ['id_jadwal' => $id_jadwal]);
			echo json_encode(['res' => 1]);
		}
		public function validasi(){
			$id_jadwal = $this->input->post('id_jadwal');
			$jenis = $this->input->post('jenis');

			$data = array();
			if ($jenis == 'tugas') {
				$data = array('publish_tugas' => 1, 'validasi_tugas' => 1);
			}elseif ($jenis == 'uts') {
				// code...
				$data = array('publish_uts' => 1, 'validasi_uts' => 1);
			}elseif ($jenis == 'uas') {
				// code...
				$data = array('publish_uas' => 1, 'validasi_uas' => 1);
			}
			$this->db->update('master_nilai', $data, ['id_jadwal' => $id_jadwal]);
			echo json_encode(['res' => 1]);
		}
	}
?>