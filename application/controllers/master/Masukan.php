<?php
class Masukan extends CI_Controller
{
    function __construct()
		{
			# code...
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
        }
    function index(){
        $data['title'] = "Masukan Kritik dan Saran - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$masukan['masukan'] = $this->db->select('masukan.*,mahasiswa.nama')->join('mahasiswa','mahasiswa.nim = masukan.nim','inner')->get("masukan");
        $data['content'] = $this->load->view('masukan/v_masukan',$masukan,true);
        $this->load->view('index',$data);
	}
	
}
?>