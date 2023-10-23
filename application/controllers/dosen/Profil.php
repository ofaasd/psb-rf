<?php

	use Zend\Crypt\Password\Bcrypt;

	class Biodata extends CI_Controller
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
			if(!empty($this->uri->segment('4'))){
				$_SESSION['npp'] = $this->uri->segment('4');
			}
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu(2);
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$hasil['riwayat_tree'] = $this->load->view('simpeguser/biodata/riwayat_tree',NULL,true);
			$data['content'] = $this->load->view('simpeguser/biodata/profil',$hasil,true);

			$this->load->view('dosen/index',$data);


		}