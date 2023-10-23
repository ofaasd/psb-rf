<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatHaki extends CI_Controller
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
			// 	INNER JOIN pegawai_haki f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['url'] = "RiwayatHaki/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);

			$hasil['riwayat'] = $this->db->get_where("pegawai_haki",$where)->result();
			$hasil['id_pegawai'] = $id;
			$hasil['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","juli","Agustus","September","Oktober","Nopember","Desember");
			$this->load->view('simpeg/haki/index',$hasil);
		}
		function edit_form(){
			$id = $this->input->post("id");
			$where = array("id"=>$id);
			$hasil['row'] = $this->db->get_where("pegawai_haki",$where)->row();
			$hasil['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","juli","Agustus","September","Oktober","Nopember","Desember");
			$this->load->view('simpeg/haki/form_edit',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"pemilik" => $this->input->post("pemilik"),
				"tahun_ajaran" => $this->input->post("tahun_ajaran"),
				"judul" => $this->input->post("judul"),
			);
			$r = $this->db->insert('pegawai_haki', $riwayat);
			$id_karyailmiah = $this->db->insert_id();
			$where = array('id' => $id_karyailmiah);
			$config['upload_path'] = './assets/images/haki/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
			if(!empty($_FILES['file']['name'])){
		    	
		    	$config['file_name'] = 'file-'. date('YmdHis');
			    $this->load->library('upload', $config); 
			    //$nama_foto = "";
			    if($this->upload->do_upload('file')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"sertifikat" => $nama_foto,
					);
					$r = $this->db->update('pegawai_haki', $riwayat,$where);
			    }
		    }
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_haki",$where)->result();
			$this->load->view('simpeg/haki/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"pemilik" => $this->input->post("pemilik"),
				"tahun_ajaran" => $this->input->post("tahun_ajaran"),
				"judul" => $this->input->post("judul"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_haki',$riwayat,$where_riwayat);
			
			$where = array('id' => $id);
			$config['upload_path'] = './assets/images/haki/';
			$config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10240';
		    $config['overwrite'] = TRUE;
			if(!empty($_FILES['file']['name'])){
		    	
		    	$config['file_name'] = 'file-'. date('YmdHis');
			    $this->load->library('upload', $config); 
			    //$nama_foto = "";
			    if($this->upload->do_upload('file')){
			    	$nama_foto = $this->upload->data("file_name"); 
			    	$riwayat = array(
						"sertifikat" => $nama_foto,
					);
					$r = $this->db->update('pegawai_haki', $riwayat,$where);
			    }
		    }
			
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function delete(){
			$id = array(
				"id"=>$this->input->post("id"),
			);
			$r = $this->db->delete("pegawai_haki",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
?>