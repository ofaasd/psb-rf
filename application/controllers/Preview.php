<?php
	use Zend\Crypt\Password\Bcrypt;
	class Preview extends CI_Controller{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
			//$this->load->model('pmb_model/Model_pmb');
		}
		function index(){
			$data['title'] = "Mahasiswa - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$mhs['daftar_mhs'] = $this->db->get('mahasiswa')->result();
			$data['content'] = $this->load->view('preview/index',$mhs,true);
			//$this->session->unset_userdata('passwd');
			$this->load->view('index',$data);
		}
		function proses(){
			$nim = $this->input->post("nim");
			$get = $this->db->get_where('mahasiswa', array('nim' => $nim));
			$npp = $this->session->userdata('npp');
			$query  = $this->db->get_where("pegawai",array('npp'=>$npp))->row();
			$password = $this->input->post("password");
			if(!$this->authact->login($query->usrnm,$password)){
				$this->session->set_flashdata('error', '<script>alert("Password Admin Salah");</script>');
				
				redirect('preview');
				
			}else{
				//echo $query->usrnm;
				//echo $password;
				$rs = $get->row();
				$data_sess = array(
					'nama' => $rs->nama,
					'nim' => $rs->nim,
					'id_user' => $rs->id,
					'status' => 'login_mhs'
				  );
				  $this->session->set_userdata('passwd',$password);
				  $this->session->set_userdata($data_sess);
					redirect('mhs/dashboard/profil');
			}
		}
		function b_admin(){
			$data_sess = array(
					'nama' => '',
					'nim' => '',
					'id_user' => '',
					'status' => ''
				  );
			$this->session->unset_userdata($data_sess);
			
			$u = $this->authact->get_user_name();
			$p = $this->session->userdata('passwd');
			if($this->authact->login($u,$p))
			{
				$cek = $this->Model_front->getRole($this->authact->get_user_id());
				if($cek->num_rows()==1)
				{
					$sess = $cek->row();
					$this->session->set_userdata('logged_in',true);
					$this->session->set_userdata('role',$sess->role);
					$this->session->set_userdata('id_user',$sess->id);
					//var_dump($sess);
					if($sess->role == '6'){
						$_SESSION['npp'] = $this->session->userdata('npp');
						$this->session->unset_userdata('passwd');
						redirect('dosen/dashboard');
						
					}else{
						redirect('preview');
					}
				}
				else
				{ 
					// $cek_mhs = $this->db->
					//lempar ke aplikasi dosen/mahasiswa
					echo "lempar ke aplikasi dosen/mahasiswa";
				}
				
				
			}else{
				echo "gagal kembali";
			}
		}
	}