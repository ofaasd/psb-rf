<?php
	class Psb_new extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			// if($this->session->userdata('status') != 'login_camaba')
			// {
			// 	redirect(base_url());
			// }
			$this->load->model('pmb_model/Model_pmb');
			$this->load->model('Model_online');
			$this->load->model('Wa_model');
		}

		function index()
		{
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$id = $this->session->userdata('id_user');
			$hasil['peserta'] = $this->db->get_where('psb_peserta_online',array('user_id'=>$id,'deleted_at'=>NULL))->result();
			$data['content'] = $this->load->view('psb/index',$hasil,true);
			$this->load->view('index_login',$data);
		}
		function upload_berkas(){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$id = $this->session->userdata('id_user');
			$hasil['peserta'] = $this->db->get_where('psb_peserta_online',array('user_id'=>$id,'deleted_at'=>NULL,'no_pendaftaran != ' =>NULL))->result();
			$data['content'] = $this->load->view('psb/upload_berkas',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);
		}
		function update_berkas(){
			$id = $this->input->post('id');
			$cek = $this->db->get_where('psb_berkas_pendukung',array('psb_peserta_id',$id));
			if($cek->num_rows() > 0){
				
			}
		}
		function create(){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$hasil['id_user'] = $this->session->userdata('id_user');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$hasil['provinsi'] = $this->db->get('provinces')->result();
			$hasil['url_insert_all'] = base_url('psb/simpan');
			$hasil['user'] = $this->db->get_where('user_psb',array('id'=>$hasil['id_user']))->row();
			if(!empty($hasil['user']->tanggal_lahir)){
				$dob = new DateTime($hasil['user']->tanggal_lahir);
				$today   = new DateTime('today');
				$hasil['tahun_lahir'] = $dob->diff($today)->y;
				$hasil['bulan_lahir'] = $dob->diff($today)->m;
			}
			$hasil['redirect1'] = base_url('psb/pesan');
			$data['content'] = $this->load->view('psb/create2',$hasil,true);
			$this->load->view('index_login',$data);
		}
		function pesan(){
			$data['title'] = "Dashboard - Calon Santri Baru";
			$hasil['peserta'] = '';
			$data['content'] = $this->load->view('psb/pesan',$hasil,true);
			$this->load->view('index_login',$data);
		}
		function simpan(){
			$user_id = $this->session->userdata('id_user');
			$gelombang = $this->db->limit("1")->get_where('psb_gelombang',array('pmb_online'=>1))->row()->id;
			$tanggal = date('Y-m-d H:i:s');
			$dateTime = new DateTime($tanggal); 
			$cek_nik  = $this->db->get_where("psb_peserta_online",array("nama"=>$this->input->post('nama'),"tanggal_lahir"=>$this->input->post('tanggal_lahir'),"deleted_at"=>NULL))->num_rows();
			$id = $this->input->post('id');
			$msg = array();

			$this->load->library('form_validation');
			//$this->form_validation->set_rules('no_hp', 'No. Hp', 'trim|required|min_length[10]|max_length[15]|is_unique[user_psb.no_hp]');
			$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'callback_tanggal_lahir_check');
			$this->form_validation->set_rules('no_hp', 'No. HP', 'callback_check_hp');
			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error', validation_errors());
				//redirect("psb/create");
				$msg = [
					'pesan' => validation_errors() ,
					'code' => 4,
				];
				echo json_encode($msg);
				exit;
			}

			if($cek_nik > 0){ 
				//echo 2;
				$msg = [
					'pesan' => 'Calon Santri sudah pernah di daftarkan mohon jika lupa password silahkan melakukan prosedur lupa password atau menghubungi pihak Call Center PSB ' . $this->db->last_query(),
					'code' => 2,
				];
				echo json_encode($msg);
				//exit;
			}else{
				$bulan = 0;
				$tahun = 0;
				if(!empty($this->input->post('tanggal_lahir'))){
					$dob = new DateTime($this->input->post('tanggal_lahir'));
					$today   = new DateTime('today');
					$tahun = $dob->diff($today)->y;
					$bulan = $dob->diff($today)->m;
				}

				$data = array(
					'nik' => $this->input->post('nik'),
					'nama' => $this->input->post('nama'),
					'nama_panggilan' => $this->input->post('nama_panggilan'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tanggal_lahir'),
					'usia_tahun' => $tahun,
					'usia_bulan' => $bulan,
					'jumlah_saudara' => $this->input->post('jumlah_saudara'),
					'anak_ke' => $this->input->post('anak_ke'),
					'alamat' => $this->input->post('alamat'),
					'prov_id' => $this->input->post('provinsi'),
					'kota_id' => $this->input->post('kota'),
					'kecamatan' => $this->input->post('kecamatan'),
					'kelurahan' => $this->input->post('kelurahan'),
					'user_id' => $user_id,
					'status' => 0,
					'created_at' => $dateTime->format('U'),
				);
				if(empty($id)){
					$hasil = $this->db->insert('psb_peserta_online',$data);
				}else{
					$hasil = $this->db->update('psb_peserta_online',$data,array('id'=>$id));
				}
				if($hasil){
					$psb_peserta_id = 0;
					if(empty($id)){
						$psb_peserta_id = $this->db->insert_id();
					}
					$data2 = array(
						'nama_ayah' => $this->input->post('nama_ayah'),
						'pendidikan_ayah' => $this->input->post('pendidikan_ayah'),
						'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
						'alamat_ayah' => $this->input->post('alamat_ayah'),
						'no_hp' => $this->input->post('no_hp'),
						'nama_ibu' => $this->input->post('nama_ibu'),
						'pendidikan_ibu' => $this->input->post('pendidikan_ibu'),
						'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
						'alamat_ibu' => $this->input->post('alamat_ibu'),
						'no_telp' => $this->input->post('no_telp'),
						'created_at' => $dateTime->format('U'),
						//'psb_peserta_id' => $id,
					);
					if(empty($id)){
						$data2['psb_peserta_id'] = $psb_peserta_id;
						$hasil2 = $this->db->insert('psb_wali_peserta',$data2);
					}else{
						$hasil2 = $this->db->update('psb_wali_peserta',$data2,array('psb_peserta_id'=>$id));
					}
					

					$data3 = array(
						'jenjang' => $this->input->post('jenjang'),
						'kelas' => $this->input->post('kelas'),
						'nama_sekolah' => $this->input->post('nama_sekolah'),
						'nss' => $this->input->post('nss'),
						'npsn' => $this->input->post('npsn'),
						'nisn' => $this->input->post('nisn'),
						//'psb_peserta_id' => $id,
					);
					if(empty($id)){
						$data3['psb_peserta_id'] = $psb_peserta_id;
						$hasil3 = $this->db->insert('psb_sekolah_asal',$data3);
					}else{
						$hasil3 = $this->db->update('psb_sekolah_asal',$data3,array('psb_peserta_id'=>$id));
					}
					
					$nik = $this->input->post('nik');
					$nama = $this->input->post('nama');
					$tgl_lahir = $this->input->post('tanggal_lahir');
					//$password = $this->input->post('password');
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
Silahkan catat username dan password di bawah ini untuk dapat mengubah dan melengkapi data
username : ' . $username . '
password : ' . $password . '
Selanjutnya anda dapat melakukan pengkinian data calon santri baru di menu PSB setelah login melalui sistem 
https://psb.ppatq-rf.id';
						$pesan2 = '<p>Selamat anda sudah terdaftar pada web Penerimaan Peserta Didik Baru PPATQ Radlatul Falah Pati</p>
						<p>Silahkan catat username dan password di bawah ini untuk dapat mengubah dan melengkapi data</p>
						<p><b>username : ' . $username . '</b></p>
						<p><b>password : ' . $password . '</b></p>
						<p>Selanjutnya anda dapat melakukan pengkinian data dan mengupload berkas pendukung calon santri baru di menu PSB setelah login melalui sistem 
						https://psb.ppatq-rf.id melalui menu update data / upload berkas pendukung</p>';
						$data = array(
							'pesan' => $pesan,
							'no_wa' => $no_hp,
						);
						$kirim = $this->Wa_model->send_wa($data);
						$msg = [
							'pesan' => $pesan2,
							'code' => 1,
						];
						echo json_encode($msg);
						
					}else{
						
						$msg = [
							'pesan' => 'Gagal Menyimpan User Harap Menghubungi pihak Admin' ,
							'code' => 3,
						];
						echo json_encode($msg);
					}
				}else{
					$msg = [
						'pesan' => 'Data gagal disimpan silahkan coba beberapa saat lagi' ,
						'code' => 0,
					];
					echo json_encode($msg);
				}
			}
		}
		
		function edit($id){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$hasil['nik'] = $this->session->userdata('nim');
			$data['nik'] = $hasil['nik'];
			$data['title'] = "Dashboard - Calon Santri Baru";
			$hasil['psb_peserta'] = $this->db->get_where('psb_peserta_online',array('id'=>$id))->row();
			$hasil['psb_wali'] = $this->db->get_where('psb_wali_peserta',array('psb_peserta_id'=>$id))->row();
			$hasil['psb_sekolah'] = $this->db->get_where('psb_sekolah_asal',array('psb_peserta_id'=>$id))->row();
			$hasil['id'] = $id;
			$hasil['provinsi'] = $this->db->get('provinces')->result();
			$hasil['kota'] = $this->db->get_where('cities',array('prov_id'=>$hasil['psb_peserta']->prov_id))->result() ?? "";
			$data['content'] = $this->load->view('psb/create',$hasil,true);
			$this->load->view('pmb_online/index_layout',$data);	
		}
		function delete($id){
			$tanggal = date('Y-m-d H:i:s');
			$dateTime = new DateTime($tanggal); 
			$data = array(
				'deleted_at' => $dateTime->format('U'),
			);
			$update = $this->db->update('psb_peserta_online',$data, array('id'=>$id));
			redirect(base_url('psb/index'));
		}
		function get_kota(){
			$id_kota = $this->input->post("id");
			$kota = $this->db->get_where("cities",array("prov_id"=>$id_kota))->result();
			foreach($kota as $row){
				echo "<option value='" . $row->city_id . "'>" . $row->city_name . "</option>";
			}
		}
		function validasi($id){
			$gelombang = $this->Model_online->get_gelombang('psb_gelombang');
			$gelombang_id = $gelombang->row()->id;
			$tahun = date('y');
			$nopen = $tahun . $gelombang_id . $id;
			$data = array(
				'no_pendaftaran' => $nopen,
			);
			$update = $this->db->update('psb_peserta_online',$data,array('id'=>$id));
			if($update){
				redirect(base_url("psb/index"));
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
		public function check_hp($str){
			$no_hp = $this->db->get_where('user_psb',array('no_hp'=>$str))->num_rows();
			if($no_hp < 1){
				return true;
			}else{
				$this->form_validation->set_message('check_hp', 'No. HP sudah terdaftar pada sistem');
				return false;
			}
		}
	}
