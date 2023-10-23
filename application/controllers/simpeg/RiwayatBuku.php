<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatBuku extends CI_Controller
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
			// 	INNER JOIN pegawai_buku f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['url'] = "RiwayatBuku/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);

			$hasil['riwayat'] = $this->db->get_where("pegawai_buku",$where)->result();
			$hasil['id_pegawai'] = $id;
			$hasil['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","juli","Agustus","September","Oktober","Nopember","Desember");
			$this->load->view('simpeg/buku/index',$hasil);
		}
		function edit_form(){
			$id = $this->input->post("id");
			$where = array("id"=>$id);
			$hasil['row'] = $this->db->get_where("pegawai_buku",$where)->row();
			$hasil['bulan'] = array("Januari","Februari","Maret","April","Mei","Juni","juli","Agustus","September","Oktober","Nopember","Desember");
			$this->load->view('simpeg/buku/form_edit',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"judul_buku" => $this->input->post("judul_buku"),
				"penulis" => $this->input->post("penulis"),
				"isbn" => $this->input->post("isbn"),
				"tahun" => $this->input->post("tahun"),
				"link_dokumen" => $this->input->post("link_dokumen"),
			);
			$r = $this->db->insert('pegawai_buku', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_buku",$where)->result();
			$this->load->view('simpeg/buku/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"judul_buku" => $this->input->post("judul_buku"),
				"penulis" => $this->input->post("penulis"),
				"isbn" => $this->input->post("isbn"),
				"tahun" => $this->input->post("tahun"),
				"link_dokumen" => $this->input->post("link_dokumen"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_buku',$riwayat,$where_riwayat);

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
			$r = $this->db->delete("pegawai_buku",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
?>