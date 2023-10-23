<?php
/**
* 
*/
class Perwalian extends CI_Controller
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
		$data['content'] = $this->load->view('krm/v_daftar_mhs',$krm,true);
		$this->load->view('index',$data);
	}
}
?>