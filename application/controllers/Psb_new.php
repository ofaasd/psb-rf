<?php
	class Psb extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_camaba')
			{
				redirect(base_url());
			}
			$this->load->model('pmb_model/Model_pmb');
			$this->load->model('Model_online');
			$this->load->model('Wa_model');
		}

		function edit()
		{
		}
	}
	?>
