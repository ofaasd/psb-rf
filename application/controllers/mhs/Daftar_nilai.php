<?php
class Daftar_nilai extends CI_Controller
{
	function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}

		}
	public function index(){
		$nim = $this->session->userdata('nim');
		$this->load->model('Krs_mhs');
		$data['title'] = "Daftar Nilai - Academic Portal";
		$transkrip['transkrip'] = $this->Krs_mhs->list_nilai($nim);
		$data['content'] = $this->load->view('mhs/transkrip',$transkrip,true);
		$this->load->view('mhs/index',$data);
	}
}
?>