<?php
	class Perwalian extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
			$this->load->model('Model_pegawai');
		}
		public function index(){
			$mahasiswa_perwalian = $this->db->get_where('mahasiswa',array('id_dsn_wali'=>$this->session->get_userdata('id_user')))->result();
		}
		public function ubah_status_krs(){
			
		}
	}