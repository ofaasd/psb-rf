<?php
	use Zend\Crypt\Password\Bcrypt;
	class Auth extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if($this->session->userdata('status') == 'login_camaba') {
				# code...
				redirect("dashboard");
			}
			$this->load->model('Model_front');
			$this->load->model('Wa_model');
		}

		function index()
		{
			$username = $this->input->post("username");
			$p = $this->input->post("password");

			$bcrypt = new Bcrypt();
			$cek_user = $this->db->get_where('user_psb', array('username' => $username));
			//aktifkan jika captcha sudah digunakan
			// if($this->input->post("g-recaptcha-response") == false){
			// 	$this->session->set_flashdata('gagal', 'Harap Mengisi captcha');
			// 	redirect("welcome");
			// }
			if ($cek_user->num_rows() > 0) {
				# code...
				
				$md5 = md5($p);
				$get_login = $this->db->limit(1)->order_by('id','asc')->get_where('user_psb', array('username' => $username, 'password' => $md5));
				
				if($get_login->num_rows() > 0){
					$rs = $get_login->row();
					$data_sess = array(
										'nama' => $rs->nama,
										'nim' => $rs->nik,
										'id_user' => $rs->id,
										'status' => 'login_camaba'
									  );
					$this->session->set_userdata($data_sess);
					redirect('dashboard');
				}else{
					$this->session->set_flashdata('gagal', 'Password Salah');
					redirect('welcome');
				}
			}else{
				//echo "gagal_login";
				$this->session->set_flashdata('gagal', 'Username Tidak Terdaftar');
				redirect("welcome");
			}
			// $pass = $bcrypt->create("admin");
			//echo "gagal login";

		}
		function register()
		{
			$this->load->library('form_validation');
			

			$this->form_validation->set_rules('no_hp', 'No. Hp', 'trim|required|min_length[10]|max_length[15]|is_unique[user_psb.no_hp]');
			$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'callback_tanggal_lahir_check');
			
			//Jika recaptcha sudah aktif uncomment di bawah ini
			// if($this->input->post("g-recaptcha-response") == false){
			// 	$this->session->set_flashdata('gagal', 'Harap Mengisi captcha');
			// 	redirect("welcome/register");
			// }
			//$cek = $this->db->get_where('user_psb', array('nik' => $nik));
			
			
			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				redirect("welcome/register");
			}else{
				//$from = $this->config->item('smtp_user');
				$nik = $this->input->post('nik');
				$nama = $this->input->post('nama');
				$tgl_lahir = $this->input->post('tgl_lahir');
				$password = $this->input->post('password');
				$tanggal = date("Ymd",strtotime($tgl_lahir));
				$alamat = $this->input->post('alamat');
				$prov_id = $this->input->post('provinsi');
				$kota_id = $this->input->post('kota');
				$kecamatan = $this->input->post('kecamatan');
				$kelurahan = $this->input->post('kelurahan');
				$kode_pos = $this->input->post('kode_pos');
				$no_hp = $this->input->post('no_hp');
				
				$user_guest = array(
					"nik" => $nik,
					"nama" => $nama,
					//"password" => md5($password),
					"tanggal_lahir" => date('Y-m-d',strtotime($tgl_lahir)),
					"alamat" => $alamat,
					"prov_id" => $prov_id,
					"city_id" => $kota_id,
					"kecamatan" => $kecamatan,
					"kelurahan" => $kelurahan,
					"kode_pos" => $kode_pos,
					"no_hp" => $no_hp,	
				);
				$insert = $this->db->insert("user_psb",$user_guest);
				if($insert){
					$id = $this->db->insert_id();
					$str_id = "";
					if(strlen($id) == 1){
						$str_id = "00" . $id;
					}elseif(strlen($id) == 2){
						$str_id = "0" . $id;
					}else{
						$str_id = (str)($id);
					}
					$tahun_lahir = date('Y', strtotime($tgl_lahir));
					$new_nama = substr($nama,0,3);
					$tanggal = date('dm',strtotime($tgl_lahir));

					//create username and password
					$username = "RF.ppatq." . $str_id . "." . date('y');
					$password = $tahun_lahir . $new_nama . $tanggal;
					$data = array(
						'username' => $username,
						'password' => md5($password),
					);
					$update = $this->db->update("user_psb",$data,array('id'=>$id));
					//kirim notifikasi ke wa
					$pesan = '*Pesan ini dikirim dari sistem*

Selamat anda sudah terdaftar pada web Penerimaan Peserta Didik Baru PPATQ Radlatul Falah Pati
Silahkan Login kembali dengan menggunakan 
username : ' . $username . '
password : ' . $password . '
Selanjutnya anda dapat melakukan pengkinian data calon santri baru di menu PSB setelah login melalui sistem 
https://psb.ppatq-rf.id';
					$data = array(
						'pesan' => $pesan,
						'no_wa' => $no_hp,
					);
					$kirim = $this->Wa_model->send_wa($data);
					$this->session->set_flashdata('berhasil', 'Akun berhasil dibuat, <br />username : ' . $username . ' <br /> Password : ' . $password . ' <br />Silahkan catat username dan password kemudian Login kembali ke sistem');
					redirect("welcome");
				}else{
					$this->session->set_flashdata('gagal', 'Akun gagal insert ke DB');
					redirect("welcome/register");
				}
			}
		}
		public function tanggal_lahir_check($str){
			$dob = new DateTime($str);
			$today   = new DateTime('today');
			$year = $dob->diff($today)->y;
			$month = $dob->diff($today)->m;
			$day = $dob->diff($today)->d;
			//echo "Age is"." ".$year."year"." ",$month."months"." ".$day."days";
			if($year >= 5 && $year < 13){
				return true;
			}else{
				$this->form_validation->set_message('tanggal_lahir_check', 'Usia minimal 5 tahun dan maksimal 12 tahun');
				return false;
			}
		}
	}

?>
