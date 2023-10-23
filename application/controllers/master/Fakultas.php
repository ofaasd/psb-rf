<?php
	/**
	* 
	*/
	class Fakultas extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('fakultas/Fakultas_Model');
		}
		function index(){
			$data['title'] = "Fakultas - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$fakultas['fakultas'] = $this->Fakultas_Model->v_fakultas();
			$data['content'] = $this->load->view('fakultas/v_fakultas',$fakultas,true);
			$this->load->view('index',$data);
		}
		function add(){
			$data['title'] = "Fakultas - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $fakultas['fakultas'] = $this->Fakultas_Model->v_fakultas();
			$data['content'] = $this->load->view('fakultas/v_add',[],true);
			$this->load->view('index',$data);
		}
		function add_act(){
			$r = $this->Fakultas_Model->add_data();
			if ($r) {
				# code...
				$this->session->set_userdata('fakultas', '<script type="text/javascript">
                                                            alert("Data fakultas di tambahkan."); 
                                                        </script>');
				redirect('master/fakultas');
			}else{
				$this->session->set_userdata('fakultas', '<script type="text/javascript">
                                                            alert("Data fakultas gagal di tambahkan."); 
                                                        </script>');
				redirect('master/fakultas');
			}
		}
		function update($ids){
			$id = base64_decode(base64_decode($ids));
			$data['title'] = "Kurikulum - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$fakultas['detail'] = $this->Fakultas_Model->v_detail($id);
			// $kurikulum['progdi'] = $this->Kurikulum_Model->v_progdi();
			$data['content'] = $this->load->view('fakultas/v_update',$fakultas,true);
			$this->load->view('index',$data);
		}
		function update_act(){
			$r = $this->Fakultas_Model->update_data();
			if ($r) {
				# code...
				$this->session->set_userdata('fakultas', '<script type="text/javascript">
                                                            alert("Data fakultas di update."); 
                                                        </script>');
				redirect('master/fakultas');
			}else{
				$this->session->set_userdata('fakultas', '<script type="text/javascript">
                                                            alert("Data fakultas gagal di update."); 
                                                        </script>');
				redirect('master/fakultas');
			}
		}
		function delete($ids){
			$id = base64_decode(base64_decode($ids));
			$r = $this->db->delete('fakultas', array('id' => $id));
			if ($r) {
				# code...
				$this->session->set_userdata('fakultas', '<script type="text/javascript">
                                                            alert("Data fakultas di hapus."); 
                                                        </script>');
				redirect('master/fakultas');
			}else{
				$this->session->set_userdata('fakultas', '<script type="text/javascript">
                                                            alert("Data fakultas gagal di hapus."); 
                                                        </script>');
				redirect('master/fakultas');
			}
		}
	}
?>