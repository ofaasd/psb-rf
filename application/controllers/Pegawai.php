<?php
	
	use Zend\Crypt\Password\Bcrypt;

	class Pegawai extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url());
			}
			$this->load->model('Model_front');
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
		}

		function index()
		{
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			
			$hasil['query'] = $this->Model_pegawai->get_all();

			$data['content'] = $this->load->view('pegawai/awal',$hasil,true);
			$this->load->view('index',$data);
		}
		function tambah_pegawai(){
			
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$query['jenis_pegawai'] = $this->db->query("select * from pegawai_jenis")->result();
			$query['progdi'] = $this->db->query("select * from program_studi")->result();
			//$query['provinsi'] = $this->db->query("select * from prov_kota_new group by prov_id")->result();
			$query['fakultas'] = $this->db->query("select * from fakultas")->result();
			$query['master_prodi'] = $this->db->query("select * from master_program_studi")->result();
			$query['universitas'] = $this->db->query("select * from master_universitas order by id asc")->result();
			$query['last_id'] = $this->db->query("select id from pegawai order by id desc limit 1")->row()->id;
			$query['jenis_kelamin'] = array("L"=>"Laki-laki","P"=>"Perempuan");
			$query['golongan_darah'] = array("A","B","AB","O");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['bagian'] = $this->db->query("select bagian from jabatan_struktural group by bagian")->result();
			$query['status_kawin'] = array("Lajang","Kawin");

			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$query['url_simple_insert'] = base_url() . "pegawai/insert1/";
			$query['url_insert_all'] = base_url() . "pegawai/save/";
			$query['redirect1'] = base_url() . "pegawai/edit/";
			$query['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			$data['content'] = $this->load->view('pegawai/form-wizard',$query,true);
			$this->load->view('index',$data);
		}
		function profil(){
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$data['content'] = $this->load->view('pegawai/profil',$hasil,true);
			$this->load->view('index',$data);
		}
		function edit($id){
			
			$data['title'] = "Edit Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			// $query['query'] = $this->db->query("SELECT b.*,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai FROM `pegawai` p
			// 	INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
			// 	where b.id = '".$id."'")->row();
			$query['query'] = $this->db->query("SELECT b.*,p.npp,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai FROM `pegawai` p
				INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
				where p.npp = '".$id."'")->row();

			//$id = $query['query']->pegawai_id;
			$id_pegawai = $query['query']->id_pegawai;
			//echo $id_pegawai;
			
			$query['pegawai_golongan'] = $this->Model_simpeg->getDetailGolongan($id_pegawai);
			$query['pegawai_jabatan_fungsional'] = $this->Model_simpeg->getDetailJabatanFungsional($id_pegawai);
			$query['pegawai_jabatan_struktural'] = $this->Model_simpeg->getDetailjabatanStruktural($id_pegawai);

			
			// $query['query'] = $this->db->query("SELECT b.*,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai,npp FROM `pegawai` p
			// 	INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
			// 	where npp= '".$id."'")->row();
			// $id_pegawai = $query['query']->id_pegawai;
			// $where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			// $query['pegawai_golongan'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_golongan",$where_id_pegawai)->row();
			// $query['pegawai_jabatan_fungsional'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_fungsional",$where_id_pegawai)->row();
			// $query['pegawai_jabatan_struktural'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_struktural",$where_id_pegawai)->row();
			
			$where = array("id" => $id_pegawai);
			$query['universitas'] = $this->db->get_where("pegawai_riwayat_pendidikan",$where);
			$query['jenis_pegawai'] = $this->Model_simpeg->getJenisPegawai();
			$query['progdi'] = $this->Model_simpeg->getProgdi();
			$query['homebase'] = $this->Model_simpeg->getHomebase();
			$query['fakultas'] = $this->Model_simpeg->getFakultas();
			$query['last_id'] = $this->Model_simpeg->getLastIdPegawai();
			$query['jenis_kelamin'] = array("L"=>"Laki-laki","P"=>"Perempuan");
			$query['golongan_darah'] = array("A","B","AB","O");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['bagian'] = $this->Model_simpeg->getBagian();
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			//$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['curr_jabatan'] = $this->Model_simpeg->getDetailJabatan($query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			if($query['pegawai_jabatan_struktural']->id_jabatan_struktural == 0){
				$query['unit_kerja'] = $this->Model_simpeg->getUnitKerja();
				$query['bagian'] = array();
				$query['jenis_jabatan'] = array();
				$query['jabatan_struktural'] = array();
			}else{
				$query['unit_kerja'] = $this->Model_simpeg->getUnitKerja();
				$query['bagian'] = $this->Model_simpeg->getBagianStruktural($query['curr_jabatan']->id_unit_kerja);
				$query['jenis_jabatan'] = $this->Model_simpeg->getJenisJabatan($query['curr_jabatan']->id_unit_kerja);
				$query['jabatan_struktural'] = $this->Model_simpeg->getJabatan($query['curr_jabatan']->id_bagian,$query['curr_jabatan']->id_jenis_jabatan);
			}
			

			if(!empty($query['jabatan_struktural']->bagian)){
				$where_bagian = array("bagian"=>$query['jabatan_struktural']->bagian);
			}else{
				$where_bagian = array("bagian"=>"Akademik");
			}
			//echo $query['jabatan_struktural']->bagian;
			$query['master_prodi'] = $this->db->query("select * from master_program_studi")->result();
			$query['master_universitas'] = $this->db->query("select * from master_universitas order by id asc")->result();

			
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");

			$data['content'] = $this->load->view('pegawai/_form_edit',$query,true);

			//$data['content'] = $this->load->view('pegawai/form-wizard-edit',$query,true);
			$this->load->view('index',$data);
			//echo "berhasil";
			// $this->load->view("pegawai/testing");
		}
		function edit_ajax($id){
			
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			
			$query['query'] = $this->db->query("SELECT *,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai FROM `pegawai` p
				INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
				where p.npp = '".$id."'")->row();

			//$id = $query['query']->pegawai_id;
			$id_pegawai = $query['query']->id_pegawai;
			//echo $id_pegawai;
			
			$query['pegawai_golongan'] = $this->Model_simpeg->getDetailGolongan($id_pegawai);
			$query['pegawai_jabatan_fungsional'] = $this->Model_simpeg->getDetailJabatanFungsional($id_pegawai);
			$query['pegawai_jabatan_struktural'] = $this->Model_simpeg->getDetailjabatanStruktural($id_pegawai);
			
			$where = array("id" => $id_pegawai);
			$query['universitas'] = $this->db->get_where("pegawai_riwayat_pendidikan",$where);
			$query['jenis_pegawai'] = $this->Model_simpeg->getJenisPegawai();
			$query['progdi'] = $this->Model_simpeg->getProgdi();
			$query['homebase'] = $this->Model_simpeg->getHomebase();
			$query['fakultas'] = $this->Model_simpeg->getFakultas();
			$query['last_id'] = $this->Model_simpeg->getLastIdPegawai();
			$query['jenis_kelamin'] = array("L"=>"Laki-laki","P"=>"Perempuan");
			$query['golongan_darah'] = array("A","B","AB","O");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['bagian'] = $this->Model_simpeg->getBagian();
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu","Konghucu","Lainnya");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$query['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();
			$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['jabatan_struktural'] = $this->db->get_where("jabatan_struktural",$where_id_jabatan)->row();

			if(!empty($query['jabatan_struktural']->bagian)){
				$where_bagian = array("bagian"=>$query['jabatan_struktural']->bagian);
			}else{
				$where_bagian = array("bagian"=>"Akademik");
			}
			//echo $query['jabatan_struktural']->bagian;
			$query['master_prodi'] = $this->db->query("select * from master_program_studi")->result();
			$query['master_universitas'] = $this->db->query("select * from master_universitas order by id asc")->result();
			
			$query['curr_jabatan'] = $this->Model_simpeg->getDetailJabatan($query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			
			$query['unit_kerja'] = $this->Model_simpeg->getUnitKerja();
			$query['bagian'] = (!empty($query['curr_jabatan']->id_unit_kerja))?$this->Model_simpeg->getBagianStruktural($query['curr_jabatan']->id_unit_kerja):1;
			$query['jenis_jabatan'] = (!empty($query['curr_jabatan']->id_unit_kerja))?$this->Model_simpeg->getJenisJabatan($query['curr_jabatan']->id_unit_kerja):1;
			$query['jabatan_struktural'] = (!empty($query['curr_jabatan']->id_bagian))?$this->Model_simpeg->getJabatan($query['curr_jabatan']->id_bagian,$query['curr_jabatan']->id_jenis_jabatan):1;
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");

			$this->load->view('pegawai/_form_edit',$query);

			//$data['content'] = $this->load->view('pegawai/form-wizard-edit',$query,true);
			//$this->load->view('index',$data);
			//echo "berhasil";
			// $this->load->view("pegawai/testing");
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
			$data = $this->db->query("select * from program_studi")->result();
			echo json_encode($data);
		}
		function get_homebase(){
			$data = $this->db->query("select * from pegawai_homebase")->result();
			echo json_encode($data);
		}
		function insert1(){
			if($this->input->post()){
				$npp = $this->input->post('npp');
				$jumlah = $this->db->query("select count(*) as jumlah from pegawai where npp='$npp'")->row()->jumlah;
				if($jumlah > 0){
					echo "npp sudah terdaftar";
				}else{
					$password = "";
			    	if(empty($this->input->post("password"))){
			    		$password = $this->input->post('npp');
			    	}else{
			    		$password = $this->input->post('password');
			    	}
			    	$bcrypt = new Bcrypt();
			    	$paswd = $bcrypt->create($password);
					$pegawai = array(
						'npp' => $this->input->post('npp'),
						'nama' => $this->input->post('nama_lengkap'),
						'usrnm' => $this->input->post('npp'),
						'paswd' => $paswd,
					);
					$this->db->trans_start();
					$insert = $this->db->insert("pegawai",$pegawai);
					$id = $this->db->insert_id();
					$biodata = array(
						'id_pegawai' => $id,
						'kd_posisi_pegawai' => $this->input->post("posisi_pegawai"),
						'id_progdi' => $this->input->post("id_progdi"),
						'nama_lengkap' => $this->input->post("nama_lengkap"),
						'jenis_kelamin' => $this->input->post("jenis_kelamin"),

					);
					$insert = $this->db->insert("pegawai_biodata",$biodata);

					$data_riwayat = array(
							'id_pegawai' => $id,
						);
					$riwayat = $this->db->insert("pegawai_riwayat_pendidikan",$data_riwayat);


					$data_golongan = array(
						'id_pegawai' => $id,
					);
					$golongan = $this->db->insert("pegawai_golongan",$data_golongan);

					$data_fungsional = array(
						'id_pegawai' => $id,
					);
					$fungsional = $this->db->insert("pegawai_jabatan_fungsional", $data_fungsional);

					$data_struktural = array(
						'id_pegawai' => $id,
						
					);
					$struktural = $this->db->insert("pegawai_jabatan_struktural",$data_struktural);

					if($this->db->trans_complete()){
						echo "berhasil";
					}	
				}
				
				
			}
		}
		function save(){
			if($this->input->post()){
				$npp = $this->input->post('npp');
				$config['upload_path'] = './assets/foto_pegawai/';
			    $config['allowed_types'] = 'jpg';
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
		    		$password = $this->authact->generatepass($this->input->post('npp'));
		    	}else{
		    		$password = $this->authact->generatepass($this->input->post('password'));
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
					//'npp' => $this->input->post('npp'),
					//'nama' => $this->input->post('nama_lengkap'),
					// 'usrnm' => $this->input->post('npp'),
					'alamat' => $this->input->post('alamat'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'nidn' => $this->input->post('nidn'),
					'status_nikah' => $this->input->post('status_nikah'),
					'status_pegawai' => $this->input->post('posisi_pegawai'),
					// 'tanggal_lahir' => date('Y-m-d', strtotime($this->input->post('tanggal_lahir'))),
					// 'tempat_lahir' => $this->input->post('tempat_lahir'),
					'gelar_depan' => $this->input->post('gelar_depan'),
					'gelar_belakang' => $this->input->post('gelar_belakang'),
					'no_ktp' => $this->input->post('no_ktp'),
					'no_kk' => $this->input->post('no_kk'),
					'provinsi' => $this->input->post("provinsi"),
					'kotakab' => $this->input->post("kotakab"),
					'kecamatan' => $this->input->post("kecamatan"),
					'kelurahan' => $this->input->post("kelurahan"),
					'golongan_darah' => $this->input->post("golongan_darah"),

					// 'agama' => $this->input->post('agama'),
					// 'email1' => $this->input->post('email1'),
					// 'notelp' => $this->input->post('no_telp'),

					'nama_pasangan' => $this->input->post('nama_pasangan'),
					'tgl_lahir_pasangan' => date('Y-m-d', strtotime($this->input->post('tgl_lahir_pasangan'))),
					'pekerjaan_pasangan' => $this->input->post('pekerjaan_pasangan'),
					'jumlah_anak' => $this->input->post('jumlah_anak'),
					// 'foto' => $nama_foto,
					'id_progdi' => $this->input->post("homebase"),
					'homebase' => $this->input->post("homebase"),
					
					'no_bpjs_kesehatan' => $this->input->post('no_bpjs_kesehatan'),
					'no_bpjs_ketenagakerjaan' => $this->input->post('no_bpjs_ketenagakerjaan'),

				);
				$b = $this->db->insert('pegawai_biodata',$biodata);
				// $this->db->trans_start();
				// $r = $this->db->insert('pegawai_biodata', $biodata);
				// $id = $this->db->insert_id();
				$universitas = $this->input->post("universitasid");
				$jurusan = $this->input->post("jurusanid");
				$jenjang = $this->input->post("jenjang");
				foreach($universitas as $key=>$value){
					if(!empty($value)){
						$data_riwayat = array(
							'id_pegawai' => $id,
							'jenjang' => $jenjang[$key],
							'universitas' => $value,
							'jurusan' => $jurusan[$key]
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
				if($this->db->trans_complete()){
					echo "berhasil";
				}else{
					echo "gagal";
				}
				// return $r;
				// var_dump($r);
			}

		}
		function update(){
			$pegawai_id = $this->input->post("pegawai_id");
			$npp = $this->input->post('nip');
			$array_pegawai = array(
				'npp' => $npp,
			);
			$where_pegawai = array(
				'id' => $pegawai_id,
			);
			$r_update = $this->db->update('pegawai', $array_pegawai,$where_pegawai);
			$biodata = array(
	    		'kd_posisi_pegawai' => $this->input->post("posisi_pegawai"),
				//'npp' => $this->input->post('nip'),
				'homebase' => $this->input->post('homebase'),
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
				'nama_pasangan' => $this->input->post('nama_pasangan'),
				'tgl_lahir_pasangan' => date('Y-m-d', strtotime($this->input->post('tgl_lahir_pasangan'))),
				'pekerjaan_pasangan' => $this->input->post('pekerjaan_pasangan'),
				'jumlah_anak' => $this->input->post('jumlah_anak'),
				'provinsi' => $this->input->post("provinsi"),
				'kotakab' => $this->input->post("kotakab"),
				'kecamatan' => $this->input->post("kecamatan"),
				'kelurahan' => $this->input->post("kelurahan"),
				'nohp' => $this->input->post("nohp"),
				'notelp' => $this->input->post("notelp"),
				'agama' => $this->input->post("agama"),
				'email1' => $this->input->post("email1"),
				// 'foto' => $nama_foto,
				// 'paswd' => $this->authact->generatepass($this->input->post('password')),
				'no_bpjs_kesehatan' => $this->input->post('no_bpjs_kesehatan'),
				'no_bpjs_ketenagakerjaan' => $this->input->post('no_bpjs_ketenagakerjaan'),
			);
				
				$paswd = $this->authact->generatepass($this->input->post('password'));
			$pgw = array(
				'npp' => $npp,
				'paswd' => $paswd
			);

			$this->db->trans_start();
			$where_biodata = array("id"=>$this->input->post("id_biodata"));
			$r = $this->db->update('pegawai_biodata', $biodata,$where_biodata);
			$this->db->where('npp',$npp);
			$this->db->update('pegawai', $pgw);
			
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
						$where_riwayat = array("id"=>$status[$key]);
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
				if($this->authact->getRole() == 1){
					redirect("/pegawai/profil/" . $npp);
				}else{
					redirect("/simpeguser/biodata/edit_new");
				}
				echo "berhasil";
			}
		}
		function statistik(){

			$data['title'] = "Statistik Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$query['query'] = $this->db->query("select * from program_studi")->result();
			$query['kategori'] = array(1=>"Grafik Jenis Pekerjaan","Grafik Jenis Kelamin","Grafik Agama");
			$query['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$query['posisi'] = $this->db->query("select * from pegawai_posisi")->result();
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");

			if(!empty($this->input->post("unit")) && !empty($this->input->post("kategori"))){

				$query['kategori_result'] = $this->input->post("kategori");
				$query['unit_result'] = $this->db->query("select * from program_studi where id=" . $this->input->post("unit"))->row()->nama_jurusan;
				
				$query['result'] = $this->load->view("pegawai/grafik" . $query['kategori_result'],$query,true);
			}
			
			$data['content'] = $this->load->view('pegawai/statistik',$query,true);

			$this->load->view('index',$data);

		}
		function form_wizard(){
			$data['title'] = "Statistik Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$query['query'] = $this->db->query("select * from program_studi")->result();
			$data['content'] = $this->load->view('pegawai/form-wizard',$query,true);
			$this->load->view('index',$data);
		}
		function get_bagian(){
			$id_unit = $this->input->post("id_unit");
			$bagian = $this->Model_simpeg->getBagianStruktural($id_unit);
			echo '<select class="form-control" name="bagian" id="bagian">
                    <option value="0">-- Bagian --</option>
                   ';
                        foreach($bagian as $row){
                            echo "<option value='" . $row->id . "' ";
                            echo ">" . $row->nama_bagian . "</option>";
                        }
            echo '</select>';
		}
		function get_jenis_jabatan(){
			$id_unit = $this->input->post("id_unit");
			$id_bagian = $this->input->post("id_bagian");
			$jenis_jabatan = $this->Model_simpeg->getJenisJabatan($id_unit);
			echo '<select class="form-control" name="jenis_jabatan" id="jenis_jabatan" >
                    <option value="0">-- Jenis Jabatan --</option>';
                        foreach($jenis_jabatan as $row){
                            
                            if($id_bagian != 5){
                            	echo "<option value='" . $row->id . "' ";
                            	echo ">" . $row->nama_jenis . "</option>";
                                break;
                            }else{
                            	echo "<option value='" . $row->id . "' ";
                            	echo ">" . $row->nama_jenis . "</option>";
                            }
                        }
            echo '</select>';
		}
		function get_jabatan_struktural(){
			$id_bagian = $this->input->post("id_bagian");
			$id_jenis_jabatan = $this->input->post("id_jenis_jabatan");
			$jabatan_struktural = $this->Model_simpeg->getJabatan($id_bagian,$id_jenis_jabatan);
			echo '<select class="form-control" name="jabatan_struktural" id="jabatan">
                    <option value="0">-- Jabatan Struktural --</option>';
                    
                    foreach($jabatan_struktural as $jabatan){
                    echo "<option value='" . $jabatan->id . "'";
                    echo ">" . $jabatan->nama_jabatan . "</option>";
                    }
            echo "</select>";
		}
		/* function generate_users(){
			$pegawai = $this->db->get("pegawai")->result();
			foreach($pegawai as $row){
				$users = $this->db->get_where("users",array("userid"=>$row->id));
				if($users->num_rows() > 0){
					echo "sudah ada";

				}else{
					$array = array(
						'userid' => $row->id,
						'role' => 6,
						'simpeg_role' => 2,
						'active' => 1,
					);
					$insert = $this->db->insert("users",$array);
					if($insert){
						echo "berhasil";
					}else{
						echo "gagal";
					}
				}
				echo "<br />";
			}
		} */
		public function reset_all_password(){
			$pegawai = $this->db->get_where("pegawai",array('id <>'=>1))->result();
			foreach($pegawai as $row){
				$password = $row->usrnm . "SF";
				echo $password;
				echo "<br />";
				$bcrypt = new Bcrypt();
			    $paswd = $bcrypt->create($password);
				echo $paswd;
				echo"<br>";
				
				$array = array(
					'paswd' => $paswd,
				);
				$update = $this->db->update('pegawai',$array,array('id'=>$row->id));
				if($update){
					echo "berhasil";
				}
				echo"<br>";echo"<br>";
			}
		}
		public function lihat_krm(){
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$data['content'] = $this->load->view('pegawai/lihat_krm',$hasil,true);
			$this->load->view('index',$data);
		}
		public function krm_ajax($id){
			$query['jadwal'] = $this->db->select('master_jadwal_temp.*,master_mata_kuliah.nama_mata_kuliah')->from('master_jadwal_temp')->join('master_mata_kuliah','master_mata_kuliah.kode_mata_kuliah=master_jadwal_temp.kode_mata_kuliah','inner')->where('id_dosen',$id)->get()->result();
			$this->load->view('pegawai/v_krm',$query); 
		}
		public function krm(){
			$id_dosen = $this->input->post("id_dosen");
			$query = $this->db->get('master_jadwal_temp')->where('id_dosen',$id_dosen)->result();
			
		}
		public function struktur(){
			$data['title'] = "Struktur Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			$hasil['s'] = $this->db->get('struktur_pegawai')->row();
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$data['content'] = $this->load->view('struktur/index',$hasil,true);
			$this->load->view('index',$data);
		}
		public function save_struktur(){
			$ketua_st = $this->input->post('ketua_st');
			$pembantu_1 = $this->input->post('pembantu_1');
			$pembantu_2 = $this->input->post('pembantu_2');
			$pembantu_3 = $this->input->post('pembantu_3');
			$prodi_d3 = $this->input->post('prodi_d3');
			$prodi_s1 = $this->input->post('prodi_s1');
			$sekertaris_prodi_d3 = $this->input->post('sekertaris_prodi_d3');
			$sekertaris_prodi_s1 = $this->input->post('sekertaris_prodi_s1');
			$ketua_mutu = $this->input->post('ketua_mutu');
			$ketua_penelitian = $this->input->post('ketua_penelitian');
			$sekertaris_penelitian = $this->input->post('sekertaris_penelitian');
			$koor_lab = $this->input->post('koor_lab');
			$koor_sarana = $this->input->post('koor_sarana');

			$data = array(
							'ketua_st' => $ketua_st,
							'pembantu_1' => $pembantu_1,
							'pembantu_2' => $pembantu_2,
							'pembantu_3' => $pembantu_3,
							'prodi_d3' => $prodi_d3,
							'prodi_s1' => $prodi_s1,
							'sekertaris_prodi_d3' => $sekertaris_prodi_d3,
							'sekertaris_prodi_s1' => $sekertaris_prodi_s1,
							'ketua_mutu' => $ketua_mutu,
							'ketua_penelitian' => $ketua_penelitian,
							'sekertaris_penelitian' => $sekertaris_penelitian,
							'koor_lab' => $koor_lab,
							'koor_sarana' => $koor_sarana
						 );
			$this->db->update('struktur_pegawai', $data, ['id' => 1]);
			redirect('pegawai/struktur');
		}
		public function delete_pegawai($npp=''){
			$id_pegawai = $this->db->get_where('pegawai', ['npp' => $npp])->row()->id;
			$this->db->delete('pegawai', ['npp' => $npp]);
			$this->db->delete('pegawai_biodata', ['id_pegawai' => $id_pegawai]);
			redirect('pegawai');
		}
		function reset_pass_pegawai($npp=''){
			$bcrypt = new Bcrypt();
			$pass = $bcrypt->create($npp);
			$this->db->update('pegawai', ['paswd' => $pass], ['npp' => $npp]);
			$this->session->set_userdata('notif', '<script>alert("Setel Ulang Kata Sandi Berhasil")</script>');
			redirect('pegawai');

		}
	}
?> 