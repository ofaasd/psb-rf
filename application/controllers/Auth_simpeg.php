<?php
	use Zend\Crypt\Password\Bcrypt;
	class Auth_simpeg extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if ($this->authact->logged_in())
			{
				redirect("dashboard");
			}
			$this->load->model('Model_front');
		}		
		function simpeg()
		{
			$u = trim($this->input->post('login'));
			$p = trim($this->input->post('password'));
			if($this->authact->login($u,$p))
			{
				$cek = $this->Model_front->getRole($this->authact->get_user_id());
				if($cek->num_rows()==1)
				{
					$sess = $cek->row();
					$this->session->set_userdata('logged_in',true);
					$this->session->set_userdata('role',$sess->role);
					$simpeg_role = $this->authact->getSimpegRole();
					if($simpeg_role == 1){
						redirect('simpeg/dashboard');
					}else{
						redirect('simpeguser/dashboard');
					}
				}
				else
				{
					//lempar ke aplikasi dosen/mahasiswa
					$this->session->set_userdata('logged_in',true);
					$this->session->set_userdata('role','2');
					redirect('simpeguser/dashboard');
					
				}
				echo $u,$p;
				
			}else{
				$bcrypt = new Bcrypt();
				//echo $bcrypt->create("admin");

				echo "gagal login";
			}
		}
	}
?>