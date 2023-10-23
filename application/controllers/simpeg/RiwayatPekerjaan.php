<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatPekerjaan extends CI_Controller
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
			// 	INNER JOIN pegawai_pekerjaan f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			$hasil['url'] = "RiwayatPekerjaan/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_pekerjaan",$where)->result();
			$hasil['id_pegawai'] = $id;
			$this->load->view('simpeg/pekerjaan/index',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"posisi" => $this->input->post("posisi"),
				"perusahaan" => $this->input->post("perusahaan"),
				"tahun_masuk" => $this->input->post("tahun_masuk"),
				"tahun_keluar" => $this->input->post("tahun_keluar"),
			);
			$r = $this->db->insert('pegawai_pekerjaan', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_pekerjaan",$where)->result();
			$this->load->view('simpeg/pekerjaan/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"posisi" => $this->input->post("posisi"),
				"perusahaan" => $this->input->post("perusahaan"),
				"tahun_masuk" => $this->input->post("tahun_masuk"),
				"tahun_keluar" => $this->input->post("tahun_keluar"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_pekerjaan',$riwayat,$where_riwayat);
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
			$r = $this->db->delete("pegawai_pekerjaan",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
?>