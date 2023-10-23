<?php
	class Waktu extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				if(!$this->authact->logged_in())
				{
					redirect(base_url());
				}
				$this->load->model('Model_front');
				$this->load->model('waktu_model/Waktu_Model');
			}
		function index(){
			$data['title'] = "Master Waktu - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$waktu['waktu'] = $this->Waktu_Model->v_waktu();
			$data['content'] = $this->load->view('waktu/v_waktu',$waktu,true);
			$this->load->view('index',$data);
		}
		function add(){
			$data['title'] = "Master Waktu - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $waktu['waktu'] = $this->Waktu_Model->v_waktu();
			$data['content'] = $this->load->view('waktu/v_add',[],true);
			$this->load->view('index',$data);
		}
		function add_act(){
			$r = $this->Waktu_Model->add();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('waktu', '<script type="text/javascript">
                                                            alert("Data Waktu Perkuliahan di tambahkan."); 
                                                        </script>');
				redirect('master/waktu');
			}else{
				$this->session->set_userdata('waktu', '<script type="text/javascript">
                                                            alert("Data Waktu Perkuliahan gagal di tambahkan."); 
                                                        </script>');
				redirect('master/waktu');
			}
		}
		function update($ids){
			$id = base64_decode(base64_decode($ids));
			$data['title'] = "Master Waktu - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$waktu['detail'] = $this->Waktu_Model->v_detail($id);
			$data['content'] = $this->load->view('waktu/v_update',$waktu,true);
			$this->load->view('index',$data);
			// $kurikulum = $this->Kurikulum_Model->v_detail($id);
			// print_r($kurikulum);
		}
		function update_act(){
			$r = $this->Waktu_Model->update();
			if ($r == 1) {
				# code...
				$this->session->set_userdata('waktu', '<script type="text/javascript">
                                                            alert("Data Waktu Perkuliahan di update."); 
                                                        </script>');
				redirect('master/waktu');
			}else{
				$this->session->set_userdata('waktu', '<script type="text/javascript">
                                                            alert("Data Waktu Perkuliahan gagal di update."); 
                                                        </script>');
				redirect('master/waktu');
			}
		}
	}
?>