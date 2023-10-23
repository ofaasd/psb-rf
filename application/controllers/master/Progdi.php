<?php
/**
* 
*/
class Progdi extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		if(!$this->authact->logged_in())
		{ 
			redirect(base_url());
		}
		$this->load->model('Model_front');
		$this->load->model('progdi/Progdi_Model');
	}
	function index(){
		$data['title'] = "Program Studi - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$progdi['progdi'] = $this->Progdi_Model->v_progdi();
		$data['content'] = $this->load->view('progdi/v_progdi',$progdi,true);
		$this->load->view('index',$data);
	}
	function add(){
		$data['title'] = "Program Studi - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$progdi['fakultas'] = $this->Progdi_Model->list_fakultas();
		$data['content'] = $this->load->view('progdi/v_add',$progdi,true);
		$this->load->view('index',$data);
	}
	function add_act(){
		$r = $this->Progdi_Model->add_data();
		if ($r) {
			# code...
			$this->session->set_userdata('progdi', '<script type="text/javascript">
                                                            alert("Data Program Studi di tambahkan."); 
                                                        </script>');
				redirect('master/progdi');
		}else{
			$this->session->set_userdata('progdi', '<script type="text/javascript">
                                                            alert("Data Program Studi gagal di tambahkan."); 
                                                        </script>');
				redirect('master/progdi');
		}
	}
	function update($ids){
		$id = base64_decode(base64_decode($ids));
		$data['title'] = "Program Studi - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$progdi['progdi'] = $this->Progdi_Model->v_progdis($id);
		$data['content'] = $this->load->view('progdi/v_update',$progdi,true);
		$this->load->view('index',$data);
	}
	function update_act(){
		$r = $this->Progdi_Model->update_data();
		if ($r) {
			# code...
			$this->session->set_userdata('progdi', '<script type="text/javascript">
                                                            alert("Data Program Studi di update."); 
                                                        </script>');
				redirect('master/progdi');
		}else{
			$this->session->set_userdata('progdi', '<script type="text/javascript">
                                                            alert("Data Program Studi gagal di update."); 
                                                        </script>');
				redirect('master/progdi');
		}
	}
	function delete($ids){
			$id = base64_decode(base64_decode($ids));
			$r = $this->db->delete('program_studi', array('id' => $id));
			if ($r) {
				# code...
				$this->session->set_userdata('progdi', '<script type="text/javascript">
                                                            alert("Data progdi di hapus."); 
                                                        </script>');
				redirect('master/progdi');
			}else{
				$this->session->set_userdata('progdi', '<script type="text/javascript">
                                                            alert("Data progdi gagal di hapus."); 
                                                        </script>');
				redirect('master/progdi');
			}
		}
}
?>