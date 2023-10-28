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
		}

		function index()
		{
			$nik = $this->input->post("nik");
			$p = $this->input->post("password");

			$bcrypt = new Bcrypt();
			$cek_user = $this->db->get_where('user_psb', array('nik' => $nik));
			//aktifkan jika captcha sudah digunakan
			// if($this->input->post("g-recaptcha-response") == false){
			// 	$this->session->set_flashdata('gagal', 'Harap Mengisi captcha');
			// 	redirect("welcome");
			// }
			if ($cek_user->num_rows() > 0) {
				# code...
				
				$md5 = md5($p);
				$get_login = $this->db->limit(1)->order_by('id','asc')->get_where('user_psb', array('nik' => $nik, 'password' => $md5));
				
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
				$this->session->set_flashdata('gagal', 'Email Tidak Terdaftar');
				redirect("welcome");
			}
			// $pass = $bcrypt->create("admin");
			//echo "gagal login";

		}
		function register()
		{
			$this->load->config('email');
			$this->load->library('email');
			
			$from = $this->config->item('smtp_user');
			$nik = $this->input->post('nik');
			$nama = $this->input->post('nama');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$password = $this->input->post('password');
			$tanggal = date("Ymd",strtotime($tgl_lahir));
			//Jika recaptcha sudah aktif uncomment di bawah ini
			// if($this->input->post("g-recaptcha-response") == false){
			// 	$this->session->set_flashdata('gagal', 'Harap Mengisi captcha');
			// 	redirect("welcome/register");
			// }
			$cek = $this->db->get_where('user_psb', array('nik' => $nik));
			
			
			if($cek->num_rows() > 0 ){
				$this->session->set_flashdata('gagal', 'Akun sudah pernah terdaftar harap hubungi pihak Admisi STIFERA');
				redirect("welcome/register");
			}else{
				
				$user_guest = array(
					"nik" => $nik,
					"nama" => $nama,
					"password" => md5($password),
					"tanggal_lahir" => date('Y-m-d',strtotime($tgl_lahir)),
				);
				$insert = $this->db->insert("user_psb",$user_guest);
				if($insert){
					
					//Aktifkan jika di pendaftaran user akan ada email notification
					// $subject = "Penerimaan Mahasiswa Baru STIFERA";
					
					// $message = "Selamat kepada " . $nama . ". Anda sudah tergabung sebagai Calon Mahasiswa di Sekolah Tinggi Farmasi Nusaputera \n Berikut Username dan Password anda adalah : \n username : " . $email  . "\n Password : " . $tanggal . "\n\n Terimakasih, \n Admin PMB STIFERA";

					// $this->email->set_newline("\r\n");
					// $this->email->from($from);
					// $this->email->to($email);
					// $this->email->subject($subject);
					// $this->email->message($message);

					// if ($this->email->send()) {
					// 	$this->session->set_flashdata('berhasil', 'Akun berhasil dibuat, silahkan cek email anda dan silahkan login kembali');
					// 	redirect("welcome");
					// } else {
					// 	$this->session->set_flashdata('gagal', show_error($this->email->print_debugger()));
					// 	redirect("welcome/register");
					// }
					$this->session->set_flashdata('berhasil', 'Akun berhasil dibuat, silahkan login kembali');
					redirect("welcome");
				}else{
					$this->session->set_flashdata('gagal', 'Akun gagal insert ke DB');
					redirect("welcome/register");
				}
			}
		}
	}
?>
