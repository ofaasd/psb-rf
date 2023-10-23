<?php
/**
* 
*/
class Ganti_password extends CI_Controller
{
	
	function __construct()
		{
			parent::__construct();
			if (!$this->authact->logged_in())
			{
				redirect("dashboard");
			}
			$this->load->model('Model_front');
			$this->load->library('email');
		}
	function index(){
		$data['title'] = "Profil - Academic Portal";
		$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
		$data['content'] = $this->load->view('krm/ganti_password',[],true);
		$this->load->view('index',$data);
	}
	function save_pass(){
			$old_pass = $this->input->post('old_pass');
			$new_pass = $this->input->post('new_pass');
			$new_pass1 = $this->input->post('new_pass1');
			$get_data = $this->db->get_where('pegawai', array('usrnm' => $this->authact->get_user_name))->row();
			if ($get_data->paswd != $this->authact->generatepass($old_pass)) {
				$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Password lama salah!"); 
                                                        </script>');
				redirect('krm/ganti_password/');
			}else{
				if ($new_pass != $new_pass1) {
					$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Password baru tidak sama!"); 
                                                        </script>');
					redirect('krm/ganti_password/');
				}else{
					$password_baru = $this->authact->generatepass('new_pass');
					$this->db->update('pegawai', array('paswd' => $password_baru), array('usrnm' => $this->authact->get_user_name));
					$this->session->set_userdata('ganti_pass', '<script type="text/javascript">
                                                            alert("Password berhasil diubah!"); 
                                                        </script>');
					redirect('dashboard/logout');
				}
			}
		}
}
?>