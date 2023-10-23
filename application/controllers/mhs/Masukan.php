<?php
	class Masukan extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}
			$this->load->model('pmb_model/Model_pmb');
			$this->load->model('mhs/M_masukan');
		}

		function index()
		{
			$data['title'] = "Dashboard - Mahasiswa Portal";
			$data['content'] = $this->load->view('mhs/masukan','',true);
			$this->load->view('mhs/index',$data);
		}
		function tambah(){
			if($this->M_masukan->tambah() == TRUE){
				$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Terimakasih Saran Anda Berhasil dikirim"); 
                                                        </script>');
				redirect('mhs/masukan?succ=1');
			}else{
				$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Saran gagal dikirim"); 
                                                        </script>');
				redirect('mhs/masukan?err=1');
			}
			
		}
		
	}