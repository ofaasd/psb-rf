<?php

	use Zend\Crypt\Password\Bcrypt;

	class RiwayatJabatanFungsional extends CI_Controller
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
			//$hasil['riwayat_tree'] = $this->load->view('simpeg/manage/riwayat_tree',NULL,true);
			$hasil['url'] = "RiwayatJabatanFungsional/all";
			$this->load->view('simpeg/manage/content_profil',$hasil);

			//$this->load->view('index_simpeg',$data);
		}
		function all($id){
			$id = $this->Model_simpeg->getIdPegawai($id);
			$where = array("id_pegawai"=>$id);
			$hasil['riwayat'] = $this->db->get_where("pegawai_jabatan_fungsional",$where)->result();
			$hasil['id_pegawai'] = $id;
			$hasil['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$this->load->view('simpeg/fungsional/index',$hasil);
		}
		function insert(){
			$riwayat = array(
				"id_pegawai" => $this->input->post("id_pegawai"),
				"jabatan_fungsional_sekarang" => $this->input->post("jabatan_fungsional_sekarang"),
				"no_sk_fungsional" => $this->input->post("no_sk"),
				"tgl_sk_fungsional" => $this->input->post("tgl_sk"),
				"tmt_sk_fungsional" => $this->input->post("tmt_sk"),
				"kum" => $this->input->post("kum"),
				"status" => $this->input->post("status"),
			);
			$r = $this->db->insert('pegawai_jabatan_fungsional', $riwayat);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function refresh(){
			$id = $this->input->get("id");
			$where = array("id_pegawai"=>$id);
			$hasil['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$hasil['id_pegawai'] = $id;
			$hasil['riwayat'] = $this->db->get_where("pegawai_jabatan_fungsional",$where)->result();
			$this->load->view('simpeg/fungsional/tbl_riwayat',$hasil);
		}
		function edit_form(){
			$id = $this->input->post("id");
			$where = array("id"=>$id);
			$hasil['row'] = $this->db->get_where("pegawai_jabatan_fungsional",$where)->row();
			$hasil['fakultas'] = $this->db->query("select * from fakultas")->result();
			$hasil['id_pegawai'] = $hasil['row']->id_pegawai;
			$hasil['jabatan_fungsional'] = array("Asisten Ahli","Lektor","Lektor kepala","Guru Besar");
			$this->load->view('simpeg/fungsional/form_edit',$hasil);
		}
		function update(){
			$id = $this->input->post("id");
			$id_pegawai = $this->input->post("id_pegawai");
			$where_riwayat = array("id"=>$id);
			$where_pegawai = array("id_pegawai" => $id_pegawai);
			$status = $this->input->post("status");
			
			$riwayat2 = array(
				"jabatan_fungsional_sekarang" => $this->input->post("jabatan_fungsional_sekarang"),
				"no_sk_fungsional" => $this->input->post("no_sk"),
				"tgl_sk_fungsional" => $this->input->post("tgl_sk"),
				"tmt_sk_fungsional" => $this->input->post("tmt_sk"),
				"kum" => $this->input->post("kum"),
				"status" => $status,
			);
			
			$r = $this->db->update('pegawai_jabatan_fungsional',$riwayat2,$where_riwayat);
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
			$r = $this->db->delete("pegawai_jabatan_fungsional",$id);
			if($r){
				echo 1;
			}else{
				echo 2;
			}
		}
		function updatedokumen(){
			$id = $this->input->post("id");
			$config['upload_path'] = './assets/images/fungsional/';
		    $config['allowed_types'] = 'gif|jpg|png|pdf';
		    $config['max_size']  = '10480';
		    $config['overwrite'] = TRUE;
		    $config['file_name'] = 'dokumen-'. date('YmdHis');
		    //$config['remove_space'] = TRUE;
		    $this->load->library('upload', $config); 
		    //$nama_foto = "";
		    if($this->upload->do_upload('dokumen')){
		    	$nama_foto = $this->upload->data("file_name"); 
		    	$riwayat = array(
					"dokumen" => $nama_foto,
				);
				$where_biodata = array("id"=>$id);
				$r = $this->db->update('pegawai_jabatan_fungsional', $riwayat,$where_biodata);
				if($r){
					echo 1;
				}else{
					echo 2;
				}
		    }else{
				echo "gagal upload";
			}
		}
	}
?>