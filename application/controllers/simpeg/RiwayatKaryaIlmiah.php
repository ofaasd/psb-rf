<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatKaryaIlmiah extends CI_Controller
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
			// 	INNER JOIN pegawai_karya_ilmiah f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['url'] = "RiwayatKaryaIlmiah/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);

			$hasil['riwayat'] = $this->db->get_where("pegawai_karya_ilmiah",$where)->result();
			$hasil['id_pegawai'] = $id;
			$hasil['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","juli","Agustus","September","Oktober","Nopember","Desember");
			$this->load->view('simpeg/karyailmiah/index',$hasil);
		}
		function edit_form(){
			$id = $this->input->post("id");
			$where = array("id"=>$id);
			$hasil['row'] = $this->db->get_where("pegawai_karya_ilmiah",$where)->row();
			$hasil['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","juli","Agustus","September","Oktober","Nopember","Desember");
			$this->load->view('simpeg/karyailmiah/form_edit',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"judul" => $this->input->post("judul"),
				"nama_majalah" => $this->input->post("nama_majalah"),
				"volume" => $this->input->post("volume"),
				"nomor" => $this->input->post("nomor"),
				"bulan" => $this->input->post("bulan"),
				"tahun" => $this->input->post("tahun"),
				"link_url" => $this->input->post("link_url"),
			);
			$r = $this->db->insert('pegawai_karya_ilmiah', $riwayat);
			$id_karyailmiah = $this->db->insert_id();
			$where = array('id' => $id_karyailmiah);
			$config['upload_path'] = './assets/images/karyailmiah/';
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
						"file" => $nama_foto,
					);
					$r = $this->db->update('pegawai_karya_ilmiah', $riwayat,$where);
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
			$hasil['riwayat'] = $this->db->get_where("pegawai_karya_ilmiah",$where)->result();
			$this->load->view('simpeg/karyailmiah/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"judul" => $this->input->post("judul"),
				"nama_majalah" => $this->input->post("nama_majalah"),
				"volume" => $this->input->post("volume"),
				"nomor" => $this->input->post("nomor"),
				"bulan" => $this->input->post("bulan"),
				"tahun" => $this->input->post("tahun"),
				"link_url" => $this->input->post("link_url"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_karya_ilmiah',$riwayat,$where_riwayat);

			$where = array('id' => $id);
			$config['upload_path'] = './assets/images/karyailmiah/';
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
						"file" => $nama_foto,
					);
					$r = $this->db->update('pegawai_karya_ilmiah', $riwayat,$where);
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
			$r = $this->db->delete("pegawai_karya_ilmiah",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
?>