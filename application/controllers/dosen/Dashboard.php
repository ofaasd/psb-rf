<?php
	class Dashboard extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
		}

		function index()
		{
			$data['title'] = "Dashboard - Academic Portal";
			//$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$data['content'] = $this->load->view('default','',true);
			$this->load->view('dosen/index',$data);
		}
		function logout()
		{
			$this->authact->logout();
			redirect('');
		}
	}
?>