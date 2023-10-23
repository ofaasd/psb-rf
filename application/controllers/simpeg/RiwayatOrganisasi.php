<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatOrganisasi extends CI_Controller
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
			// 	INNER JOIN pegawai_organisasi f on f.id_pegawai= p.id
			// 	INNER JOIN pegawai_jabatan_struktural s on s.id_pegawai= p.id")->result();
			//$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$hasil['url'] = "RiwayatOrganisasi/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

			//$this->load->view('index_simpeg',$data);
		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_organisasi",$where)->result();
			$hasil['id_pegawai'] = $id;
			//$hasil['jabatan_organisasi'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$this->load->view('simpeg/organisasi/index',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"nama_organisasi" => $this->input->post("nama_organisasi"),
				"jabatan" => $this->input->post("jabatan"),
				"tahun" => $this->input->post("tahun"),
			);
			$r = $this->db->insert('pegawai_organisasi', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_organisasi",$where)->result();
			$this->load->view('simpeg/organisasi/tbl_riwayat',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$riwayat = array(
				"nama_organisasi" => $this->input->post("nama_organisasi"),
				"jabatan" => $this->input->post("jabatan"),
				"tahun" => $this->input->post("tahun"),
			);
			$where_riwayat = array("id"=>$id);
			$r = $this->db->update('pegawai_organisasi',$riwayat,$where_riwayat);
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
			$r = $this->db->delete("pegawai_organisasi",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
?>