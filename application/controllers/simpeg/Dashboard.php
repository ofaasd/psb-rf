<?php
	class Dashboard extends CI_Controller
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
			$this->load->model('simpeg/Model_menu_tree');
		}

		function index()
		{
			$data['title'] = "Dashboard - SIMPEG";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
			$hasil['menu_tree'] = $hasil['menu_tree'] = $this->Model_menu_tree->get_all_p0();

			
			$hasil['query'] = $this->Model_pegawai->get_all();

			$data['content'] = $this->load->view('simpeg/dashboard/index',$hasil,true);
			$this->load->view('index_simpeg',$data);
		}
	}
?>