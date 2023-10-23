<?php
	class Absensi extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url() . 'login/simpeg');
			}
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
		}

		function index()
		{
			$data['title'] = "Dashboard - SIMPEG";
			$data['menu'] = $this->Model_simpeg->getMenu(2);
			$hasil['menu_tree'] = $this->Model_simpeg->menuSimpegUser();

			
			$hasil['query'] = $this->Model_pegawai->get_all();

			$data['content'] = $this->load->view('simpeguser/absensi/index',$hasil,true);
			$this->load->view('index_simpeg',$data);
		}
		
	}
?>