<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatPendidikan extends CI_Controller
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
		function index(){
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			//$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$hasil['url'] = "manage/riwayat";
			$this->load->view('simpeg/manage/content_profil',$hasil);

			//$this->load->view('index_simpeg',$data);
		}
		
	}
?>