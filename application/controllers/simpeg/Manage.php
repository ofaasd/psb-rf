<?php

	use Zend\Crypt\Password\Bcrypt;

	class Manage extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url() . 'login/simpeg');
			}
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
			
		}

		function index()
		{
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getSimpegRole());
			//echo $this->authact->getSimpegRole();
			
			
			$hasil['query'] = $this->Model_pegawai->get_all();

			$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);

			$data['content'] = $this->load->view('simpeg/manage/awal',$hasil,true);
			$this->load->view('index_simpeg',$data);
		}
		function tambah_pegawai(){
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());
			$query['jenis_pegawai'] = $this->Model_simpeg->getJenisPegawai();
			$query['progdi'] = $this->Model_simpeg->getProgdi();
			$query['homebase'] = $this->Model_simpeg->getHomebase();
			$query['provinsi'] = $this->Model_simpeg->getProvinsi();
			$query['jenis_kelamin'] = array("L"=>"Laki-laki","P"=>"Perempuan");
			$query['golongan_darah'] = array("A","B","AB","O");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['bagian'] = $this->Model_simpeg->getBagian();
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$query['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);

			$query['last_id'] = $this->Model_simpeg->getLastIdPegawai();
			$query['fakultas'] = $this->Model_simpeg->getFakultas();
			$query['master_prodi'] = $this->Model_simpeg->getMasterProgdi();
			$query['universitas'] = $this->Model_simpeg->getUniversitas();
			$query['url_simple_insert'] = base_url() . "pegawai/insert1/";
			$query['url_insert_all'] = base_url() . "pegawai/save/";
			$query['redirect1'] = base_url() . "simpeg/manage/profil/";
			$query['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			//$data['content'] = $this->load->view('simpeg/manage/_form',$query,true);
			$data['content'] = $this->load->view('pegawai/form-wizard',$query,true);
			$this->load->view('index_simpeg',$data);
		}
		function get_status(){
			$id=$this->input->post('id');
	        $data=$this->Model_pegawai->get_status_jenis($id);
	        echo json_encode($data);
		}
		function get_jabatan(){
			$bagian=$this->input->post('bagian');
	        //$data=$this->Model_pegawai->get_status_jenis($id);
	        $where = array('bagian' => $bagian);
	        $data = $this->db->get_where("jabatan_struktural",$where)->result();
	        echo json_encode($data);
		}
		function get_prodi(){
			$data = $this->Model_simpeg->getProgdi();
			echo json_encode($data);
		}
		function save(){
			if($this->input->post()){
				$npp = $this->input->post('npp');
				$config['upload_path'] = './assets/foto_pegawai/';
			    $config['allowed_types'] = 'gif|jpg|png';
			    $config['max_size']  = '1048';
			    $config['overwrite'] = TRUE;
			    $config['file_name'] = 'pegawai_'.$this->input->post('npp');
			    $config['file_ext'] = '.jpg';
			    $config['remove_space'] = TRUE;
			    $this->load->library('upload', $config); 
			    $nama_foto = "";
			    if($this->upload->do_upload('foto')){ 
			    	$nama_foto = $config['file_name'].$config['file_ext'];
			    }
			    $password = "";
		    	if(empty($this->input->post("password"))){
		    		$password = $this->input->post('npp');
		    	}else{
		    		$password = $this->input->post('password');
		    	}
		    	$bcrypt = new Bcrypt();
		    	$paswd = $bcrypt->create($password);
		    	$npp = $this->input->post('npp_depan') . $this->input->post('npp');
		    	$data_pegawai = array(
		    		'npp' => $npp,
		    		'nama' => $this->input->post('nama_lengkap'),
		    		'usrnm' => $npp,
		    		'paswd' => $paswd,
		    	);

				$this->db->trans_start();
				$r = $this->db->insert('pegawai', $data_pegawai);
				$id = $this->db->insert_id();
				$biodata = array(
		    		'id_pegawai' => $id,
		    		'kd_posisi_pegawai' => $this->input->post("posisi_pegawai"),
					
					'nama_lengkap' => $this->input->post('nama_lengkap'),
					
					'alamat' => $this->input->post('alamat'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'nidn' => $this->input->post('nidn'),
					'status_nikah' => $this->input->post('status_nikah'),
					'status_pegawai' => $this->input->post('status'),
					'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir'))),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'gelar_depan' => $this->input->post('gelar_depan'),
					'gelar_belakang' => $this->input->post('gelar_belakang'),
					'no_ktp' => $this->input->post('no_ktp'),
					'no_kk' => $this->input->post('no_kk'),
					'provinsi' => $this->input->post("provinsi"),
					'kotakab' => $this->input->post("kotakab"),
					'kecamatan' => $this->input->post("kecamatan"),
					'kelurahan' => $this->input->post("kelurahan"),
					'golongan_darah' => $this->input->post("golongan_darah"),

					'agama' => $this->input->post('agama'),
					'email1' => $this->input->post('email1'),
					'notelp' => $this->input->post('no_telp'),

					'nama_pasangan' => $this->input->post('nama_pasangan'),
					'tgl_lahir_pasangan' => date('Y-m-d', strtotime($this->input->post('tgl_lahir_pasangan'))),
					'pekerjaan_pasangan' => $this->input->post('pekerjaan_pasangan'),
					'jumlah_anak' => $this->input->post('jumlah_anak'),
					'foto' => $nama_foto,
					'homebase' => $this->input->post("homebase"),
					'id_progdi' => $this->input->post("homebase"),
					
					'no_bpjs_kesehatan' => $this->input->post('no_bpjs_kesehatan'),
					'no_bpjs_ketenagakerjaan' => $this->input->post('no_bpjs_ketenagakerjaan'),

				);
				$b = $this->db->insert('pegawai_biodata',$biodata);
				$universitas = $this->input->post("universitas");
				$universitasid = $this->input->post("universitasid");
				$jurusan = $this->input->post("jurusan");
				$jurusanid = $this->input->post("jurusanid");
				$jenjang = $this->input->post("jenjang");
				foreach($universitasid as $key=>$value){
					$univ_id = $value;
					if($value == 999999){
						$data_univ = array(
										"nama_universitas" => $universitas[$key],
									);
						$univ = $this->db->insert("master_universitas",$data_univ);
						$univ_id = $this->db->insert_id();
					}
					$prodi_id = $jurusanid[$key];
					if($prodi_id == 999999){
						$data_prodi = array(
											"nama_jurusan"=>$jurusan[$key],
										);
						$prodi = $this->db->insert("master_program_studi",$data_prodi);
						$prodi_id = $this->db->insert_id();
					}
					if(!empty($value)){
						$data_riwayat = array(
							'id_pegawai' => $id,
							'jenjang' => $jenjang[$key],
							'universitas' => $univ_id,
							'jurusan' => $prodi_id
						);
						$riwayat = $this->db->insert("pegawai_riwayat_pendidikan",$data_riwayat);
					}
				}
				$data_golongan = array(
					'id_pegawai' => $id,
					'nama' => $this->input->post("golongan_skrg"),
					'no_pengantar' => $this->input->post("np_skrg"),
					'no_sk' => $this->input->post("nosk_skrg"),
					'tanggal_sk' => date('Y-m-d', strtotime($this->input->post("tglsk_skrg"))),
					'tmt' => $this->input->post("tmt_skrg"),
					'status' => "sekarang",
				);
				$golongan = $this->db->insert("pegawai_golongan",$data_golongan);

				$data_fungsional = array(
					'id_pegawai' => $id,
					'jabatan_fungsional_sekarang' => $this->input->post("jabatan_fungsional"),
					'no_sk_fungsional' => $this->input->post("nosk_fungsional"),
					'tgl_sk_fungsional' => date('Y-m-d', strtotime($this->input->post("tglsk_fungsional"))),
					'tmt_sk_fungsional' => $this->input->post("tmtsk_fungsional"),
					'kum' => $this->input->post("kum_fungsional"),
				);
				$fungsional = $this->db->insert("pegawai_jabatan_fungsional", $data_fungsional);

				$data_struktural = array(
					'id_pegawai' => $id,
					'unit_kerja' => $this->input->post("unit_kerja"),
					//'bagian' => $this->input->post("bagian"),
					'id_jabatan_struktural' => $this->input->post("jabatan_struktural"),
					'no_sk_struktural' => $this->input->post("nosk_struktural"),
					'tanggal_sk_struktural' => date('Y-m-d', strtotime($this->input->post("tglsk_struktural"))),
					'tmt_sk_struktural' => $this->input->post("tmtsk_struktural"),
				);
				$struktural = $this->db->insert("pegawai_jabatan_struktural",$data_struktural);

				$data_user = array(
					'userid' => $id,
					'role' => 6,
					'simpeg_role' => 2,
					'active' => 1,
				);
				$user = $this->db->insert("users",$data_user);

				if($this->db->trans_complete()){
					redirect("/simpeg/manage");	
				}
				// return $r;
				// var_dump($r);
			}

		}
		function profil(){
			if(!empty($this->uri->segment('4'))){
				$_SESSION['npp'] = $this->uri->segment('4');
			}
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);

			$data['content'] = $this->load->view('simpeg/manage/profil',$hasil,true);

			$this->load->view('index_simpeg',$data);
		}
		
		function edit($id){
			if(!empty($id)){
				$_SESSION['npp'] = $id;
			}
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());

			$query['query'] = $this->Model_simpeg->getPegawai($id);
			//$id = $query['query']->pegawai_id;
			$id_pegawai = $query['query']->id_pegawai;

			
			$query['pegawai_golongan'] = $this->Model_simpeg->getDetailGolongan($id_pegawai);
			$query['pegawai_jabatan_fungsional'] = $this->Model_simpeg->getDetailJabatanFungsional($id_pegawai);
			$query['pegawai_jabatan_struktural'] = $this->Model_simpeg->getDetailjabatanStruktural($id_pegawai);


			$where = array("id" => $id_pegawai);
			$query['universitas'] = $this->db->get_where("pegawai_riwayat_pendidikan",$where);
			$query['jenis_pegawai'] = $this->Model_simpeg->getJenisPegawai();
			$query['progdi'] = $this->Model_simpeg->getProgdi();
			$query['fakultas'] = $this->Model_simpeg->getFakultas();
			$query['last_id'] = $this->Model_simpeg->getLastIdPegawai();
			$query['jenis_kelamin'] = array("L"=>"Laki-laki","P"=>"Perempuan");
			$query['golongan_darah'] = array("A","B","AB","O");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['bagian'] = $this->Model_simpeg->getBagian();
			$query['homebase'] = $this->Model_simpeg->getHomebase();
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['jabatan_struktural'] = $this->db->get_where("jabatan_struktural",$where_id_jabatan)->row();
			if(!empty($query['jabatan_struktural']->bagian)){
				$where_bagian = array("bagian"=>$query['jabatan_struktural']->bagian);
			}else{
				$where_bagian = array("bagian"=>"Akademik");
			}
			//echo $query['jabatan_struktural']->bagian;
			$where_kd_posisi = array("id_jenis_pegawai"=>$query['query']->id_jenis_pegawai);
			$query['posisi'] = $this->db->get_where("pegawai_posisi",$where_kd_posisi)->result();

			//$query['jabatan_struktural_list'] = $this->db->get_where("jabatan_struktural",$where_bagian)->result();
			if(empty($query['pegawai_jabatan_struktural']->id_jabatan_struktural) || $query['pegawai_jabatan_struktural']->id_jabatan_struktural == 0){
				$query['pegawai_jabatan_struktural']->id_jabatan_struktural = 1;
			}
			$query['curr_jabatan'] = $this->Model_simpeg->getDetailJabatan($query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['unit_kerja'] = $this->Model_simpeg->getUnitKerja();
			$query['bagian'] = $this->Model_simpeg->getBagianStruktural($query['curr_jabatan']->id_unit_kerja);
			$query['jenis_jabatan'] = $this->Model_simpeg->getJenisJabatan($query['curr_jabatan']->id_unit_kerja);
			$query['jabatan_struktural'] = $this->Model_simpeg->getJabatan($query['curr_jabatan']->id_bagian,$query['curr_jabatan']->id_jenis_jabatan);

			
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");

			
			$query['master_prodi'] = $this->Model_simpeg->getMasterProgdi();
			$query['master_universitas'] = $this->Model_simpeg->getMasterUniversitas();
			//$data['content'] = $this->load->view('pegawai/_form_edit',$query,true);
			$this->load->view('simpeg/manage/_form_edit',$query);
			//echo "berhasil";
			// if(!$this->input->is_ajax_request()){
			// 	// $this->load->view("pegawai/testing");
			// 	$this->load->view('index_simpeg',$data);
			// }
		}
		function update(){
			$biodata = array(
	    		'kd_posisi_pegawai' => $this->input->post("posisi_pegawai"),
				// 'npp' => $this->input->post('npp'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				// 'usrnm' => $this->input->post('npp'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'nidn' => $this->input->post('nidn'),
				'status_nikah' => $this->input->post('status_nikah'),
				'status_pegawai' => $this->input->post('status'),
				'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir'))),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'gelar_depan' => $this->input->post('gelar_depan'),
				'gelar_belakang' => $this->input->post('gelar_belakang'),
				'no_ktp' => $this->input->post('no_ktp'),
				'no_kk' => $this->input->post('no_kk'),

				'agama' => $this->input->post('agama'),
				'email1' => $this->input->post('email1'),
				'notelp' => $this->input->post('no_telp'),

				'nama_pasangan' => $this->input->post('nama_pasangan'),
				'tgl_lahir_pasangan' => date('Y-m-d', strtotime($this->input->post('tgl_lahir_pasangan'))),
				'pekerjaan_pasangan' => $this->input->post('pekerjaan_pasangan'),
				'jumlah_anak' => $this->input->post('jumlah_anak'),
				// 'foto' => $nama_foto,
				// 'paswd' => $password,
				'homebase' => $this->input->post("homebase"),
				'no_bpjs_kesehatan' => $this->input->post('no_bpjs_kesehatan'),
				'no_bpjs_ketenagakerjaan' => $this->input->post('no_bpjs_ketenagakerjaan'),

			);
			$this->db->trans_start();
			$where_biodata = array("id"=>$this->input->post("id_biodata"));
			$r = $this->db->update('pegawai_biodata', $biodata,$where_biodata);
			
			$universitas = $this->input->post("universitas");
			$universitasid = $this->input->post("universitasid");
			$jurusan = $this->input->post("jurusan");
			$jurusanid = $this->input->post("jurusanid");
			$jenjang = $this->input->post("jenjang");
			$id_pegawai = $this->input->post("id_pegawai");
			$status = $this->input->post("status_riwayat");
			foreach($universitasid as $key=>$value){
				$univ_id = $value;
				if($value == 999999){
					$data_univ = array(
									"nama_universitas" => $universitas[$key],
								);
					$univ = $this->db->insert("master_universitas",$data_univ);
					$univ_id = $this->db->insert_id();
				}
				$prodi_id = $jurusanid[$key];
				if($prodi_id == 999999){
					$data_prodi = array(
										"nama_jurusan"=>$jurusan[$key],
									);
					$prodi = $this->db->insert("master_program_studi",$data_prodi);
					$prodi_id = $this->db->insert_id();
				}

				if(!empty($value)){
					if($status[$key] == 0){
						$data_riwayat = array(
							'id_pegawai' => $id_pegawai,
							'jenjang' => $jenjang[$key],
							'universitas' => $univ_id,
							'jurusan' => $prodi_id
						);
						$riwayat = $this->db->insert("pegawai_riwayat_pendidikan",$data_riwayat);
					}else{
						$data_riwayat = array(
							
							'jenjang' => $jenjang[$key],
							'universitas' => $univ_id,
							'jurusan' => $prodi_id
						);
						$where_riwayat = array("id_pegawai"=>$id_pegawai);
						$riwayat = $this->db->update("pegawai_riwayat_pendidikan",$data_riwayat,$where_riwayat);
					}
					
					
				}
			}
			$id_golongan = $this->input->post("id_golongan");
			$id_fungsional = $this->input->post("id_jabatan_fungsional");
			$id_struktural = $this->input->post("id_jabatan_struktural");
			$where_golongan = array("id"=>$id_golongan);
			$data_golongan = array(
				//'id_pegawai' => $id,
				'nama' => $this->input->post("golongan_skrg"),
				'no_pengantar' => $this->input->post("np_skrg"),
				'no_sk' => $this->input->post("nosk_skrg"),
				'tanggal_sk' => date('Y-m-d', strtotime($this->input->post("tglsk_skrg"))),
				'tmt' => date('Y-m-d', strtotime($this->input->post("tmt_skrg"))),
				'status' => "sekarang",
			);
			$golongan = $this->db->update("pegawai_golongan",$data_golongan,$where_golongan);

			$where_fungsional = array("id"=>$id_fungsional);
			$data_fungsional = array(
				//'id_pegawai' => $id,
				'jabatan_fungsional_sekarang' => $this->input->post("jabatan_fungsional"),
				'no_sk_fungsional' => $this->input->post("nosk_fungsional"),
				'tgl_sk_fungsional' => date('Y-m-d', strtotime($this->input->post("tglsk_fungsional"))),
				'tmt_sk_fungsional' => date('Y-m-d', strtotime($this->input->post("tmtsk_fungsional"))),
				'kum' => $this->input->post("kum_fungsional"),
			);
			$fungsional = $this->db->update("pegawai_jabatan_fungsional", $data_fungsional,$where_fungsional);

			$where_struktural = array("id"=>$id_struktural);
			$data_struktural = array(
				//'id_pegawai' => $id,
				'unit_kerja' => $this->input->post("unit_kerja"),
				
				'id_jabatan_struktural' => $this->input->post("jabatan_struktural"),
				'no_sk_struktural' => $this->input->post("nosk_struktural"),
				'tanggal_sk_struktural' => date('Y-m-d', strtotime($this->input->post("tglsk_struktural"))),
				'tmt_sk_struktural' => date('Y-m-d', strtotime($this->input->post("tmtsk_struktural"))),
			);
			$struktural = $this->db->update("pegawai_jabatan_struktural",$data_struktural,$where_struktural);
			if($this->db->trans_complete()){
				redirect("/simpeg/manage/profil/" . $this->input->post("npp"));	
			}
		}
		function ubah_photo(){
			$config['upload_path'] = './assets/foto_pegawai/';
		    $config['allowed_types'] = 'jpg';
		    $config['max_size']  = '1048';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'pegawai_'.$this->input->post('npp').date('YmdHis');
		    $config['file_ext'] = '.jpg';
		    $config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    $nama_foto = "";
		    if($this->upload->do_upload('foto')){ 
		    	$nama_foto = $config['file_name'].$config['file_ext'];
		    	$biodata = array(
		    		'foto' => $nama_foto,
		    	);
		    	$where_biodata = array("id_pegawai"=> $this->input->post("id"));
		    	$r = $this->db->update('pegawai_biodata', $biodata,$where_biodata);
		    	if($r)
		    		redirect("/simpeg/manage/profil/" . $this->input->post("npp"));	
		    	else 
		    		echo "gagal";
		    }else{
		    	echo "gagal";
		    }

		}
		function ubah_password(){
			if(!empty($this->input->post("password"))){
				$bcrypt = new Bcrypt();
		    	$paswd = $bcrypt->create($this->input->post("password"));
				$pegawai = array(
					'paswd' => $paswd,
				);
				$where_pegawai = array("id"=>$this->input->post("id"));
				$r = $this->db->update('pegawai',$pegawai,$where_pegawai);
				if($r)
					redirect("/simpeg/manage/profil/" . $this->input->post("npp"));	
		    	else 
		    		echo "gagal";
			}
		}
		function ubah_npp(){
			$npp = $this->input->post("npp");
			if(!empty($npp)){
				$pegawai = array(
					'npp' => $npp,
				);
				$where_pegawai = array("id"=>$this->input->post("id"));
			}else{
				$query = $this->Model_simpeg->getIdPegawai($this->input->post('npp_lama'));
				$pegawai = array(
					'npp' => $this->input->post('npp_baru'),
				);
				$where_pegawai = array("id"=>$query->id);
			}

			
				$r = $this->db->update('pegawai',$pegawai,$where_pegawai);
				if($r){
					if(!empty($this->input->post("status"))){
						redirect("/simpeg/manage/npp/" . $npp);
					}else{
						redirect("/simpeg/manage/profil/" . $npp);
					}
				}
		    	else 
		    		echo "gagal";
		}
		function npp(){
			if(!empty($this->uri->segment('4'))){
				$_SESSION['npp'] = $this->uri->segment('4');
			}
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$data['content'] = $this->load->view('simpeg/manage/npp',$hasil,true);

			$this->load->view('index_simpeg',$data);
		}
		function Home(){
			
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			//$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$hasil['url'] = "edit";
			$this->load->view('simpeg/manage/content_profil',$hasil);

			//$this->load->view('index_simpeg',$data);
		}
		
		function riwayat($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			//$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->Model_simpeg->getRiwayatPendidikan2($id);
			$hasil['master_kota'] = $this->Model_simpeg->getMasterKota();
			$hasil['id_pegawai'] = $id;
			$hasil['jenjang'] = array("D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
			$hasil['master_prodi'] = $this->Model_simpeg->getMasterProgdi();
			$hasil['master_universitas'] = $this->Model_simpeg->getMasterUniversitas();
			$this->load->view('simpeg/manage/riwayat_pendidikan',$hasil);
		}
		function update_pendidikan(){
			$id = $this->input->post("id");
			$jurusan = $this->input->post("jurusan");
			$jurusan_lain = $this->input->post("jurusan_lain");
			$universitas = $this->input->post("universitas");
			$universitas_lain = $this->input->post("universitas_lain");
			$id_jurusan = $jurusan;
			if(!empty($jurusan_lain)){
				$jurusan_array = array(
					'nama_jurusan' => $jurusan_lain,
				);
				$insert = $this->db->insert('master_program_studi',$jurusan_array);
				$id_jurusan = $this->db->insert_id();
			}
			$id_universitas = $universitas;
			if(!empty($universitas_lain)){
				$universitas_array = array(
					'nama_universitas' => $universitas_lain
				);
				$insert = $this->db->insert('master_universitas',$universitas_array);
				$id_universitas = $this->db->insert_id();
			}

			$riwayat = array(
				"jenjang" => $this->input->post("jenjang"),
				"universitas" => $id_universitas,
				"jurusan" => $id_jurusan,
				"tempat" => $this->input->post("tempat"),
				"no_ijazah" => $this->input->post("no_ijazah"),
				"tanggal_ijazah" => $this->input->post("tanggal"),
				"tahun" => $this->input->post("tahun"),
				"jenjang_profesi" => $this->input->post("jenjang_profesi"),
			);

			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_riwayat_pendidikan',$riwayat,$where_riwayat);

			$config['upload_path'] = './assets/images/ijazah/';
		    $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
		    $config['max_size']  = '2048';
		    $config['overwrite'] = TRUE;
		    if(!empty($_FILES['ijazah']['name'])){
		    	
		    	$config['file_name'] = 'ijazah-'. date('YmdHis');
			    $this->load->library('upload', $config); 
			    //$nama_foto = "";
			    if($this->upload->do_upload('ijazah')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"ijazah" => $nama_foto,
					);
					$where_riwayat = array("id"=>$id);
					$r = $this->db->update('pegawai_riwayat_pendidikan', $riwayat,$where_riwayat);
			    }
		    }

		    if($r){
				echo 1;
			}else{
				echo 2;
			}

		}
		function refreshtable(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['master_prodi'] = $this->Model_simpeg->getMasterProgdi();
			$hasil['master_universitas'] = $this->Model_simpeg->getMasterUniversitas();
			$hasil['riwayat'] = $this->Model_simpeg->getRiwayatPendidikan2($id);
			$hasil['master_kota'] = $this->Model_simpeg->getMasterKota();
			$this->load->view('simpeg/manage/tbl_riwayat_pendidikan',$hasil);
		}
		function add_pendidikan(){
			$config['upload_path'] = './assets/images/ijazah/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';
		    $config['max_size']  = '1024';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'ijazah-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('ijazah')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(

					"id_pegawai" => $this->input->post("id_pegawai"),
					"jenjang" => $this->input->post("jenjang"),
					"jurusan" => $this->input->post("jurusan"),
					"universitas" => $this->input->post("universitas"),
					"tempat" => $this->input->post("tempat"),
					"no_ijazah" => $this->input->post("no_ijazah"),
					"tanggal_ijazah" => $this->input->post("tanggal_ijazah"),
					"tahun" => $this->input->post("tahun"),
					"jenjang_profesi" => $this->input->post("jenjang_profesi"),
					"ijazah" => $nama_foto,
				);
				$r = $this->db->insert('pegawai_riwayat_pendidikan', $riwayat);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
		    	$riwayat = array(
					"id_pegawai" => $this->input->post("id_pegawai"),
					"jenjang" => $this->input->post("jenjang"),
					"jurusan" => $this->input->post("jurusan"),
					"universitas" => $this->input->post("universitas"),
					"tempat" => $this->input->post("tempat"),
					"no_ijazah" => $this->input->post("no_ijazah"),
					"tanggal_ijazah" => $this->input->post("tanggal_ijazah"),
					"tahun" => $this->input->post("tahun"),
					"jenjang_profesi" => $this->input->post("jenjang_profesi"),
				);
				$r = $this->db->insert('pegawai_riwayat_pendidikan', $riwayat);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }
			
		}
		function delete_pendidikan(){
			$id = array(
				"id"=>$this->input->post("id"),
			);
			$r = $this->db->delete("pegawai_riwayat_pendidikan",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}

		function rekap(){
			$data['title'] = "Statistik Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu($this->authact->getRole());
			$query['query'] = $this->Model_simpeg->getProgdi();
			$query['kategori'] = array(1=>"Grafik Jenis Pekerjaan","Grafik Jenis Kelamin","Grafik Agama");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['posisi'] = $this->Model_simpeg->getPosisi();
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");

			if(!empty($this->input->post("unit")) && !empty($this->input->post("kategori"))){

				$query['kategori_result'] = $this->input->post("kategori");
				$query['unit_result'] = $this->Model_simpeg->getUnitResult($this->input->post("unit"));
				
				$query['result'] = $this->load->view("pegawai/grafik" . $query['kategori_result'],$query,true);
			}
			
			$data['content'] = $this->load->view('pegawai/statistik',$query,true);

			$this->load->view('index_simpeg',$data);
		}
		function nonaktif($id){
			$data = array(		
				'status' => "0",
			);
			$where = array("npp"=>$id);
			$riwayat = $this->db->update("pegawai",$data,$where);
			if($riwayat){
				//echo $id;
				redirect("/simpeg/manage/");
			}
		}
		function update_ijazah(){
			$config['upload_path'] = './assets/images/ijazah/';
		    $config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '2048';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'ijazah-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('ijazah')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"ijazah" => $nama_foto,
				);
				$where_biodata = array("id"=>$this->input->post("id"));
				$r = $this->db->update('pegawai_riwayat_pendidikan', $riwayat,$where_biodata);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
		    	echo 3;
		    }

		}
		function edit_form_pendidikan(){
			$id = $this->input->post("id");
			$hasil['row'] = $this->Model_simpeg->getRiwayatPendidikanDetail($id);
			$hasil['master_kota'] = $this->Model_simpeg->getMasterKota();
			$hasil['id_pegawai'] = $id;
			$hasil['master_prodi'] = $this->Model_simpeg->getMasterProgdi();
			$hasil['master_universitas'] = $this->Model_simpeg->getMasterUniversitas();
			$hasil['jenjang'] = array("D-I", "D-II", "D-III", "D-IV", "S1","S2","S3");
			//echo "asdasdasd";
			$this->load->view('simpeg/manage/form_edit_pendidikan',$hasil);
		}
	}
?>