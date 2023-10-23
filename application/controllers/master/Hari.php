<?php
class Hari extends CI_Controller
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
				$this->load->model('hari/Hari_Model');
        }
    function index(){
        $data['title'] = "Hari - Academic Portal";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		// $isi['matakuliah'] = $this->Matakuliah_Model->v_matakuliah();
		$isi['hari'] = $this->Hari_Model->v_hari();
        $data['content'] = $this->load->view('hari/v_hari',$isi,true);
        $this->load->view('index',$data);
	}

	function simpan_hari(){
		$hari=$this->input->post('hari');
		$save=$this->db->insert('master_hari',array('nama_hari'=>$hari));
		if($save){
			$this->session->set_flashdata('master_hari', '<div style="background-color:#E8ECFF; color:red; padding:1em;">
														<strong>Berhasil disimpan
														</div>');
		}else{
			$this->session->set_flashdata('master_hari', '<div style="background-color:#FFCBC5; color:red; padding:1em;">
														<strong>Gagal disimpan</strong>
														</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	function hapus_hari($idhari){
		$delete=$this->Hari_Model->hapus_hari($idhari);
		if($delete){
			$this->session->set_flashdata('master_hari', '<div style="background-color:#E8ECFF; color:red; padding:1em;">
														<strong>Berhasil dihapus
														</div>');
		}else{
			$this->session->set_flashdata('master_hari', '<div style="background-color:#FFCBC5; color:red; padding:1em;">
														<strong>Gagal dihapus</strong>
														</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

}
?>