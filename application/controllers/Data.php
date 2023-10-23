<?php
	use Zend\Crypt\Password\Bcrypt;
	class Data extends CI_Controller{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
			//$this->load->model('pmb_model/Model_pmb');
		}
		function index(){
			$data['title'] = "Mahasiswa - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$mhs['daftar_mhs'] = $this->db->get('mahasiswa')->result();
			$data['content'] = $this->load->view('data/index',$mhs,true);
			//$this->session->unset_userdata('passwd');
			$this->load->view('index',$data);
		}
		
	}