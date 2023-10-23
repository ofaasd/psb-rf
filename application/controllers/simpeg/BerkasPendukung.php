<?php

	use Zend\Crypt\Password\Bcrypt;

	class BerkasPendukung extends CI_Controller
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
		function index(){
			$hasil['npp'] = $this->Model_simpeg->getAllNpp();
			// $hasil['npp'] = $this->db->query("SELECT npp,p.nama FROM `pegawai` p
			// 	INNER JOIN pegawai_biodata b on b.id_pegawai = p.id
			// 	INNER JOIN pegawai_golongan g on g.id_pegawai= p.id
			// 	INNER JOIN pegawai_penelitian f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['url'] = "BerkasPendukung/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);
		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['berkas'] = $this->db->get_where("pegawai_berkas_pendukung",$where)->row();
			$hasil['sertifikat'] = $this->db->get_where("pegawai_sertifikat",$where)->result();
			$hasil['fakultas'] = $this->db->query("select * from fakultas")->result();
			$hasil['id_pegawai'] = $id;
			$this->load->view('simpeg/berkaspendukung/index',$hasil);
		}
		function refresh_berkas(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['berkas'] = $this->db->get_where("pegawai_berkas_pendukung",$where)->row();
			$hasil['fakultas'] = $this->db->query("select * from fakultas")->result();
			$hasil['id_pegawai'] = $id;
			$this->load->view('simpeg/berkaspendukung/tbl_berkas',$hasil);
		}
		function refresh_sertifikat(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['sertifikat'] = $this->db->get_where("pegawai_sertifikat",$where)->result();
			$hasil['fakultas'] = $this->db->query("select * from fakultas")->result();
			$hasil['id_pegawai'] = $id;
			$this->load->view('simpeg/berkaspendukung/tbl_sertifikat',$hasil);
		}
		function save_ktp(){
			$id = $this->input->post("id");
			$where = array("id_pegawai" => $id);
			$berkas = $this->db->get_where("pegawai_berkas_pendukung", $where);
			if($berkas->num_rows == 0){
				$this->db->insert('pegawai_berkas_pendukung', $where);
			}
			$config['upload_path'] = './assets/images/ktp/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'ktp-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('ktp')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"ktp" => $nama_foto,
				);
				$r = $this->db->update('pegawai_berkas_pendukung', $riwayat,$where);
				if($r){
					//if()
					//echo $berkas->num_rows();
					echo 1;
					//echo $this->db->last_query();
				}else{
					echo 2;
				}
		    }
		}
		function delete_ktp(){
			$id = $this->input->post("id");
			$where = array("id_pegawai" => $id);
			$riwayat = array(
				"ktp" => "",
			);
			$r = $this->db->update('pegawai_berkas_pendukung', $riwayat,$where);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function save_kk(){
			$id = $this->input->post("id");
			$where = array("id_pegawai" => $id);
			$berkas = $this->db->get_where("pegawai_berkas_pendukung", $where);
			if(empty($berkas)){
				$this->db->insert('pegawai_berkas_pendukung', $where);
			}
			$config['upload_path'] = './assets/images/KK/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'kk-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('kk')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"kk" => $nama_foto,
				);
				$r = $this->db->update('pegawai_berkas_pendukung', $riwayat,$where);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
				echo 3;
			}
		}
		function delete_kk(){
			$id = $this->input->post("id");
			$where = array("id_pegawai" => $id);
			$riwayat = array(
				"kk" => "",
			);
			$r = $this->db->update('pegawai_berkas_pendukung', $riwayat,$where);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function save_sertifikat(){
			$config['upload_path'] = './assets/images/sertifikat/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'sertifikat-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('sertifikat')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
		    		"nama_kegiatan" => $this->input->post("nama_kegiatan"),
		    		"penyelenggara" => $this->input->post("penyelenggara"),
		    		"tanggal_kegiatan" => date('Y-m-d',strtotime($this->input->post("tanggal_kegiatan"))),
					"peran_sebagai" => $this->input->post("peran_sebagai"),
					"file" => $nama_foto,
					"id_pegawai" => $this->input->post("id_pegawai"),
				);
				$r = $this->db->insert('pegawai_sertifikat', $riwayat);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
		    	$riwayat = array(
		    		"nama_kegiatan" => $this->input->post("nama_kegiatan"),
		    		"penyelenggara" => $this->input->post("penyelenggara"),
		    		"tanggal_kegiatan" => date('Y-m-d',strtotime($this->input->post("tanggal_kegiatan"))),
					"peran_sebagai" => $this->input->post("peran_sebagai"),
					"id_pegawai" => $this->input->post("id_pegawai"),
				);
				$r = $this->db->insert('pegawai_sertifikat', $riwayat);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }
		}
		function update_sertifikat(){
			$id = $this->input->post("id");
			$where = array("id"=>$id);
			$array = array(
							"nama_kegiatan" => $this->input->post("nama_kegiatan"),
							"penyelenggara" => $this->input->post("penyelenggara"),
							"tanggal_kegiatan" => date('Y-m-d',strtotime($this->input->post("tanggal_kegiatan"))),
							"peran_sebagai" => $this->input->post("peran_sebagai"),
						);
			$r = $this->db->update('pegawai_sertifikat', $array,$where);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function delete_file_sertifikat(){
			$id = $this->input->post("id");
			$where = array("id" => $id);
			$riwayat = array(
				"file" => "",
			);
			$r = $this->db->update('pegawai_sertifikat', $riwayat,$where);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function delete_sertifikat(){
			$id = $this->input->post("id");
			$where = array("id" => $id);
			$r = $this->db->delete('pegawai_sertifikat',$where);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function update_file_sertifikat(){
			$id = $this->input->post("id");
			$where = array("id" => $id);
			
			$config['upload_path'] = './assets/images/sertifikat/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'sertifikat-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('sertifikat')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"file" => $nama_foto,
				);
				$r = $this->db->update('pegawai_sertifikat', $riwayat,$where);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
				echo 2;
		    }
		}

	}