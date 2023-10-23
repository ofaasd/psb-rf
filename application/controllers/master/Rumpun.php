<?php
	/**
	* 
	*/
	class Rumpun extends CI_Controller
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
				$this->load->model('rumpun_model/Rumpun_Model');
		}
		function index(){
			$data['title'] = "Rumpun - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$rumpun['daftar_rumpun'] = $this->Rumpun_Model->daftar_rumpun();
			$data['content'] = $this->load->view('rumpun/v_rumpun',$rumpun,true);
			$this->load->view('index',$data);
		}
		function add(){
			$data['title'] = "Rumpun - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $rumpun['daftar_rumpun'] = $this->Rumpun_Model->daftar_rumpun();
			$data['content'] = $this->load->view('rumpun/v_add',[],true);
			$this->load->view('index',$data);
		}
		function add_act(){
			$r = $this->Rumpun_Model->tambah_rumpun();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('rumpun', '<script type="text/javascript">
                                                            alert("Data Rumpun di tambahkan."); 
                                                        </script>');
				redirect('master/rumpun');
			}else{
				$this->session->set_userdata('rumpun', '<script type="text/javascript">
                                                            alert("Data Rumpun gagal di tambahkan."); 
                                                        </script>');
				redirect('master/rumpun');
			}
		}
		function update($ids){
			$id = base64_decode(base64_decode($ids));
			$data['title'] = "Rumpun - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$rumpun['rumpun'] = $this->Rumpun_Model->update_rumpun($id);
			$data['content'] = $this->load->view('rumpun/v_update',$rumpun,true);
			$this->load->view('index',$data);
		}
		function update_act(){
			$r = $this->Rumpun_Model->update_act_model();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('rumpun', '<script type="text/javascript">
                                                            alert("Data Rumpun di update."); 
                                                        </script>');
				redirect('master/rumpun');
			}else{
				$this->session->set_userdata('rumpun', '<script type="text/javascript">
                                                            alert("Data Rumpun gagal di update."); 
                                                        </script>');
				redirect('master/rumpun');
			}
		}
		function delete($ids){
			$id = base64_decode(base64_decode($ids));
			$data = array('status' => 0);
			$r = $this->db->update('master_rumpun',$data, array('id' => $id));
			if ($r == 1) {
				# code...
				$this->session->set_userdata('rumpun', '<script type="text/javascript">
                                                            alert("Data Rumpun di Hapus."); 
                                                        </script>');
				redirect('master/rumpun');
			}else{
				$this->session->set_userdata('rumpun', '<script type="text/javascript">
                                                            alert("Data Rumpun gagal di Hapus."); 
                                                        </script>');
				redirect('master/rumpun');
			}
		}
	}
?>