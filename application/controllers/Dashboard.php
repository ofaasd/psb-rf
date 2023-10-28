<?php
	class Dashboard extends CI_Controller
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
		}

		function index()
		{
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			if($gelombang->num_rows() > 0){	
				$data['title'] = "Dashboard - Calon Santri Baru";			
				$hasil['asd'] = "";
				$data['content'] = $this->load->view('pmb_online/dashboard',$hasil,true);
				
			}else{
				$hasil['msg'] = "Belum ada gelombang pendaftaran";
				$data['title'] = "Formulir Santri - Academic Portal";
				$data['content'] = $this->load->view('no_gelombang',$hasil,true);
			}
			
			
			$this->load->view('pmb_online/index_layout',$data);
		}
		function logout()
		{
			$this->session->sess_destroy();
    		redirect('');
		}
	}
?>
