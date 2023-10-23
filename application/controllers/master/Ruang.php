<?php
	class Ruang extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('ruang_model/Ruang_model');
			}
		function index(){
			$data['title'] = "Master Ruang - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$ruang['ruang'] = $this->Ruang_model->v_ruang();
			$data['content'] = $this->load->view('v_ruang/v_ruang',$ruang,true);
			$this->load->view('index',$data);
		}
		function add(){
			$data['title'] = "Master Ruang - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $ruang['ruang'] = $this->Ruang_model->v_ruang();
			$data['content'] = $this->load->view('v_ruang/v_add',[],true);
			$this->load->view('index',$data);
		}
		function add_act(){
			$r = $this->Ruang_model->add();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('ruang', '<script type="text/javascript">
                                                            alert("Data Ruang di tambahkan."); 
                                                        </script>');
				redirect('master/ruang');
			}else{
				$this->session->set_userdata('ruang', '<script type="text/javascript">
                                                            alert("Data Ruang gagal di tambahkan."); 
                                                        </script>');
				redirect('master/ruang');
			}
		}
		function update($ids){
			$id = base64_decode(base64_decode($ids));
			$data['title'] = "DATA RUANG - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$ruang['detail'] = $this->Ruang_model->v_detail($id);
			$data['content'] = $this->load->view('v_ruang/v_update',$ruang,true);
			$this->load->view('index',$data);
			// $kurikulum = $this->Kurikulum_Model->v_detail($id);
			// print_r($kurikulum);
		}
		function delete($ids){
			$id = base64_decode(base64_decode($ids));
			$r = $this->db->delete('master_ruang', array('id' => $id));
			if ($r) {
				# code...
				$this->session->set_userdata('ruang', '<script type="text/javascript">
                                                            alert("Data Ruang di Hapus."); 
                                                        </script>');
				redirect('master/ruang');
			}else{
				$this->session->set_userdata('ruang', '<script type="text/javascript">
                                                            alert("Data Ruang gagal di Hapus."); 
                                                        </script>');
				redirect('master/ruang');
			}
		}
		function update_act(){
			$r = $this->Ruang_model->update();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('ruang', '<script type="text/javascript">
                                                            alert("Data Ruang di Update."); 
                                                        </script>');
				redirect('master/ruang');
			}else{
				$this->session->set_userdata('ruang', '<script type="text/javascript">
                                                            alert("Data Ruang gagal di Update."); 
                                                        </script>');
				redirect('master/ruang');
			}
		}
	}
?>