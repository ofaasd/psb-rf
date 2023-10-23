<?php
/**
* 
*/
class Jadwal_krs extends CI_Controller
{
	function __construct()
		{
			# code..
			parent::__construct();
			if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('matakuliah/Matakuliah_Model');
        }
    function index(){
        $data['title'] = "KRS - Input KRS";
        $data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
        $krs['krs'] = $this->db->get('jadwal_krs')->result();
        $krs['status'] = $this->db->get('jadwal_krs')->row()->status;
        $data['content'] = $this->load->view('krs/jadwal_krs',$krs,true);
        $this->load->view('index',$data);
	}
	function save(){
		$status = $this->input->post('status');
		$this->db->update('jadwal_krs', array('status' => $status), array('id' => 1));
		redirect('master/jadwal_krs');
	}
}
?>