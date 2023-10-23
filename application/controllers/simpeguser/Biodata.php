<?php

	use Zend\Crypt\Password\Bcrypt;

	class Biodata extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(!$this->authact->logged_in())
			{
				redirect(base_url() . 'login/simpeg');
			}
			$this->load->model('Model_front');
			$this->load->model('Model_simpeg');
			$this->load->model('Model_pegawai');
		}
		function index(){
			if(!empty($this->uri->segment('4'))){
				$_SESSION['npp'] = $this->uri->segment('4');
			}
			$data['title'] = "Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu(2);
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			$hasil['riwayat_tree'] = $this->load->view('simpeguser/biodata/riwayat_tree',NULL,true);
			$data['content'] = $this->load->view('simpeguser/biodata/profil',$hasil,true);

			$this->load->view('dosen/index',$data);
		}
		function ajax(){
			
			$id = $this->authact->get_user_id();
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu(2);

			$query['query'] = $this->Model_simpeg->getBiodataSU($id);
			//$id = $query['query']->pegawai_id;
			$id_pegawai = $query['query']->id_pegawai;

			$where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			$query['pegawai_golongan'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_golongan",$where_id_pegawai)->row();
			$query['pegawai_jabatan_fungsional'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_fungsional",$where_id_pegawai)->row();
			$query['pegawai_jabatan_struktural'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_struktural",$where_id_pegawai)->row();
			
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
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['jabatan_struktural'] = $this->db->get_where("jabatan_struktural",$where_id_jabatan)->row();
			$where_bagian = array("bagian"=>$query['jabatan_struktural']->bagian);
			//echo $query['jabatan_struktural']->bagian;
			$where_kd_posisi = array("id_jenis_pegawai"=>$query['query']->id_jenis_pegawai);
			$query['posisi'] = $this->db->get_where("pegawai_posisi",$where_kd_posisi)->result();

			$query['jabatan_struktural_list'] = $this->db->get_where("jabatan_struktural",$where_bagian)->result();
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");

			//$data['content'] = $this->load->view('pegawai/_form_edit',$query,true);
			$this->load->view('simpeguser/biodata/_form_edit',$query);
			
			//echo "berhasil";
			// if(!$this->input->is_ajax_request()){
			// 	// $this->load->view("pegawai/testing");
			// 	$this->load->view('index_simpeg',$data);
			// }

		}
		function edit(){

			$id = $this->authact->get_user_id();
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_simpeg->getMenu(2);

			$query['query'] = $this->Model_simpeg->getBiodataSU($id);
			//$id = $query['query']->pegawai_id;
			$id_pegawai = $query['query']->id_pegawai;

			$where_id_pegawai = array("id_pegawai"=>$id_pegawai);
			$query['pegawai_golongan'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_golongan",$where_id_pegawai)->row();
			$query['pegawai_jabatan_fungsional'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_fungsional",$where_id_pegawai)->row();
			$query['pegawai_jabatan_struktural'] = $this->db->order_by("id","desc")->limit(1)->get_where("pegawai_jabatan_struktural",$where_id_pegawai)->row();
			
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
			$query['status_kawin'] = array("Lajang","Kawin");
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['jabatan_struktural'] = $this->db->get_where("jabatan_struktural",$where_id_jabatan)->row();
			$bagian = 1;
			if(!empty($query['jabatan_struktural']->bagian) && empty($query['jabatan_struktural']->bagian) != 0){
				$bagian = $query['jabatan_struktural']->bagian;
			}
			$where_bagian = array("bagian"=>$bagian);
			//echo $query['jabatan_struktural']->bagian;
			$where_kd_posisi = array("id_jenis_pegawai"=>$query['query']->id_jenis_pegawai);
			$query['posisi'] = $this->db->get_where("pegawai_posisi",$where_kd_posisi)->result();

			$query['jabatan_struktural_list'] = $this->db->get_where("jabatan_struktural",$where_bagian)->result();
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");

			//$data['content'] = $this->load->view('pegawai/_form_edit',$query,true);
			$this->load->view('simpeguser/biodata/_form_edit',$query);
			
			//echo "berhasil";
			// if(!$this->input->is_ajax_request()){
			// 	// $this->load->view("pegawai/testing");
			// 	$this->load->view('index_simpeg',$data);
			// }
			
		}
		function edit_new(){
			$id = $this->authact->get_user_id();
			$data['title'] = "Tambah Pegawai - Academic Portal";
			$data['menu'] = $this->Model_front->getMenu($this->authact->getRole());
			
			$query['query'] = $this->db->query("SELECT *,p.id as pegawai_id,b.id as id_biodata, p.nama as nama_pegawai FROM `pegawai` p
				INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
				where p.id = '".$id."'")->row();

			//$id = $query['query']->pegawai_id;
			//echo $this->db->last_query();
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
			$query['agama'] = array("Islam","Kristen","Katholik","Budha","Hindhu");
			$query['status'] = array('aktif','cuti','keluar','meninggal');
			$where_id_jabatan = array("id" => $query['pegawai_jabatan_struktural']->id_jabatan_struktural);
			$query['jabatan_struktural'] = $this->db->get_where("jabatan_struktural",$where_id_jabatan)->row();
			$query['wilayah'] = $this->db->get_where('wilayah', array('id_induk_wilayah' => '000000'))->result();  

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
			$query['bagian'] = $this->Model_simpeg->getBagianStruktural($query['curr_jabatan']->id_unit_kerja);
			$query['jenis_jabatan'] = $this->Model_simpeg->getJenisJabatan($query['curr_jabatan']->id_unit_kerja);
			$query['jabatan_struktural'] = $this->Model_simpeg->getJabatan($query['curr_jabatan']->id_bagian,$query['curr_jabatan']->id_jenis_jabatan);
			$query['s1'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S1");
			$query['s2'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S2");
			$query['s3'] = $this->Model_simpeg->getRiwayatPendidikan($id_pegawai,"S3");
			$query['simpeg'] = true;

			//$this->load->view('pegawai/_form_edit',$query);

			$data['content'] = $this->load->view('pegawai/_form_edit',$query,true);
			$this->load->view('dosen/index',$data);
			//echo "berhasil";
			// $this->load->view("pegawai/testing");
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
				// 'foto' => $nama_foto,
				// 'paswd' => $this->authact->generatepass($this->input->post('password')),
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
				redirect("/pegawai/edit/".$npp);	
			}
		}
		function ubah_photo(){
			$config['upload_path'] = './assets/foto_pegawai/';
		    $config['allowed_types'] = 'jpg|png|JPG|JPEG';
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
		    		redirect("/simpeguser/biodata/edit_new");	
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
					redirect("/simpeguser/biodata/edit_new");	
		    	else 
		    		echo "gagal";
			}
		}

	}

?>
