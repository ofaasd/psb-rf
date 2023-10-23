<?php
class Keuangan extends CI_Controller
{
    function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') != 'login_mhs')
			{
				redirect(base_url());
			}

		}
    
	function index(){
		$nim = $this->session->userdata('nim');
		$data['title'] = "Tagihan - Academic Portal";
		$get_info['cek'] = $this->db->query("SELECT master_keuangan_temp.*, mahasiswa.nama from master_keuangan_temp LEFT JOIN mahasiswa ON master_keuangan_temp.nim = mahasiswa.nim where master_keuangan_temp.nim = '".$nim."' AND master_keuangan_temp.is_publish = 1")->num_rows();
		$get_info['tagihan'] = $this->db->query("SELECT master_keuangan_temp.*, mahasiswa.nama from master_keuangan_temp LEFT JOIN mahasiswa ON master_keuangan_temp.nim = mahasiswa.nim where master_keuangan_temp.nim = '".$nim."' AND master_keuangan_temp.is_publish = 1")->row();
		$get_info['biodata'] = $this->db->get_where('mahasiswa', array('nim' => $nim))->row();
		$data['content'] = $this->load->view('mhs/tagihan',$get_info,true);
        $this->load->view('mhs/index',$data);
	}
}
?> 