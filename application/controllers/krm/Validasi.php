<?php
/**
* 
*/
class Validasi extends CI_Controller
{
	
	function __construct()
		{
			parent::__construct();
			if (!$this->authact->logged_in())
			{
				redirect("dashboard");
			}
			$this->load->model('Model_front');
			$this->load->library('email');
		}
	function index(){
		$get_id = $this->db->get_where('pegawai_biodata', array('nidn' => $this->session->userdata('npp')))->row()->id;
		$data['title'] = "KRM - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$krm['liat_mhs'] = $this->db->get_where('mahasiswa', array('id_dsn_wali' => $get_id))->result();
		$data['content'] = $this->load->view('krm/v_daftar_mhs_validasi',$krm,true);
		$this->load->view('index',$data);
	}
	function detail($nim){
		$data['title'] = "KRM - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$krm['detail_krs'] = $this->db->select('master_krs_temp.*, master_jadwal_temp.kode_mata_kuliah')
									  ->from('master_krs_temp')
									  ->join('master_jadwal_temp', 'master_krs_temp.id_jadwal = master_jadwal_temp.id', 'left')
									  ->where('master_krs_temp.nim', $nim)
									  ->get()->result();
		$krm['detail_mhs'] = $this->db->select('mahasiswa.*, pmb_peserta.*, master_krs_temp.is_publish')
									  ->from('mahasiswa')
									  ->join('pmb_peserta', 'mahasiswa.nim = pmb_peserta.nim', 'left')
									  ->join('master_krs_temp', 'mahasiswa.nim = master_krs_temp.nim', 'left')
									  ->where('mahasiswa.nim', $nim)
									  ->get()->row();
		$data['content'] = $this->load->view('krm/v_detail_krs',$krm,true);
		$this->load->view('index',$data);
	}
	function save($nim){
		$this->db->update('master_krs_temp', array('is_publish' => 1), array('nim' => $nim));
		redirect('krm/validasi/detail/'.$nim);
	}
}
?>