<?php
	
	use Zend\Crypt\Password\Bcrypt;

	class Nilai extends CI_Controller
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
			$this->load->model('Model_pegawai');
		}
		function index(){
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			
			$hasil['query'] = $this->Model_pegawai->get_all();

			$data['content'] = $this->load->view('nilai/index',$hasil,true);
			$this->load->view('index',$data);
		}
		function list_matkul($id='')
		{
			$id_pegawai = $this->db->get_where('pegawai_biodata', array('id_pegawai' => $id))->row()->id;
			$data['title'] = "Dashboard - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$hasil['jadwal'] = $this->db->select('master_jadwal_temp.*,master_mata_kuliah.nama_mata_kuliah')->from('master_jadwal_temp')->join('master_mata_kuliah','master_mata_kuliah.kode_mata_kuliah=master_jadwal_temp.kode_mata_kuliah','left')->where(array('master_jadwal_temp.id_dosen' => $id_pegawai, 'master_jadwal_temp.status' => 1))->get()->result();
			//$this->load->view('pegawai/v_krm',$query);
			$data['content'] = $this->load->view('nilai/list_matkul',$hasil,true);
			$this->load->view('index',$data);
		}
		function set_nilai($id_jadwal){
			$data['title'] = "Dashboard - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$hasil['jadwal'] = $this->db->select("master_jadwal_temp.*,master_mata_kuliah.nama_mata_kuliah")->join('master_mata_kuliah','master_mata_kuliah.kode_mata_kuliah=master_jadwal_temp.kode_mata_kuliah',"inner")->get_where('master_jadwal_temp',array('master_jadwal_temp.id'=>$id_jadwal))->row();
			$hasil['nilai']  = $this->db->select("master_nilai.*,mahasiswa.nama as nama_mhs")->join('mahasiswa','mahasiswa.nim=master_nilai.nim','inner')->get_where("master_nilai", array("id_jadwal"=>$id_jadwal))->result();
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
			$data['content'] = $this->load->view('nilai/v_nilai_ujian',$hasil,true);
			$this->load->view('index',$data);
			
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
				redirect("/master/nilai/set_nilai/" . $id_jadwal);
			}
		
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
				redirect("/master/nilai/set_nilai/" . $id_jadwal);	
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
			redirect("/master/nilai/set_nilai/" . $id_jadwal);
		}
		public function validasi_all(){
			$data = [
						'publish_tugas' => 1,
						'publish_uts' => 1,
						'publish_uas' => 1,
						'validasi_tugas' => 1,
						'validasi_uts' => 1,
						'validasi_uas' => 1
					];
			$this->db->update('master_nilai', $data);
			$ta = $this->db->query("SELECT * FROM `master_tahun_ajaran` where is_aktif = 1")->row()->id;
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
			redirect('master/nilai');
		}
		public function tampilJangkauan(){
			$j = $this->input->post('jangkauan');
			if ($j == 1) {
				
			}
		}
	}
?>